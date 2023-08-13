<?php
/*
	Template Name: Affiliate
*/
// if ( ! is_user_logged_in() ) {
// 	wp_safe_redirect( home_url( 'dang-nhap' ) );
// 	exit;
// }

get_header();

global $current_user;

$id      = $current_user->membership_level->ID;
$time    = $current_user->membership_level->enddate;
$level   = $current_user->membership_level->name;
$user_id = $current_user->ID;
$idstock = array();

$data = $wpdb->get_results( "SELECT * FROM bookmark WHERE user_id = $user_id" );

if ( ! empty( $data ) ) {
	foreach ( $data as $key ) {
		$idstock[] = $key->id_stock;
	}
}

?>

<section class="section p-0 account-frontpage snt">
	<div class="bg section-bg fill bg-fill bg-loaded">
	</div>
	<div class="section-content relative">
		<div class="row row-collapse row-full-width">
			<div class="col medium-4 small-12 large-3 snt-sidebar">
				<div class="col-inner">
				<?php echo do_shortcode( '[ux_sidebar id="menu-sidebar" class="menu__sidebar"]' ); ?>
				</div>
			</div>
			<div class="col medium-8 small-12 large-9 snt-main-content">
				<div class="snt-auto">
					<div class="col-inner">
						<div class="snt-account-tab ">
							<div class="panel entry-content active">
								<div class="tab_inner">
									<?php
										if(is_user_logged_in()){
											echo do_shortcode('[slicewp_affiliate_account]');
										}else{
											echo '<div class="px-20">';
											the_content();
											echo '</div>';
										}
									?>
								</div>
							</div>
						</div>   
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
