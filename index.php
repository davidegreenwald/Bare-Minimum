<?php
  /**
	 * This single template includes a home (blog) page, a single page, search
	 * results, and a 404 page.
	 */
?>

<? // This section would usually go in a header.php file
   // And you would call it here with get_header();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php
		// https://developer.wordpress.org/reference/functions/bloginfo/
		// Encoding for pages and feeds” set in Settings > Reading
		// Defaults to UTF-8
		?>
	  <meta charset="<?php bloginfo( 'charset' ); ?>">

		<?php // for Internet Explorer 8-10, remove if unnecessary ?>
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<?php // Allow proper zooming and resizing ?>
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<?php
		/**
		 * WordPress action hook to load <head> scripts and headers. Must include
		 * for proper WP functionality. Same deal with wp_footer() below.
		 */
		 ?>
	  <?php wp_head(); ?>
	</head>

	<?php // The WP body_class() adds helpful bonus classes to the body tag ?>
  <body <?php body_class(); ?>>
		<?php // a skiplink should go here for accessibility, btw ?>
    <header>

		<?php
		/**
		 * Wrap the Site Title in H1 tags for SEO only on the home or main page
     * bloginfo( 'name' ) echoes the Site Title from Settings > General
		 * https://developer.wordpress.org/reference/functions/bloginfo/
		 */
		 ?>
	   <?php
		   if ( ! ( is_front_page() || is_home() ) ):
		     bloginfo( 'name' );
		   else: ?>
		 <h1><?php bloginfo( 'name' ); ?></h1>
	   <?php endif; ?>

		<?php
		 /**
      * Echo Tagline from Settings > General in the WP dashboard
		  * https://developer.wordpress.org/reference/functions/bloginfo/
      */
		?>
		<p><?php bloginfo('description'); ?></p>

		<?php // Display our main menu registered in functions.php if it has content ?>
    <?php if (has_nav_menu( 'main_menu')) : ?>
		<nav><?php wp_nav_menu(array('theme_location' => 'main_menu')); ?></nav>
    <?php endif; ?>

	  </header>
    <main id="main">
		<?php // end of what could go into header.php ?>

		  <?php
		  // Check if there are posts or pages to display
	    if ( have_posts() ) :
	    ?>
      <section>

      <?php
			// Begin the loop to show all matching posts or pages
			while ( have_posts() ) :
				// The post function starts and moves the loop ahead one post at a time
				the_post(); ?>

        <?php
        // single page or post view:
        if ( is_single() || is_page() ) :
        ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>
              <?php the_category(); ?>
              <h1><?php the_title(); ?></h1>
              <p><?php the_author(); ?></p>
              <p><?php the_date(); ?></p>
            </header>
            <div>
              <?php the_content(); ?>
            </div>
            <footer>
              <?php the_tags(); ?>
            </footer>
          </article>

	      <?php
        // Feed, archive, blog view
        else : ?>

		    <?php
				// Set up a page title for search results only
				if (is_search()) : ?>
          <h1>Search results for <?php the_search_query(); ?>:</h1>
        <? endif; ?>

		    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header>
            <figure><?php the_post_thumbnail(); ?></figure>
            <a href="<?php the_permalink(); ?>">
              <h2><?php the_title(); ?></h2>
            </a>
            <p><?php the_author(); ?></p>
            <p><?php the_date(); ?></p>
          </header>
          <div>
            <?php the_excerpt(); ?>
          </div>
        </article>
      <?php endif; // end content
		        endwhile; // close the loop ?>
      </section>
    <?php else: ?>
      <?php
			  // 404 page if no page content or search refults
				if( is_404()) : ?>
        <p>Sorry, we couldn't find your page.</p>
      <?php endif; ?>
  <?php endif; // end have_posts() conditional ?>

    <aside>
    <?php if ( is_active_sidebar( 'sidebar_widgets' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar_widgets' ); ?>
      <?php endif; ?>
	  </aside>

	  <?php
		// This end section would normally go in footer.php
		// and you would call it with get_footer();
		?>

		<?php // close the main tag and content and begin the footer ?>
    </main>
    <footer>

			<?php
			/**
       * Call our registered sidebar from functions.php
			 * but only if it has live widgets, testing with is_active_sidebar()
			 */
			?>
      <?php if ( is_active_sidebar( 'footer_widgets' ) ) : ?>
        <?php dynamic_sidebar( 'footer_widgets' ); ?>
      <?php endif; ?>

    </footer>

  <?php
	/**
	 * Close with another action hook for plugin and core script files
	 * The Twenty Seventeen theme places wp_footer() below </footer>
	 * so we will follow their lead and put it here at the very bottom.
	 */
	?>
  <?php wp_footer(); ?>
  </body>
</html>
