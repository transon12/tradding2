<?php

namespace SimpleJWTLogin\Services;

use SimpleJWTLogin\ErrorCodes;
use SimpleJWTLogin\Helpers\Jwt\JwtKeyFactory;
use SimpleJWTLogin\Libraries\JWT;
use SimpleJWTLogin\Modules\Settings\AuthenticationSettings;
use SimpleJWTLogin\Modules\SimpleJWTLoginHooks;
use SimpleJWTLogin\Modules\SimpleJWTLoginSettings;
use SimpleJWTLogin\Modules\WordPressDataInterface;
use WP_REST_Response;
use Exception;
use WP_User;

class AuthenticateService extends BaseService implements ServiceInterface
{
    /**
     * @param array $payload
     * @param WordPressDataInterface $wordPressData
     * @param SimpleJWTLoginSettings $jwtSettings
     * @param WP_User $user
     *
     * @return array
     */
    public static function generatePayload(
        $payload,
        $wordPressData,
        $jwtSettings,
        $user
    ) {
        $payload[AuthenticationSettings::JWT_PAYLOAD_PARAM_IAT] = time();

        foreach ($jwtSettings->getAuthenticationSettings()->getJwtPayloadParameters() as $parameter) {
            if ($parameter === AuthenticationSettings::JWT_PAYLOAD_PARAM_IAT
                || $jwtSettings->getAuthenticationSettings()->isPayloadDataEnabled($parameter) === false
            ) {
                continue;
            }

            switch ($parameter) {
                case AuthenticationSettings::JWT_PAYLOAD_PARAM_EXP:
                    $ttl = (int)$jwtSettings->getAuthenticationSettings()->getAuthJwtTtl() * 60;
                    $payload[$parameter] = time() + $ttl;
                    break;
                case AuthenticationSettings::JWT_PAYLOAD_PARAM_ID:
                    $payload[$parameter] = $wordPressData->getUserProperty($user, 'id');
                    break;
                case AuthenticationSettings::JWT_PAYLOAD_PARAM_EMAIL:
                    $payload[$parameter] = $wordPressData->getUserProperty($user, 'user_email');
                    break;
                case AuthenticationSettings::JWT_PAYLOAD_PARAM_SITE:
                    $payload[$parameter] = $wordPressData->getSiteUrl();
                    break;
                case AuthenticationSettings::JWT_PAYLOAD_PARAM_USERNAME:
                    $payload[$parameter] = $wordPressData->getUserProperty($user, 'user_login');
                    break;
            }
        }

        return $payload;
    }

    /**
     * @return WP_REST_Response
     * @throws Exception
     */
    public function makeAction()
    {
        $this->checkAuthenticationEnabled();
        $this->checkAllowedIPAddress();
        $this->validateAuthenticationAuthKey(ErrorCodes::ERR_INVALID_AUTH_CODE_PROVIDED);

        return $this->authenticateUser();
    }

    public function check_password_reset_key_phone( $key, $login ) {
        if ( !username_exists($login)) {
            return  false;
        }
        $user = get_user_by( 'login', $login );

        $expiration_duration = apply_filters( 'password_reset_expiration', DAY_IN_SECONDS );
     
        if ( false !== strpos( $user->user_activation_key, ':' ) ) {
            list( $pass_request_time, $pass_key ) = explode( ':', $user->user_activation_key, 2 );
            $expiration_time                      = $pass_request_time + $expiration_duration;
        } else {
            $pass_key        = $user->user_activation_key;
            $expiration_time = false;
        }
     
        if($pass_key==$key)
        {
        $hash_is_correct=true; 
        }else{
            $hash_is_correct=false; 
        }
        if ( $hash_is_correct && $expiration_time && time() < $expiration_time ) {
            $key_saved = wp_update_user(
                array(
                    'ID'                  => $user->ID,
                    'user_activation_key' => '',
                )
            );
            return true;
        } 
        elseif ( $hash_is_correct && $expiration_time ) {

            return false;
        }
     
        if ( hash_equals( $user->user_activation_key, $key ) || ( $hash_is_correct && ! $expiration_time ) ) {

            return  false;
        }
     
        return false;
    }









