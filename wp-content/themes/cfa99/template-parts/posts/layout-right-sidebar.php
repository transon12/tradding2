<?php
	do_action('flatsome_before_blog');
?>

<section class="section p-0 snt-single">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content">
                <div class="snt-auto">
                    <div class="col-inner snt-single-post">

						<section class="section px">
							<div class="section-content relative">
								<div class="row row-small nobottom">
									<div class="col medium-8 small-12 large-8 snt-article">
										<div class="col-inner">
                                            <div class="back">
                                                <a href="#" onclick="window.history.go(-1); return false;">
                                                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M17 7H1M1 7L7 13M1 7L7 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                    <div>Tất cả<?php if(get_the_category()){echo '&nbsp;<span style="text-transform: lowercase;">'.get_the_category( $id )[0]->name.'</span>';}else{echo 'tin tức';}?></div>
                                                </a>
                                            </div>
                                            <div class="post-meta">
                                                <div class="post-author">
                                                    Đăng bởi <span style="color:#EDB62B;">
                                                        <?php 
                                                            $author_id = get_post_field ('post_author', get_the_ID());
                                                            $display_name = get_the_author_meta( 'display_name' , $author_id ); 
                                                            echo $display_name;
                                                        ?>
                                                    </span>
                                                </div>
                                                <div class="post-date">
                                                    Cập nhật: <?php echo get_the_date();?>
                                                </div>
                                            </div>
                                            <?php echo do_shortcode( '[share]' );?>
                                            <header class="entry-header">
                                                <h1 class="entry-title">
                                                    <?php echo get_the_title();?>
                                                </h1>
                                            </header>
                                            <div class="entry-content">
                                                <?php echo the_content();?>
                                            </div>
										</div>
									</div>
									<div class="col medium-4 small-12 large-4 snt-rightbar">
										<div class="col-inner">
											<?php flatsome_sticky_column_open( 'blog_sticky_sidebar' ); ?>
											<?php dynamic_sidebar( 'sidebar-market-analyst' ); ?>
											<?php flatsome_sticky_column_close( 'blog_sticky_sidebar' ); ?>
										</div>
									</div>
								</div>
							</div>
						</section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
	do_action('flatsome_after_blog');
?>
