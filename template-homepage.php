<?php
/*
Template Name: Home Page
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<!-- SECTION: Random Featured Cars -->
			<section class="section section__featured">
				<div class="section__wrapper">
					<h2 class="av__heading-h2">Featured Vehicles</h2>
					<div class="av__grid-col-3">
						<?php	av_section_feature(); ?>
					</div>
				</div>
			</section>

			<!-- SECTION: Mission Statement -->
			<!-- <section class="section section__mission">
				<div class="mission__bg-overlay">
					<div class="section__wrapper">
						<div class="mission__grid">
							<div class="mission__promo-image"></div>
							<div class="mission__catagory mission__catagory-main">
								<h2 class="mission__h2">Who Are We?</h2>
								<p class="mission__p">A directory committed to helping you connect with your dream electric vehicle. Alter-verse.com is dedicated to providing contemporary and detailed information on electric vehicles from different manufacturers, from different countries all over the world.</p>
							</div>
							<div class="mission__catagory">
								<h2 class="mission__h2">Our Mission</h2>
								<p class="mission__p">To be the world's leading EV directory providing inimitable up-to-date information on all electric vehicles.</p>
							</div>
							<div class="mission__catagory">
								<h2 class="mission__h2">Our Vision</h2>
								<p class="mission__p">Going the extra mile to provide useful information to consumers in the market for electric vehicles.</p>
							</div>
						</div>
					</div>
				</div>
			</section> -->

			<!-- SECTION: Advertisement -->
			<!-- <section class="section section__advertisement">
				<div class="section__wrapper">
					<div class="av__grid-col-2">
						<div class="advertisement__ad">Advertisement 1</div>
						<div class="advertisement__ad">Advertisement 2</div>
					</div>
				</div>
			</section> -->

			<section class="section_woocommerce">
				<div class="section__wrapper">
					<ul class="products">
						<?php
							$args = array(
								'post_type' => 'product',
								'posts_per_page' => 3
								);
							$loop = new WP_Query( $args );
							if ( $loop->have_posts() ) {
								while ( $loop->have_posts() ) : $loop->the_post();
									wc_get_template_part( 'content', 'product' );
								endwhile;
							} else {
								echo __( 'No products found' );
							}
							wp_reset_postdata();
						?>
					</ul>
				</div>
			</section>

			<!-- SECTION: Login/Signup -->
			<section class="section section__login">
				<div class="section__wrapper">
					<div class="av__grid-col-3 login__grid">
						<div></div>
						<div class="login__content">
							<h2 class="login__h2">Sign up to our newsletter</h2>
							<p class="login__p">Get the latest news, stories, and offers on all electric vehicles</p>
						</div>
						<div class="login__form">
							<!-- <form>
							  <fieldset>
							    <legend>Signup</legend>
							    Username:<br>
							    <input type="text" name="username">
							    <br>
							    Password:<br>
							    <input type="text" name="password">
							    <br><br>
							    <input type="submit" value="Submit">
							  </fieldset>
							</form> -->
							<!-- Begin Mailchimp Signup Form -->
							<div id="mc_embed_signup" class="login__form">
								<form action="https://gmail.us20.list-manage.com/subscribe/post?u=8ba07cb4f75820e4531c9111a&amp;id=09f0614fbf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
									<div id="mc_embed_signup_scroll">
										<div class="mc-field-group">
											<label for="mce-EMAIL">Email Address</label>
											<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
										</div>
										<div class="mc-field-group">
											<label for="mce-FNAME">Username</label>
											<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
										</div>
										<div id="mce-responses" class="clear">
											<div class="response" id="mce-error-response" style="display:none"></div>
											<div class="response" id="mce-success-response" style="display:none"></div>
										</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
										<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_8ba07cb4f75820e4531c9111a_09f0614fbf" tabindex="-1" value=""></div>
										<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
									</div>
								</form>
							</div>

							<!--End mc_embed_signup-->
						</div>
					</div>
				</div>
			</section>

			<!-- SECTION: News Articles -->
			<section class="section section__news">
				<div class="section__wrapper">
					<h2 class="av__heading-h2">Latest News</h2>
					<div class="av__grid-col-3">
						<?php av_section_news();?>
					</div>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();
