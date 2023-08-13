<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
	
?>

<div class="slicewp-card">

	<div class="slicewp-card-inner">

		<div class="slicewp-setup-finished">

			<h2><?php echo __( "You're all set up and good to go!", 'slicewp' ); ?></h2>

			<p><?php echo __( "SliceWP is ready to run your affiliate program. Remember that you can always go to the plugin's settings page to modify the settings covered by the setup wizard.", 'slicewp' ); ?></p>


			<div class="slicewp-setup-newsletter">

				<p><?php echo __( "Tips, news and product updates, straight to your inbox.", 'slicewp' ); ?></p>
				
				<div class="slicewp-setup-newsletter-form">

					<div class="slicewp-setup-newsletter-form-email">
						<input type="email" value="" name="EMAIL" placeholder="<?php echo __( 'Your Email', 'slicewp'); ?>" class="required email" id="mce-EMAIL">
					</div>

					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>
					
					<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_506ed65ce0a7eec2aa1c7cc61_5fe80d913e" tabindex="-1" value=""></div>
					<input type="submit" class="slicewp-button-primary" value="<?php echo __( 'Yes, please!', 'slicewp' ); ?>" name="subscribe" id="mc-embedded-subscribe" class="button">

				</div>

			</div>

			<div class="slicewp-setup-facebook-group">

				<p><?php echo __( "Join our Facebook group.", 'slicewp' ); ?></p>

				<div class="slicewp-setup-facebook-group-inner">
					<span><?php echo __( 'Ask SliceWP related questions, connect with other business owners, learn and also help others to run a successful affiliate program.', 'slicewp' ); ?></span>
					<a class="slicewp-button-primary slicewp-button-facebook" href="https://www.facebook.com/groups/slicewp/" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50" style="null;fill: #fff;width: 16px;height: auto;margin-right: 7px;vertical-align: middle;" class="icon icons8-Facebook-Filled">    <path d="M40,0H10C4.486,0,0,4.486,0,10v30c0,5.514,4.486,10,10,10h30c5.514,0,10-4.486,10-10V10C50,4.486,45.514,0,40,0z M39,17h-3 c-2.145,0-3,0.504-3,2v3h6l-1,6h-5v20h-7V28h-3v-6h3v-3c0-4.677,1.581-8,7-8c2.902,0,6,1,6,1V17z"></path></svg><?php echo __( 'Join group', 'slicewp' ); ?></a>
				</div>

			</div>

			<h2><?php echo __( "Next steps", 'slicewp' ); ?></h2>

			<div class="slicewp-row">
				<div class="slicewp-col-3-4">
					<h4><?php echo __( 'Learn how to use SliceWP', 'slicewp' ); ?></h4>
					<p><?php echo __( 'Learn the ins and outs of SliceWP to set up your affiliate program exactly how you want it.', 'slicewp' ) ?></p>
				</div>
				<div class="slicewp-col-1-4">
					<a href="https://slicewp.com/docs/" target="_blank" class="slicewp-button-secondary"><?php echo __( 'Documentation', 'slicewp' ); ?></a>
				</div>
			</div>

			<hr/ >

			<div class="slicewp-row">
				<div class="slicewp-col-3-4">
					<h4><?php echo __( 'Continue setting up SliceWP', 'slicewp' ); ?></h4>
					<p><?php echo __( 'The setup wizard covers only the few essential options you need to start. You can add more or refine the existing ones to cater to your needs.', 'slicewp' ); ?></p>
				</div>
				<div class="slicewp-col-1-4">
					<a href="<?php echo add_query_arg( array( 'page' => 'slicewp-settings' ), admin_url( 'admin.php' ) ); ?>" class="slicewp-button-secondary"><?php echo __( 'Review Settings', 'slicewp' ); ?></a>
				</div>
			</div>

			<hr/ >

			<div class="slicewp-row">
				<div class="slicewp-col-3-4">
					<h4><?php echo __( 'Continue to your admin dashboard', 'slicewp' ); ?></h4>
					<p><?php echo __( "If all looks good here, head over to your admin dashboard to continue managing your website.", 'slicewp' ); ?></p>
				</div>
				<div class="slicewp-col-1-4">
					<a href="<?php echo admin_url(); ?>" class="slicewp-button-secondary"><?php echo __( 'Visit Dashboard', 'slicewp' ) ?></a>
				</div>
			</div>

		</div>

	</div>

</div>