<?php
/**
 * Template used to display post content in a section.
 *
 * @package storefront
 */

?>

	<div id="post-<?php the_ID(); ?>" class="av__grid-row-3">

		<?php
		do_action( 'av_evpost_content' );
		?>

	</div><!-- #post-## -->
