<?php
/**
 * Template for displaying course sidebar.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hide sidebar if there is no content
 */
if ( ! is_active_sidebar( 'course-sidebar' ) && ! LP()->template( 'course' )->has_sidebar() ) {
	return;
}
?>


