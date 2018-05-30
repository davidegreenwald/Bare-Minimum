<?php

/**
 * Functions.php is the home of code used across the theme and can enable
 * functionality in the WordPress dashboard menu such as featured images and
 * sidebars.
 *
 *
 * Resources: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * Table of Contents:
 * #SETUP - Theme basic set-up and functionality
 * #SCRIPTS - Enqueue styles and scripts
 * #MENUS - Register menus
 * #WIDGETS - Enqueue widget areas (sidebars and footers)
 *
 * In a more extensive theme, you would split these sections into
 * individual .php files in an "includes" or "inc" folder
 */

/* =============================================================================
   #SETUP - Theme basic set-up and functionality
*/

// Make all functions "pluggable" with if wrappers so a child theme can override
if ( ! function_exists( 'bareminimum_setup' ) ) {
	function bareminimum_setup() {

		// Let WordPress automatically generate the <head>'s <title> tag for SEO
		add_theme_support( 'title-tag' );

		// Add RSS feed links to the document <head>
		add_theme_support( 'automatic-feed-links' );

	  /**
		 * Enable featured images (post thumbnails), commonly displayed on index,
		 * archive, and blog pages and also used as the thumbnail image when sharing
		 * to social media
		 */
		add_theme_support( 'post-thumbnails' );

		/**
     * Update default WordPress core markup tags to modern HTML5 code for this
		 * array of items - comments, search form, gallery images, photo captions
		 */
	  add_theme_support( 'html5', array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption' )
		);

		/**
	   * Add theme support for selective refresh for widgets to allow
		 * Customizer editing without a full page reload.
		 *
		 * Not strictly "bare minimum" but basic and nice to have
	   */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
	   * Other common functions you might add here:
		 * Post formats (a la Tumblr style)
		 * Content width
		 * Custom Theme background (color or image)
		 * Custom Header
		 * Custom Logo
		 * Additional image sizes
	   */
	}
	add_action( 'after_setup_theme', 'bareminimum_setup' );
} // don't forget to close the pluggable if statement

/* =============================================================================
   #SCRIPTS - Enqueue styles and scripts
*/

if ( ! function_exists( 'bareminimum_enqueue_scripts' ) ) {
	function bareminimum_enqueue_scripts() {
		// Load main stylesheet
		wp_enqueue_style( 'style', get_stylesheet_uri() );

		// naturally we can load jQuery and any other scripts from here
	}
	add_action( 'wp_enqueue_scripts', 'bareminimum_enqueue_scripts' );
}

/* =============================================================================
   #MENUS - Register menus
*/

// Register main menu
function bareminimum_register_menus() {
  register_nav_menu( 'main_menu', 'Main Menu' );
}
add_action( 'after_setup_theme', 'bareminimum_register_menus' );

/* Print this menu in the theme template by copying this code:

  <?php if (has_nav_menu( 'main_menu') :
          wp_nav_menu(array('theme_location' => 'main_menu'));
        endif; ?>

*/

/* =============================================================================
   #WIDGETS - Enqueue widget areas (sidebars and footers)
*/

function bareminimum_register_widget_areas() {

  // Add whatever wrappers and classes you need for styling
  // The before/after keys have WordPress defaults and can be skipped

  $footer = array(
	  'name'          => 'Footer widgets', // Displays in the WP dashboard
	  'id'            => 'footer_widgets', // must be lowercase
	  'description'   => '',
	  'before_widget' => '<div>',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h2>',
	  'after_title'   => '</h2>',
  );
  register_sidebar( $footer );

/* Print this widget space in a theme template page by copying this code:

	<?php if ( is_active_sidebar( 'footer_widgets' ) ) :
          dynamic_sidebar( 'footer_widgets' );
        endif; ?>

*/

  $sidebar = array(
	  'name'          => 'Sidebar',
	  'id'            => 'sidebar_widgets',  // must be lowercase
	  'description'   => '',
	  'before_widget' => '<div>',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h2>',
	  'after_title'   => '</h2>',
  );
  register_sidebar( $sidebar );

}
add_action( 'widgets_init', 'bareminimum_register_widget_areas' );