    /**
     * @SuppressWarnings(StaticAccess)
     * @return WP_REST_Response
     * @throws Exception
     */
    public function authenticateUser()
    {
        if (!isset($this->request['email']) && !isset($this->request['username'])) {
            throw new Exception(
                __('The email or username parameter is missing from request.', 'simple-jwt-login'),
                ErrorCodes::AUTHENTICATION_MISSING_EMAIL
            );
        }
        if (!isset($this->request['codeactive']))
        { 
        if (!isset($this->request['password']) && !isset($this->request['password_hash'])) {
            throw new Exception(
                __('The password or password_hash parameter is missing from request.', 'simple-jwt-login'),
                ErrorCodes::AUTHENTICATION_MISSING_PASSWORD
            );
        }
        }
        $user = isset($this->request['username'])
            ? $this->wordPressData->getUserByUserLogin($this->request['username'])
            : $this->wordPressData->getUserDetailsByEmail($this->request['email']);

        if (empty($user)) {
            throw new Exception(
                __('Wrong user credentials.', 'simple-jwt-login'),
                ErrorCodes::AUTHENTICATION_WRONG_CREDENTIALS
            );
        }
       
        $password = isset($this->request['password'])
            ? $this->request['password']
            : null;


        
        $passwordHash = isset($this->request['password_hash'])
            ? $this->request['password_hash']
            : null;
            if (isset($this->request['codeactive']))
            { 
                $check=$this->check_password_reset_key_phone($this->request['codeactive'],$this->request['username']);
                if($check==false)
                {
                    throw new Exception(
                        __('Code sai', 'simple-jwt-login'),
                        ErrorCodes::AUTHENTICATION_WRONG_CREDENTIALS
                    );
                }else{
                    
                $passwordHash=$this->wordPressData->getUserPassword($user);
                }
            }
            
        $dbPassword = $this->wordPressData->getUserPassword($user);
        $passwordMatch = $this->wordPressData->checkPassword($password, $passwordHash, $dbPassword);

        if ($passwordMatch === false) {
            throw new Exception(
                __('Wrong user credentials.', 'simple-jwt-login'),
                ErrorCodes::AUTHENTICATION_WRONG_CREDENTIALS
            );
        }

        //Generate payload
        $payload = isset($this->request['payload'])
            ? json_decode(stripslashes($this->request['payload']), true)
            : [];

        $payload = self::generatePayload(
            $payload,
            $this->wordPressData,
            $this->jwtSettings,
            $user
        );

        if ($this->jwtSettings->getHooksSettings()->isHookEnable(SimpleJWTLoginHooks::JWT_PAYLOAD_ACTION_NAME)) {
            $payload = $this->wordPressData->triggerFilter(
                SimpleJWTLoginHooks::JWT_PAYLOAD_ACTION_NAME,
                $payload,
                $this->request
            );
        }

        $response = [
            'success' => true,
            'data' => [
                'jwt' => JWT::encode(
                    $payload,
                    JwtKeyFactory::getFactory($this->jwtSettings)->getPrivateKey(),
                    $this->jwtSettings->getGeneralSettings()->getJWTDecryptAlgorithm()
                )
            ]
        ];
        if ($this->jwtSettings->getHooksSettings()->isHookEnable(SimpleJWTLoginHooks::HOOK_RESPONSE_AUTH_USER)) {
            $response = $this->wordPressData->triggerFilter(
                SimpleJWTLoginHooks::HOOK_RESPONSE_AUTH_USER,
                $response,
                $user
            );
        }

        return $this->wordPressData->createResponse($response);
    }

    /**
     * @throws Exception
     */
    protected function checkAllowedIPAddress()
    {
        $allowedIpsString = trim($this->jwtSettings->getAuthenticationSettings()->getAllowedIps());
        if (!empty($allowedIpsString) && !$this->serverHelper->isClientIpInList($allowedIpsString)) {
            throw new Exception(
                sprintf(
                    __('You are not allowed to Authenticate from this IP: %s', 'simple-jwt-login'),
                    $this->serverHelper->getClientIP()
                ),
                ErrorCodes::ERR_DELETE_INVALID_CLIENT_IP
            );
        }
    }

    /**
     * @throws Exception
     */
    protected function checkAuthenticationEnabled()
    {
        if ($this->jwtSettings->getAuthenticationSettings()->isAuthenticationEnabled() === false) {
            throw new Exception(
                __('Authentication is not enabled.', 'simple-jwt-login'),
                ErrorCodes::AUTHENTICATION_IS_NOT_ENABLED
            );
        }
    }

    /**
     * @param int $errrCode
     *
     * @throws Exception
     */
    protected function validateAuthenticationAuthKey($errrCode)
    {
        if ($this->jwtSettings->getAuthenticationSettings()->isAuthKeyRequired()
            && $this->validateAuthKey() === false
        ) {
            throw  new Exception(
                sprintf(
                    __('Invalid Auth Code ( %s ) provided.', 'simple-jwt-login'),
                    $this->jwtSettings->getAuthCodesSettings()->getAuthCodeKey()
                ),
                $errrCode
            );
        }
    }
}
