<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */
$region = $_COOKIE['site_region'];
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<!-- Global site tag (gtag.js) - Google Analytics --> <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131500259-1"></script> <script>   window.dataLayer = window.dataLayer || [];   function gtag(){dataLayer.push(arguments);}   gtag('js', new Date());    gtag('config', 'UA-131500259-1'); </script>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131500259-1"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-131500259-1'); </script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> <script>   (adsbygoogle = window.adsbygoogle || []).push({     google_ad_client: "ca-pub-3449483340649473",     enable_page_level_ads: true   }); </script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131500259-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131500259-1');



</script>

</head>

<body <?php body_class(); ?>>
  <div class="av-login-region__bar">
    <div class="region-select">
      <div class="region__flag">
        <img class="region-flag__display" src="https://www.alter-verse.com/wp-content/uploads/2019/04/region-<?php echo $region; ?>.jpg"/>
      </div>
      <select name="region" class="region__container">
        <option value="can">CAN</option>
        <option value="usa">US</option>
        <option value="eur">EUR</option>
        <option value="inr">INR</option>
      </select>
    </div>
  </div>

<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header header" role="banner" style="<?php storefront_header_styles(); ?>">




		<?php
		/**
		 * Functions hooked into storefront_header action
		 *
		 * @hooked storefront_header_container                 - 0
		 * @hooked storefront_skip_links                       - 5
		 * @hooked storefront_social_icons                     - 10
		 * @hooked storefront_site_branding                    - 20
		 * @hooked storefront_secondary_navigation             - 30
		 * @hooked storefront_product_search                   - 40
		 * @hooked storefront_header_container_close           - 41
		 * @hooked storefront_primary_navigation_wrapper       - 42
		 * @hooked storefront_primary_navigation               - 50
		 * @hooked storefront_header_cart                      - 60
		 * @hooked storefront_primary_navigation_wrapper_close - 68
		 */
		//do_action( 'av_storefront_header' );

		/**
		 *	Custom header
		 *	recbrickreative.com
		 *	2019-02-20
		 *
		 */
		do_action( 'av_storefront_header' );
    ?>

	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */
	do_action( 'storefront_before_content' );

	if(is_front_page()) :
	?>
  <div class="hero hero--home">
    <div class="col-full hero__grid">

      <div class=""></div>

      <div class="hero__info">
        <h1 class="hero__headline">
          Are you looking for an electric vehicle?
        </h1>
        <p class="hero__description">
          Search our directory of EV's from your favorite manufacturers...
        </p>
      </div>

      <div class="av_grid__models">
        <div class="av_hero__explore">
            <a href="<?php echo get_site_url();?>/ev" onclick="filter('')">
              <p>Explore our vehicles</p>
            </a>
        </div>
        <div>
          <a href="<?php echo get_site_url();?>/ev" onclick="filter('make_audi')">
            <img src="https://www.alter-verse.com/wp-content/uploads/2019/05/logo-audi.png" alt="audi" />
          </a>
        </div>
        <div>
          <a href="<?php echo get_site_url();?>/ev" onclick="filter('make_bmw')">
            <img src="https://www.alter-verse.com/wp-content/uploads/2019/05/logo-bmw.png" alt="bmw" />
          </a>
        </div>
        <div>
          <a href="<?php echo get_site_url();?>/ev" onclick="filter('make_mahindra')">
            <img src="https://www.alter-verse.com/wp-content/uploads/2019/05/logo-mahindra.png" alt="mahindra" />
          </a>
        </div>
        <div>
          <a href="<?php echo get_site_url();?>/ev" onclick="filter('make_nissan')">
            <img src="https://www.alter-verse.com/wp-content/uploads/2019/05/logo-nissan.png" alt="nissan" />
          </a>
        </div>
        <div>
          <a href="<?php echo get_site_url();?>/ev" onclick="filter('make_tesla')">
            <img src="https://www.alter-verse.com/wp-content/uploads/2019/05/logo-tesla.png" alt="tesla" />
          </a>
        </div>
      </div>

    </div>
  </div>
	<?php endif; ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full av-full-width ">

		<?php
		do_action( 'storefront_content_top' );
