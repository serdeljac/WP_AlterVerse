<?php
/**
 * Template used to display post content in a section.
 *
 * @package storefront
 */

?>

<div id="post-<?php the_ID(); ?>" class="section__post">

	<?php
	do_action( 'av_evpost_content' );

	?>

</div><!-- #post-## -->
