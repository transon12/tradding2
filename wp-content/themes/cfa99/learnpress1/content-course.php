<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="course-item">
		<?php

		/**
		 * LP Hook
		 *
		 * @since 3.0.0
		 *
		 * @called loop/course/thumbnail.php
		 * @echo DIV tag
		 */
		do_action( 'learn-press/before-courses-loop-item' );
		?>

		<a href="<?php the_permalink(); ?>" class="course-permalink">

			<?php
			/**
			 * @since 3.0.0
			 *
			 * @called loop/course/title.php
			 */
			do_action( 'learn-press/courses-loop-item-title' );
			?>

		</a>

		<div class="courses-text-box">
			<div class="courses-date d-flex align-items-center">
				<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z" fill="#475467"/>
				</svg>
				<div><?php echo get_the_date('d-m-Y');?></div>
			</div>
		</div>
	</div>
</li>
