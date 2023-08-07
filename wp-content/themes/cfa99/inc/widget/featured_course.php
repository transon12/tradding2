<?php
add_action('widgets_init', 'featured_course');

function featured_course() {
    register_widget('Featured_Course_Widget');
}

class Featured_Course_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'featured_course',
            __( 'A2Z - Khóa học nổi bật', 'shtheme' ),
            array( 
                'description'  =>  __( 'Hiển thị các khóa học nổi bật', 'shtheme' ),
            )
        );
        
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;

        if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
        ?>
        <div class="archive">
            <div class="row large-columns-1 medium-columns-1 small-columns-1">
                <?php
                $args = array(
                    'post_type' => 'lp_course',
                    'meta_query'    => array(
                        array(
                            'key'     => 'khoa_hoc_noi_bat',
                            'value'   => '1',
                            'compare' => 'LIKE'  ,
                        ),
                    ),
                    'posts_per_page' => $instance['numpro'],
                );
                $the_query = new WP_Query($args);
                while($the_query->have_posts()):
                $the_query->the_post();
                ?>
                    <div class="col post-item">
                        <div class="col-inner">
                            <a href="<?php the_permalink() ?>" class="plain">
                                <div class="box box-text-bottom box-blog-post has-hover">
                                    <div class="box-image">
                                        <div class="image-cover" style="padding-top:56%;">
                                            <?php the_post_thumbnail('full'); ?>
                                        </div>
                                    </div>
                                    <div class="box-text text-left">
                                        <div class="box-text-inner blog-post-inner">
                                            <h5 class="post-title is-large ">
                                                <?php the_title() ?>
                                            </h5>
                                            <div class="from_the_blog_excerpt ">
                                                <?php the_excerpt( ); ?>
                                            </div>
                                            <?php do_action('flatsome_blog_post_after'); ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args( 
        	(array)$instance, array( 
            		'title' 			=> '', 
            		'numpro' 			=> '3', 
        		) 
        	);
        ?>
        <p>
            <label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php  echo $this->get_field_name('title'); ?>" value="<?php  echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <p>
            <label for="<?php  echo $this->get_field_id('numpro'); ?>"><?php _e('Number of Posts to Show', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('numpro'); ?>" name="<?php  echo $this->get_field_name('numpro'); ?>" value="<?php  echo esc_attr( $instance['numpro'] ); ?>" />
        </p>       

    <?php
    }
}