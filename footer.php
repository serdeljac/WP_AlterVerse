<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer av__footer" role="contentinfo">


			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			//do_action( 'storefront_footer' );
			?>
		<div class="av__grid-col-3 av__grid--small">
			<div class="grid__img-container">
				<img src="https://www.alter-verse.com/wp-content/uploads/2019/06/alterverse2.png" alt="Alter-verse" />
			</div>
			<div>
				<ul>
					<li>My Account</li>
					<li><a href="<?php echo get_site_url(); ?>">Home</a></li>
					<li><a href="<?php echo get_site_url(); ?>/ev">Our Shop</a></li>
					<li><a href="<?php echo get_site_url(); ?>/about">About Us</a></li>
					<li><a href="<?php echo get_site_url(); ?>/contact">Contact Us</a></li>
				</ul>
			</div>
			<div class="footer_contact-us">
				Contact Us:
				<ul>
					<li>Phone: 778-863-2742</li>
					<li>Email: <a href="mailto:info@alter-verse.com">info@alter-verse.com</a></li>
					<li>Address: <br />Suite 273, 407 552 Clarke Road <br />
							Coquitlam B.C., V3J 0A3</li>
					<li>
						<a href="https://www.facebook.com/Alter-verse-Electric-Vehicles-Inc-571295620026829">
							<img src="https://www.alter-verse.com/wp-content/uploads/2019/05/iconmonstr-facebook-2-240.png" />
						</a>
						<a href="https://twitter.com/AlerVerse" target="_blank">
							<img src="https://www.alter-verse.com/wp-content/uploads/2019/05/iconmonstr-twitter-2-240.png" />
						</a>
					</li>
				</ul>

			</div>
		</div>

	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
