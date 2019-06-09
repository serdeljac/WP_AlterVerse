<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					// the_archive_title( '<h1 class="page-title archive-site__title">', '</h1>' );
					// the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="section__archive section__wrapper">
				<div class="av__grid-col-3">
				<?php
				//Append Filter Section
				av_search_filter();

				// av_archive_feature();


			// 	// get_template_part( 'loop' );
	    //   while ( have_posts() ) :
			// 		the_post();
			//
	    //   	/**
	    //   	 * Include the Post-Format-specific template for the content.
	    //   	 * If you want to override this in a child theme, then include a file
	    //   	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	    //   	 */
			//
			//
	    //     av_post_content();
	    //   	// get_template_part( 'content', get_post_format() );
			//
	    //   endwhile;
	    //   // archive_ev_content();
			// 	wp_reset_postdata();
			//
			// else :
			//
			// 	get_template_part( 'content', 'none' );
			//
			endif;
			?>
			</div>
		</div>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
