(function($) {
	$( document ).ready(
		function() {
			$( "#learn-press-course-tabs .learn-press-nav-tabs a" ).on(
				'click',
				function(event) {
					if (this.hash !== "") {
						event.preventDefault();
						var hash = this.hash;
						$( 'html, body' ).animate(
							{
								scrollTop: $( hash ).offset().top
							},
							800
						);
					}
				}
			);

			$( "#learn-press-course-tabs .learn-press-nav-tabs li" ).on(
				'click',
				function() {
					$( "#learn-press-course-tabs .learn-press-nav-tabs li.active" ).removeClass( 'active' );
					$( this ).addClass( 'active' );
				}
			);

			$( '.svg-icon' ).each(
				function(){
					var $img     = $( this );
					var imgID    = $img.attr( 'id' );
					var imgClass = $img.attr( 'class' );
					var imgURL   = $img.attr( 'src' );

					$.get(
						imgURL,
						function(data) {
							// Get the SVG tag, ignore the rest
							var $svg = $( data ).find( 'svg' );

							// Add replaced image's ID to the new SVG
							if (typeof imgID !== 'undefined') {
								$svg = $svg.attr( 'id', imgID );
							}
							// Add replaced image's classes to the new SVG
							if (typeof imgClass !== 'undefined') {
								$svg = $svg.attr( 'class', imgClass + ' replaced-svg' );
							}

							// Remove any invalid XML tags as per http://validator.w3.org
							$svg = $svg.removeAttr( 'xmlns:a' );

							// Replace image with new SVG
							$img.replaceWith( $svg );

						},
						'xml'
					);

				}
			);

			$( '#uptrend_stocks .stt i' ).click(
				function(){
					$( this ).toggleClass( 'active' );
				}
			);

			$( '.adong-login-input #btn-eye-toggle.adong-toggle-password, #adong-toggle-oldpassword' ).click(
				function(){
					$( this ).toggleClass( "eye-disable" );
					var input     = $( "#password_login, #oldpw_profile" );
					var input_res = $( "#password_res" );
					if (input.attr( "type" ) === "password") {
						input.attr( "type", "text" );
					} else {
						input.attr( "type", "password" );
					}
					if (input_res.attr( "type" ) === "password") {
						input_res.attr( "type", "text" );
					} else {
						input_res.attr( "type", "password" );
					}
				}
			);

			$( '#adong-toggle-newpassword, #adong-cf-toggle-password' ).click(
				function(){
					$( this ).toggleClass( "eye-disable" );
					var input = $( "#newpw_profile, #confirm_password_res" );
					if (input.attr( "type" ) === "password") {
						input.attr( "type", "text" );
					} else {
						input.attr( "type", "password" );
					}
				}
			);

			$( '#adong_login_submit' ).click(
				function() {
					var phone         = $( '#phone_login' ).val();
					var password      = $( '#password_login' ).val();
					var remeber_check = '0';
					if ($( "#remeber_check" ).is( ':checked' )) {
						remeber_check = '1';
					}
					if (phone == '') {
						$( '#message' ).html( '<span class="error">Vui lòng nhập số điện thoại</span>' );

					} else if (password == '') {
						$( '#message' ).html( '<span class="error">Vui lòng nhập mật khẩu</span>' );
						$( '#password_login' ).addClass( 'border-empty' );
					} else {
						$.ajax(
							{
								type: 'POST',
								url: ajaxurl,
								data: {
									'action': 'login_ajax',
									phone:phone,
									password:password,
									remeber_check:remeber_check,
								},
								beforeSend:function(response){
									$( '#loader' ).removeClass( 'hidden' );
								},
								success: function(response){
									if (response.loggedin == true) {
										$( '#message' ).html( '<span class="success">' + response.message + '</span>' );
										swal(
											{
												title: response.message,
												type: "success",
											}
										);
										window.location.href = 'https://cfa99.net/';
									} else {
										swal(
											{
												title: response.message,
												text: "Vui lòng kiểm tra thông tin đăng nhập!",
												type: "warning",
												showCancelButton: true,
												confirmButtonClass: 'btn-warning',
												confirmButtonText: 'Đồng ý!',
												cancelButtonText: "Bỏ qua!",
												closeOnConfirm: false,
												closeOnCancel: false
											}
										);
									}
								},
								complete: function(){
									$( '#loader' ).addClass( 'hidden' );
								},
								error: function (response) {
									$( '#message' ).html( '<span class="error">Đăng nhập không thành công</span>' );
								}
							}
						);
					}
				}
			);

			$( '#form-register #adong_reg_submit' ).click(
				function() {
					var firstname   = $( '#first_name_res' ).val();
					var lastname    = $( '#last_name_res' ).val();
					var password    = $( '#password_res' ).val();
					var cf_password = $( '#confirm_password_res' ).val();
					var phone       = $( '#phone_res' ).val();
					var code_intro  = $( '#code_res' ).val();
					var noti        = '0';
					if ($( "#remeber_check" ).is( ':checked' )) {
						noti = '1';
					}

					if (firstname == '' || lastname == '' || password == '' || phone == '' || cf_password == '') {
						$( '#message' ).html( '<span class="error">Vui lòng nhập đầy đủ thông tin</span>' );
					} else {
						if (password !== cf_password ) {
							$( '#message' ).html( '<span class="error">Mật khẩu không giống nhau.Vui lòng kiếm tra lại</span>' );
						} else if  ((password.length && cf_password.length) < 6){
							$( '#message' ).html( '<span class="error">Mật khẩu phải từ 6 kí tự trở lên</span>' );
						} else {
							$.ajax(
								{
									type: "POST",
									url: ajaxurl,
									data: {
										'action': 'register_modal',
										firstname: firstname,
										lastname: lastname,
										password: password,
										phone: phone,
										code_intro: code_intro,
										noti: noti,
									},
									beforeSend:function(response){
										$( '#loader' ).removeClass( 'hidden' );
									},
									success: function(response){
										if (response.register == true || typeof(response) == 'string') {
											$( '#message' ).html( '<span class="success">Đăng ký thành công</span>' );
											window.location.href = 'https://cfa99.net/dang-nhap';
										} else {
											$( '#message' ).html( '<span class="error">' + response.message + '</span>' );
										}
									},
									complete: function(){
										$( '#loader' ).addClass( 'hidden' );
									},
									error: function (response) {
										$( '#form-register #adong_reg_submit' ).html( 'Đăng ký' );
									}
								}
							);
						}
					}

				}
			);

			$( '#loss-password #reset_pw_submit' ).click(
				function() {

					var phone = $( '#reset_pw_phone' ).val();
					if (phone == '') {
						$( '#message' ).html( '<span class="error">Xin Vui lòng nhập số điện thoại</span>' );
					} else {
						if (isVietnamesePhoneNumber( phone ) == false) {
							$( '#message' ).html( '<span class="error">Số điện thoại không đúng định dạng</span>' );
						} else {
							$( '#message' ).html( '' );
							$.ajax(
								{
									type: "POST",
									url: ajaxurl,
									data: {
										'action': 'send_reset_password_modal',
										phone:phone,
									},
									beforeSend:function(response){
										$( '#loader' ).removeClass( 'hidden' );
									},
									success: function(response){

										if (response.success) {
											$( '#message' ).html( '<span class="success">' + response.data + '</span>' );
											window.location.href = "/xac-thuc-ma/";
										} else {
											$( '#message' ).html( '<span class="error">' + response.data + '</span>' );
										}
										$( '#loss-password #reset_pw_submit' ).html( 'Tiếp tục' );
									},
									complete: function(){
										$( '#loader' ).addClass( 'hidden' );
									},
									error: function (response) {
										$( '#loss-password #reset_pw_submit' ).html( 'Tiếp tục' );
									}
								}
							);
						}
					}

				}
			);

			jQuery(document).on('click','#sendcode-again', function(){
				var phone = $( '#sendcode-again' ).attr('data-phone');
					if (phone == '') {
						$( '#message' ).html( '<span class="error">Xin Vui lòng nhập số điện thoại</span>' );
					} else {
						if (isVietnamesePhoneNumber( phone ) == false) {
							$( '#message' ).html( '<span class="error">Số điện thoại không đúng định dạng</span>' );
						} else {
							$( '#message' ).html( '' );
							$.ajax(
								{
									type: "POST",
									url: ajaxurl,
									data: {
										'action': 'send_reset_password_modal',
										phone:phone,
									},
									beforeSend:function(response){
										$( '#loader' ).removeClass( 'hidden' );
									},
									success: function(response){

										if (response.success) {
											$( '#message' ).html( '<span class="success">' + response.data + '</span>' );
										} else {
											$( '#message' ).html( '<span class="error">' + response.data + '</span>' );
										}
										
									},
									complete: function(){
										$( '#loader' ).addClass( 'hidden' );
									},
									error: function (response) {
										console.log('Error');
										
									}
								}
							);
						}
					}

				
			});

			jQuery(document).on('click','#phone_verifycode', function(){
				
				var album_text = [];
				var phone_number = jQuery(this).attr('data-phone');
				var number_code = "";
				

				$("input[name='phone_code[]']").each(function() {
					var value = $(this).val();
					if (value) {
						album_text.push(value);
						number_code += value; 
					}
				});
			
				
				if (number_code.length === 0 || number_code.length < 6) {
					jQuery( '#message' ).html( '<span class="error"> Vui lòng nhập đủ mã xác thực </span>' );
				} else {
					console.log();
					
					jQuery.ajax({
						type: 'POST',
						url: ajaxurl,
						data: {
							'action': 'check_code_active_reset_password',
							code_active:number_code,
							phone_number:phone_number,
						},
						beforeSend:function(response){
							console.log('checking');
						},
						success: function(response){
							console.log(response);
							if(response.success == true){
								jQuery( '#message' ).html( '<span class="success"> '+response.data+' </span>' );
								window.location.href = "/dat-lai-mat-khau";
							}else{
								jQuery( '#message' ).html( '<span class="error"> '+response.data+' </span>' );
							}
							
							
							
						},
						error: function (response) {
							console.log('error'+response);
						}
					});
				}

				// var code = jQuery('input[name="phone_code[]"]').map(function(){return jQuery(this).val();}).get();
				// 	console.log(code);
					
				// 	code = code.join(',');
				
				
				
			});


			$( 'body' ).on(
				'click',
				'.active-code',
				function() {
					$( '#message' ).html( '' );
					$.ajax(
						{
							type: "POST",
							url: ajaxurl,
							data: {
								'action': 'send_reset_password_modal',
								phone:'',
							},
							beforeSend:function(response){
								$( '#loader' ).removeClass( 'hidden' );
							},
							success: function(response){

								if (response.success) {
									$( '#message' ).html( '<span class="success">' + response.data + '</span>' );
									window.location.href = "/xac-thuc-ma/";
								} else {
									$( '#message' ).html( '<span class="error">' + response.data + '</span>' );
								}
								$( '#loss-password #reset_pw_submit' ).html( 'Tiếp tục' );
							},
							complete: function(){
								$( '#loader' ).addClass( 'hidden' );
							},
							error: function (response) {
								$( '#loss-password #reset_pw_submit' ).html( 'Tiếp tục' );
							}
						}
					);

				}
			);

			$( '#save-info-user' ).click(
				function() {
					var firstname    = $( '#firstname_profile' ).val();
					var lastname     = $( '#lastname_profile' ).val();
					var password     = $( '#oldpw_profile' ).val();
					var new_password = $( '#newpw_profile' ).val();
					if (password == '') {
						$( '#message' ).html( '<span class="error">Cần nhập mật khẩu để thay đổi thông tin</span>' );
					} else {
						if (password.length < 6 && new_password < 6) {
							$( '#message' ).html( '<span class="error">Mật khẩu phải từ 6 kí tự trở lên</span>' );
						} else {
							$.ajax(
								{
									type: "POST",
									url: ajaxurl,
									data: {
										'action': 'change_info_user',
										firstname:firstname,
										lastname:lastname,
										password:password,
										new_password:new_password,
									},
									beforeSend:function(response){
										$( '#loader' ).removeClass( 'hidden' );
									},
									success: function(response){
										if (response.save == true) {
											swal(
												{
													title: response.message,
													text: "Giờ bạn có thể truy cập tài khoản với mật khẩu mới!",
													type: "success",
												}
											);
											window.location.reload();
										} else {
											swal(
												{
													title: response.message,
													text: "Vui lòng kiểm tra lại mật khẩu!",
													type: "warning",
													showCancelButton: true,
													confirmButtonClass: 'btn-warning',
													confirmButtonText: 'Đồng ý!',
													cancelButtonText: "Bỏ qua!",
													closeOnConfirm: false,
													closeOnCancel: false
												}
											);
										}
									},
									complete: function(){
										$( '#loader' ).addClass( 'hidden' );
									},
									error: function (response) {
										alert( 'Đã có lỗi' );
									}
								}
							);
						}
					}

				}
			);

			$( '.popup_content_analysis_stock' ).click(
				function() {
					var data_id = $( this ).attr( 'data-id' );
					$.ajax(
						{
							type: "POST",
							dataType : "json",
							url: ajaxurl,
							data: {
								'action': 'ajax_content_analysis_stock',
								data_id:data_id,
							},
							beforeSend:function(response){
								$( '#loader' ).removeClass( 'hidden' );
								jQuery( '#popup_content_analysis_stock .result-content' ).html( 'Loading.............' );
							},
							success: function(response){
								$( '#popup_content_analysis_stock .result-content' ).html( response.data );
							},
							complete: function(){
								$( '#loader' ).addClass( 'hidden' );
							},
							error: function( jqXHR, textStatus, errorThrown ){
								// Làm gì đó khi có lỗi xảy ra
								console.log( 'The following error occured: ' + textStatus, errorThrown );
							}
						}
					);

				}
			);

			$( ".snt-form input" ).keyup(
				function(){
					$( ".edit_profile_submit" ).css( {"background-color": "#FFC629", "color": "#101828"} );
				}
			);

			$( '#notice, #popUp-notifi.popUp #close' ).on(
				'click',
				function(){
					$( '#popUp-notifi.popUp' ).toggleClass( 'show' );
					updatenotice();
				}
			);
			$( '#notice-news, #popUp-news.popUp #close' ).on(
				'click',
				function(){
					$( '#popUp-news.popUp' ).toggleClass( 'up' );
				}
			);

			// format tiền
			// $('span.price').number(true,2);
			// $( 'span.price' ).divide(
			// 	{
			// 		delimiter:'.',
			// 		divideThousand:true,// 1,000..9,999
			// 		delimiterRegExp: / [\.\,\s] /g
			// 	}
			// );

			// Affiliate js.
			var btn_copy_code  = $( document ).find( '.btn-act-copy' );
			var btn_apply_code = $( document ).find( '.btn-act-apply' );
			if ( 1 <= btn_copy_code.length ) {
				btn_copy_code.on(
					'click',
					function() {
						var curr_btn = $( this );
						var $temp    = $( "<input>" );
						$( "body" ).append( $temp );
						var $input_val_el = btn_copy_code.parent().find( 'input.referral-code-input' );
						$temp.val( $input_val_el.val() ).select();
						document.execCommand( "copy" );
						$temp.remove();

						curr_btn.text( 'Đã sao chép' );
						setTimeout(
							function() {
								curr_btn.text( 'Sao chép' );
							},
							2000
						);
					}
				);
			}

			if ( 1 <= btn_apply_code.length ) {
				btn_apply_code.on(
					'click',
					function() {
						var curr_btn        = $( this );
						var curr_code_input = btn_apply_code.parent().find( 'input.referral-code-input' );
						var curr_code       = curr_code_input.val();

						if ( '' === curr_code ) {
							curr_code_input.addClass( 'invalid' );
							return;
						}

						$.ajax(
							{
								type: "POST",
								url: ajaxurl,
								data: {
									action: 'apply_referral_code',
									code: curr_code,
									nonce: cfa99_vars.nonce
								},
								beforeSend: function() {
									var loading_tpl = '<div class="lds-ring"><div></div><div></div><div></div><div></div></div>';
									
									curr_btn.addClass('is-loading');
									curr_btn.prepend(loading_tpl);
									curr_btn.prop( 'disabled', true );
								},
								success: function(res) {
									if ( res.success ) {
										swal(
											{
												title: res.data.message.trim(),
												type: "success",
											}
										);

										curr_btn.prop( 'disabled', true );
										curr_code_input.prop( 'disabled', true );
									} else {
										swal(
											{
												title: res.data.message.trim(),
												type: "error",
											}
										);
										curr_btn.prop( 'disabled', false );
									}

									curr_btn.removeClass('is-loading');
									curr_btn.addClass('is-complete');
									curr_btn.find('.lds-ring').remove();
									curr_code_input.removeClass( 'invalid' );
								},
							}
						);
					}
				);
			}

			if(jQuery('td span.price').length > 0){
				jQuery("td span.price").each(function(){
				
					var price = $(this).text();
					
					if(price.match(/\./g) != true){
						jQuery(this).text(price.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
					}
					
				});
			}
	
		
			

			


		}
	);


	$( '.read-full' ).click(
		function() {

			$.ajax(
				{
					type: "POST",
					url: ajaxurl,
					data: {
						'action': 'readfull',
						dataid:$( this ).attr( 'data-id' ),
					},
					beforeSend:function(response){
						$( '#loader' ).removeClass( 'hidden' )
					},
					success: function(response){
						if (response.success) {
							console.log( response.data );
							$( '.content' ).html( response.data );
						} else {
							alert( response.data );
						}
					},
					complete: function(){
						$( '#loader' ).addClass( 'hidden' )
					},
					error: function (response) {

					}
				}
			);

		}
	);
	function updatenotice()
	{

		$.ajax(
			{
				type: "POST",
				url: ajaxurl,
				data: {
					'action': 'readnotice'
				},
				beforeSend:function(response){
				},
				success: function(response){
					if (response.success) {
						console.log( response.data );
						$( '.have-notice' ).text( '0' );
					} else {
						alert( response.data );
					}
				},
				complete: function(){
				},
				error: function (response) {

				}
			}
		);

	}

	if(jQuery('#uptrend_stocks').length > 0){
		// jQuery('.cpxht-row table tr a[target="_blank"]').click(function() {
        //     window.open(this.href);
        //     return false;
        // });
        // jQuery('.cpxht-row table tr td').biggerlink({ otherstriggermaster: false });
	}



})( jQuery );


function isVietnamesePhoneNumber(number) {
	return /(([03+[2-9]|05+[6|8|9]|07+[0|6|7|8|9]|08+[1-9]|09+[1-4|6-9]]){3})+[0-9]{7}\b/g.test( number );
}
