<?php

  function my_theme_enqueue_styles() {
    wp_enqueue_style( 'alter-verse-style', get_stylesheet_uri() . '/style.css' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/ev_java.js', array ( 'jquery' ), null, true );
    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/ev_java_region.js', array ( 'jquery' ), null, false );
    }

  function add_google_fonts() {
    wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Roboto:400,700', false );
    }

  add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
  add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

/* ---------------------------------------------------------------------- */

/**
 *
 *
 * CPT -- EV Post
 *
 */

function av_cpt_evpost() {
	$supports = array(
		'title', // post title
		'editor', // post content
		//'author', // post author
		'thumbnail', // featured images
		//'excerpt', // post excerpt
		//'custom-fields', // custom fields
		//'comments', // post comments
		//'revisions', // post revisions
		//'post-formats', // post formats
	);

	$labels = array(
		'name' => _x('Electric Vehicles', 'plural'),
		'singular_name' => _x('Electric Vehicle', 'singular'),
		'menu_name' => _x('Electric Vehicles', 'admin menu'),
		'name_admin_bar' => _x('Electric Vehicles', 'admin bar'),
		'add_new' => _x('Add New', 'add new'),
		'add_new_item' => __('Add New Electric Vehicle'),
		'new_item' => __('New Electric Vehicles'),
		'edit_item' => __('Edit Electric Vehicles'),
		'view_item' => __('View Electric Vehicles'),
		'all_items' => __('All Electric Vehicles'),
		'search_items' => __('Search Electric Vehicles'),
		'not_found' => __('No Electric Vehicles found.'),
	);

	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'taxonomies' => array('post_tag'),
		'rewrite' => array('slug' => 'ev'),
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
	);
	register_post_type('ev', $args);
}
add_action('init', 'av_cpt_evpost');

/* ---------------------------------------------------------------------- */


/**
 *
 *
 * Spec Metabox and Main Info Metabox for EV post
 *
 */
/**
* Meta box display callback.
*
* @param WP_Post $post Current post object.
*/

function ev_specs_display_callback( $post ) {
  include plugin_dir_path( __FILE__ ) . './meta-specs-form.php';
}

function ev_main_info_display_callback( $post ) {
  include plugin_dir_path( __FILE__ ) . './meta-main-info-form.php';
}

function ev_specs_register_meta_boxes() {
  add_meta_box( 'ev_specs', __( 'EV Specs', 'ev_specs' ), 'ev_specs_display_callback', 'ev', 'side' );
}
add_action( 'add_meta_boxes', 'ev_specs_register_meta_boxes' );

function ev_main_info_register_meta_boxes() {
  add_meta_box( 'ev_main_info', __( 'Main info', 'ev_main_info' ), 'ev_main_info_display_callback', 'ev', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ev_main_info_register_meta_boxes' );








/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function ev_save_meta_box( $post_id ) {

	if( 'ev' != get_post_type( $post_id ) )
  return;

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
  return;

  if (get_post_status($post_id) === 'auto-draft') {
    return;
	}

  $fields = [
  	'ev_info__make',
		'ev_info__model',
		'ev_info__start-year',
    'ev_info__end-year',
		//'ev_info__price-usd',           //To be removed later
    'ev_info__price-cad',
    // 'ev_info__price-euro',          //To be removed later
    // 'ev_info__price-inr',           //To be removed later
		'ev_info__url',
    'ev_info__feature',
    'ev_info__description',
		'ev_specs__seating',
		// 'ev_specs__voltage',            //To be removed later
		'ev_specs__voltage-new',
		'ev_specs__body',
		'ev_specs__doors',
  	'ev_specs__chargetime',
    // 'ev_specs__chargetime-new',
		'ev_specs__quickcharge',
		'ev_specs__batterytype',
		// 'ev_specs__maxspeed',           //To be removed later
		'ev_specs__maxspeed-metric',
		// 'ev_specs__range',              //To be removed later
    'ev_specs__range-metric'
  ];





  foreach ( $fields as $field ) {
    if ( array_key_exists( $field, $_POST ) ) {
        update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
    }
 	}

}




add_action( 'save_post', 'ev_save_meta_box' );

function set_post_title( $post ) {

	if( 'ev' != get_post_type( $post_id ) )
  return;

  ?>
    <script type="text/javascript">
	    jQuery(document).ready(function($) {
	    	$("#title").prop("readonly", true);
	    	$("#ev_info__make, #ev_info__model").on("input", function () {
	    		var $title = $("#ev_info__make").val() + ' ' + $("#ev_info__model").val();
	        $("#title").val($title);
	        //$("#title").focus();
	        //$("#title").blur();
	        //$(this).focus();
	      });
	    });
    </script>
    <?php
} // set_post_title
add_action( 'edit_form_after_title', 'set_post_title' );
/*
if ( isset($_GET['run_my_script']) && ! get_option('my_script_complete') ) {
    add_action('init', 'add_list', 10);
    //add_action('init', 'script_finished', 20);
}

function script_finished() {
    add_option('my_script_complete', 1);
    die("Script finished.");
}

function add_list( ) {
	$json = '
		[{"Year":"","MSRP":"","Title":"Arcimoto  SRK","Make":"Arcimoto","Model":"SRK","url":"https://www.arcimoto.com/","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"EEC Electric Tricycle Car FST-LM","Make":"EEC","Model":"Electric Tricycle Car FST-LM","url":"https://www.globalsources.com/si/AS/Eco-Autos/6008852030637/pdtl/EEC-Electric-Tricycle-Car/1147683688.htm","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Electra Meccanica  SOLO","Make":"Electra Meccanica","Model":"SOLO","url":"https://electrameccanica.com/solo/","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Epic Electric Vehicles  Torq Roadster","Make":"Epic Electric Vehicles","Model":"Torq Roadster","url":"","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Green Vehicles  Triac","Make":"Green Vehicles","Model":"Triac","url":"","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Nobe Nobe 100","Make":"Nobe","Model":"Nobe 100","url":"https://www.mynobe.com/","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Silence  PT2","Make":"Silence","Model":"PT2","url":"","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Sondors Sondors EV","Make":"Sondors","Model":"Sondors EV","url":"","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"SynergEthic\'s  Tilter","Make":"SynergEthic\'s","Model":"Tilter","url":"","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Toyota  i-ROAD","Make":"Toyota","Model":"i-ROAD","url":"https://www.toyota-europe.com/world-of-toyota/concept-cars/i-road","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Viu Viu EV","Make":"Viu","Model":"Viu EV","url":"http://www.tuvie.com/viu-3-wheel-electric-concept-car-for-2-persons/","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"WEEVIL WEEVIL EV","Make":"WEEVIL","Model":"WEEVIL EV","url":"http://www.weevil-ev.eu/#","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Zap!  Alias","Make":"Zap!","Model":"Alias","url":"","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Zap!  Xebra truck","Make":"Zap!","Model":"Xebra truck","url":"","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"Zap!  Xebra","Make":"Zap!","Model":"Xebra","url":"","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""},{"Year":"","MSRP":"","Title":"ZBee Electric Tuk Tuk Scooter","Make":"ZBee","Model":"Electric Tuk Tuk Scooter","url":"","Seating":"","Voltage":"","Body":"","Doors":"","Chargetime":"","Quickcharge":"","Batterytype":"","Maxspeed":"","Range":""}]
	';

	$array = json_decode($json, true);

	foreach ($array as $key => $value) {
		$post_id = wp_insert_post(array (
	   'post_type' => 'ev',
	   'post_content' => '',
	   'post_title' => $value["Title"],
	   'post_status' => 'publish',
			'comment_status'	=>	'closed',
			'ping_status'		=>	'closed',
		));
		if ($post_id) {
   	// insert post meta
			add_post_meta($post_id, 'ev_info__make', $value["Make"]);
			add_post_meta($post_id, 'ev_info__model', $value["Model"]);
			add_post_meta($post_id, 'ev_info__start-year', $value["Year"]);
			add_post_meta($post_id, 'ev_info__price', $value["MSRP"]);
			add_post_meta($post_id, 'ev_info__url', $value["url"]);
			add_post_meta($post_id, 'ev_specs__seating', $value["Seating"]);
			add_post_meta($post_id, 'ev_specs__voltage', $value["Voltage"]);
			add_post_meta($post_id, 'ev_specs__body', $value["Body"]);
			add_post_meta($post_id, 'ev_specs__doors', $value["Doors"]);
			add_post_meta($post_id, 'ev_specs__chargetime', $value["Chargetime"]);
			add_post_meta($post_id, 'ev_specs__quickcharge', $value["Quickcharge"]);
			add_post_meta($post_id, 'ev_specs__batterytype', $value["Batterytype"]);
			add_post_meta($post_id, 'ev_specs__maxspeed', $value["Maxspeed"]);
			add_post_meta($post_id, 'ev_specs__range', $value["Range"]);

			wp_set_post_terms( $post_id, '3-wheel', 'post_tag');
		}
	}

}
*/


/* ---------------------------------------------------------------------- */


/**
 *
 *
 * Custom template functions
 *
 */





//Query ev posts for home page features (1 call)
if ( ! function_exists( 'av_section_feature' ) ) {
	/**
	 * Display single post within a section row
	 */
	function av_section_feature () {
		$args = array(
			'post_type' => 'ev',
      'orderby'   => 'rand',
    	'posts_per_page' => 3,
      'meta_key' => 'ev_info__feature',
      'meta_value' => 'enable'
		);

		$the_query = new WP_Query( $args );

		while ($the_query -> have_posts()) : $the_query -> the_post();

			/**
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */

			//get_template_part( 'content', 'ev' );
      // av_home_feature_news();
      av_post_content();
		endwhile;
		wp_reset_postdata();
	}
}

//Query three latest news articles from post, catagory='news' (1 call)
if ( ! function_exists( 'av_section_news' ) ) {
	/**
	 * Display single post within a section row
	 */
	function av_section_news () {

		$args = array(
			'category_name' => 'news',
    	'posts_per_page' => 3
		);
		$the_query = new WP_Query( $args );

		while ($the_query -> have_posts()) : $the_query -> the_post();

			/**
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			//get_template_part( 'content', 'ev' );
      av_home_feature_news();

		endwhile;
		wp_reset_postdata();

	}
}

//Display homepage features and news (2 call)
if ( ! function_exists( 'av_home_feature_news' ) ) {

	function av_home_feature_news () {

    $post_url = get_post_permalink($post->ID);

    $image_src = get_the_post_thumbnail_url( $post->ID, 'full' );
    if (!$image_src): $image_src = 'https://www.alter-verse.com/wp-content/uploads/2019/03/img-unavailable.jpg';
    endif;

		?>
      <div id="post-<?php the_ID(); ?>" class="av__grid-row-3">
        <div>
          <div class="av__feature">Featured</div>

          <a href="<?php echo $post_url ?>">
      	    <img src="<?php echo $image_src; ?>" alt="image" class="av__post-img"/>
          </a>
        </div>
        <div>
          <a href="<?php echo $post_url ?>">
            <?php the_title( '<h3 class="av__post-title">','</h3>' );?>
          </a>
          <a href="<?php echo $post_url ?>" target="_blank" class="more-info__visit button button--primary">
            View More
          </a>
        </div>
        <div class="home-news__content">
          <?php the_excerpt(); ?>
        </div>
      </div>
    <?php
	}
}

//Append search filter (2 call)
if ( ! function_exists( 'av_search_filter' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function av_search_filter() {
		?>

    <div class="av_filter">
      <div class="av_filter__search">
        <?php echo do_shortcode( '[searchandfilter fields="search" submit_label="Filter" class="archive-filter__plugin"]' ); ?>
      </div>
      <form class="av_filter__sort" method="post">
        <div>Sort By:</div>

          <div>
            <ul>
              <input type="radio" id="sort_model_asc" name="sortby" value="model_asc">
              <label for="sort_model_asc">Model <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
              <input type="radio" id="sort_model_desc" name="sortby" value="model_desc">
              <label for="sort_model_desc">Model <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
            </ul>
          </div>

          <div>
            <ul>
              <input type="radio" id="sort_year_asc" name="sortby" value="year_asc">
              <label for="sort_year_asc">Year <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
              <input type="radio" id="sort_year_desc" name="sortby" value="year_desc">
              <label for="sort_year_desc">Year <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
            </ul>
          </div>

          <div>
            <ul>
              <input type="radio" id="sort_range_asc" name="sortby" value="range_asc">
              <label for="sort_range_asc">Range <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
              <input type="radio" id="sort_range_desc" name="sortby" value="range_desc">
              <label for="sort_range_desc">Range <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
            </ul>
          </div>

          <div>
            <ul>
              <input type="radio" id="sort_price_asc" name="sortby" value="price_asc">
              <label for="sort_price_asc">Price <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
              <input type="radio" id="sort_price_desc" name="sortby" value="price_desc">
              <label for="sort_price_desc">Price <img src="https://www.alter-verse.com/wp-content/uploads/2019/04/triangle.png" /></label>
            </ul>
          </div>

          <div>
            <ul>
              <input type="radio" id="sort_feature" name="sortby" value="feature">
              <label for="sort_feature">Featured</label>
            </ul>
          </div>



      </form>

    </div>
		<?php

    $sortby = $_COOKIE['archive_sort'];
    $region = $_COOKIE['site_region'];

    $sort_currencies = [
      'usa' => 'usd',
      'can' => 'can',
      'eur' => 'euro',
      'inr' => 'inr'
      ];

    $usecurrency = $sort_currencies[$region];


    $sort_args = [
      //Default
      '' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'ASC',
        'posts_per_page'  => -1,
        'meta_query'      => array(
                          array(
                          'key' => 'ev_info__feature',
                          'value' => 'enable'
                            )
                          )
        ),
      'model_asc' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'ASC',
        'posts_per_page'  => -1
        ),
      'model_desc' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'DESC',
        'posts_per_page'  => -1
        ),
      'year_asc' => array(
        'post_type'       => 'ev',
        'meta_key'        => 'ev_info__start-year',
        'orderby'         => 'meta_value_num',
        'order'           => 'ASC',
        'posts_per_page'  => -1
        ),
      'year_desc' => array(
        'post_type'       => 'ev',
        'meta_key'        => 'ev_info__start-year',
        'orderby'         => 'meta_value_num',
        'order'           => 'DESC',
        'posts_per_page'  => -1
        ),
      'range_asc' => array(
        'post_type'       => 'ev',
        'meta_key'        => 'ev_specs__range-metric',
        'orderby'         => 'meta_value_num',
        'order'           => 'ASC',
        'posts_per_page'  => -1
        ),
      'range_desc' => array(
        'post_type'       => 'ev',
        'meta_key'        => 'ev_specs__range-metric',
        'orderby'         => 'meta_value_num',
        'order'           => 'DESC',
        'posts_per_page'  => -1
        ),

      'feature' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'ASC',
        'posts_per_page'  => -1,
        'meta_query'      => array(
                          array(
                          'key' => 'ev_info__feature',
                          'value' => 'enable'
                            )
                          )
        ),
      'feature_not' => array(
        'post_type'       => 'ev',
        'orderby'         => 'name',
        'order'           => 'ASC',
        'posts_per_page'  => -1,
        'meta_query'      => array(
                          array(
                          'key' => 'ev_info__feature',
                          'value' => ''
                            )
                          )
        ),
        'price_asc' => array(
          'post_type'       => 'ev',
          'meta_key'        => 'ev_info__price-cad',
          'orderby'         => 'meta_value_num',
          'order'           => 'ASC',
          'posts_per_page'  => -1
          ),
        'price_desc' => array(
          'post_type'       => 'ev',
          'meta_key'        => 'ev_info__price-cad',
          'orderby'         => 'meta_value_num',
          'order'           => 'DESC',
          'posts_per_page'  => -1
          ),

    ];




  av_archive_post($sort_args[$sortby]);


  if ($sortby == 'feature' || $sortby == '') {
    av_archive_post($sort_args['feature_not']);
    }
  }
}

//Get currency based on region
function currencyConversion($price) {
  $region = $_COOKIE['site_region'];
  $cad_to_usd = 0.74;
  $cad_to_euro = 0.66;
  $cad_to_inr = 52.08;

  if(!empty($price)) {
    if ($region == 'can') {
      return '$' . $price . '<span>CAD</span>';
      } else if ($region == 'usa') {
      return '$' . (round($price * $cad_to_usd, -2)) . '<span>USD</span>';
      } else if ($region == 'eur') {
      return '&euro;' . (round($price * $cad_to_euro, -2));
      } else if ($region == 'inr') {
      return '&#8377' . (round($price * $cad_to_inr, -2));
      }
    } else {
      return "Current price unavailable";
    }
  }

//Query archive posts that aren't 'featured' (1 call)
if ( ! function_exists( 'av_archive_post' ) ) {
	/**
	 * Display single post within a section row
	 */
	function av_archive_post($args) {


		$the_query = new WP_Query( $args );

		while ($the_query -> have_posts()) : $the_query -> the_post();

			/**
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */

			//get_template_part( 'content', 'ev' );
      av_post_content();

		endwhile;
		wp_reset_postdata();
	}
}

//Post indiviual vehicle in archive page (1 call)
if ( ! function_exists( 'av_post_content' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function av_post_content() {

    $region = $_COOKIE['site_region'];
    $archive_post_src = get_the_post_thumbnail_url();
    $archive_year = esc_attr( get_post_meta( get_the_ID(), 'ev_info__start-year', true ));
    $archive_range = esc_attr( get_post_meta( get_the_ID(), 'ev_specs__range-metric', true ));

    if (!$archive_post_src) : $archive_post_src = 'https://www.alter-verse.com/wp-content/uploads/2019/03/img-unavailable.jpg';
    endif;

    if (!$archive_year) : $archive_year = 'N/A';
    endif;

    if (!$archive_range == 0) {
      if ($region == 'usa') {
        $archive_range = $archive_range / 1.609;
        $archive_range = round($archive_range, -1);
        $archive_range = (string)$archive_range . ' miles';
      } else {
        round($archive_range, -2);
        $archive_range = (string)$archive_range . ' km';
      }
    } else {
      $archive_range = 'N/A';
    }

    $pull_price = esc_attr( get_post_meta( get_the_ID(), 'ev_info__price-cad', true ));
    $price = currencyConversion($pull_price);



		?>
  		<article id="post-<?php the_ID(); ?>" <?php post_class('av_archive__article'); ?>>
        <div class="archive__img" style="background-image:url(<?php echo $archive_post_src ?>)">

          <?php
            //ADD FEATURED TAG TO ARTICLE POST
            $get_featured = esc_attr( get_post_meta( get_the_ID(), 'ev_info__feature', true ));
            if ($get_featured == 'enable'):  echo '<div class="av__feature">Featured</div>';
            endif;
          ?>

        </div>

        <div class="archive__title">
          <?php
            if ( is_single() ) {
              the_title( '<h1 class="entry-title">', '</h1>' );
            } else {
              the_title( sprintf( '<h2 class="alpha entry-title av_archive_post__header"><a href="%s" rel="bookmark">'  , esc_url( get_permalink() ) ), '</a></h2>' );
            }
            //storefront_post_taxonomy();
          ?>
        </div>

        <div class="archive__specs">

          <div class="specs__display">
            <p class="archive-specs__p archive-specs__partition">
              <img class="archive-specs__img" src="https://www.alter-verse.com/wp-content/uploads/2019/03/iconfinder_calendar-date-events-schedule-time_3828108.png" alt="" />
              <?php echo $archive_year; ?>
            </p>
          </div>

          <div class="specs__display">
            <p class="archive-specs__p">
              <img class="archive-specs__img" src="https://www.alter-verse.com/wp-content/uploads/2019/04/work-tools.png" alt="" />
              <?php echo $archive_range;?>
            </p>
          </div>

          <div class="specs__display specs__display_price">
            <?php echo $price; ?>
          </div>

        </div>

        <div class="archive__post-link">
          <a href="<?php echo get_the_permalink();?>" class="view-post__button button button--primary">
            <p>View More</p>
          </a>
        </div>

      </article>
		<?php
	}
}

//Post single vehicle title (1 call)
if ( ! function_exists( 'av_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function av_post_header() {
		?>
		<header class="entry-header">
		<?php
		if ( is_single() ) {
			storefront_posted_on();
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			if ( 'post' == get_post_type() ) {
				storefront_posted_on();
			}

			the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}
		?>
		</header><!-- .entry-header -->
		<?php
	}
}

//Post individual specs of a vehicle (1 call)
if ( ! function_exists( 'av_post_content_single' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function av_post_content_single() {

    //Defaults
    $region = $_COOKIE['site_region'];
    $specs_checked = [];

    //Define specifications
    $specs = [
      'Seating' => 'ev_specs__seating',
      'Voltage' => 'ev_specs__voltage-new',
      'Body' => 'ev_specs__body',
      'Doors' => 'ev_specs__doors',
      'Charge Time' => 'ev_specs__chargetime',
      'Quick Charge' => 'ev_specs__quickcharge',
      'Battery Type' => 'ev_specs__batterytype',
      'Max Speed' => 'ev_specs__maxspeed-metric',
      'Range' => 'ev_specs__range-metric'
      ];

    $pull_price = esc_attr( get_post_meta( get_the_ID(), 'ev_info__price-cad', true ));
    $price = currencyConversion($pull_price);

    foreach ( $specs as $key => $value ) {
      $meta_value = esc_attr( get_post_meta( get_the_ID(), $value, true ));

      if (!empty($meta_value)) {
        if ($key == "Voltage") {
          $true_value = $meta_value . 'V';
          } else if ($key == 'Max Speed' && $region == 'usa') {
          $true_value = (round($meta_value * 0.621371, -1)) . 'mph';
          } else if ($key == 'Max Speed') {
          $true_value = $meta_value . 'km/h';
          } else if ($key == 'Range' && $region == 'usa') {
          $true_value = (round($meta_value * 0.621371, -1)) . 'miles';
          }else if ($key == 'Range') {
          $true_value = $meta_value . 'km';
          }else {
          $true_value = $meta_value;
          }
        $arr = array($key => $true_value);
        array_push($specs_checked, $arr);
        }
   	}



    //Check if an image exists, otherwise use default
    $image_post_src = get_the_post_thumbnail_url();
    if (!$image_post_src): $image_post_src = 'https://www.alter-verse.com/wp-content/uploads/2019/03/img-unavailable.jpg';
    endif;

		?>
		<div class="post__content">
      <div class="content__preview" style="background-image:url(<?php echo $image_post_src ?>)">

        <?php
          //Check if posting is a featured product
          $feature_post = esc_attr( get_post_meta( get_the_ID(), 'ev_info__feature', true ));
          if ($feature_post == "enable"): echo '<div class="archive-single__feature">featured</div>';
          endif;
        ?>

        <div class="preview__price-year">
          <p class="price-year__p">MSRP</p>
          <div class="price-year__p price-year__price">
            <div class="price">
              <?php
                echo $price;
              ?>
            </div>
          </div>


          <p class="price-year__p price-year__year">
            <?php
              $start_year = esc_attr( get_post_meta( get_the_ID(), 'ev_info__start-year', true ));
              $end_year = esc_attr( get_post_meta( get_the_ID(), 'ev_info__end-year', true ));
              if (!empty($end_year)) {
                echo $start_year . ' - ' . $end_year;
              } else {
                echo $start_year;
              }
            ?>
          </p>
        </div>


      </div><!-- End of content-preview-->

      <div class="content__specs">
        <div class="specs__list">
          <table class="list__table">
            <tr>
              <th colspan="2" class="list__head">Specifications:</th>
            </tr>
            <?php
              foreach ( $specs_checked as $arr) {
                foreach ($arr as $key => $value) {
                  echo '
                  <tr class="list__rows">
                    <td>' . $key . '</td>
                    <td>' . $value . '</td>
                  </tr>';
                }
             	}
            ?>
          </table>
        </div>
        <div class="specs__more-info">
          <p>For more information on this vehicle, visit:</p>
          <a href="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__url', true ));?>" target="_blank" class="more-info__visit button button--primary">
            Visit Site
          </a>
        </div>
      </div>

    </div>
    <div class="av_single__description">
      <p>
        <?php echo esc_attr( get_post_meta( get_the_ID(), 'ev_info__description', true ));?>
      </p>
    </div>
		<?php
	}
}

//Not assigned!
if ( ! function_exists( 'storefront_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function storefront_post_content() {
		?>
		<div class="entry-content">
		<?php

		/**
		 * Functions hooked in to storefront_post_content_before action.
		 *
		 * @hooked storefront_post_thumbnail - 10
		 */
		do_action( 'storefront_post_content_before' );

		the_content(
			sprintf(
				__( 'Continue reading %s', 'storefront' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);

		do_action( 'storefront_post_content_after' );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
			'after'  => '</div>',
		) );
		?>
		</div><!-- .entry-content -->
		<?php
	}
}


/* ---------------------------------------------------------------------- */

/**
 * Revamped storefront template functions
 *
 */

 if ( ! function_exists( 'storefront_site_branding' ) ) {
 	/**
 	 * The header container
 	 */
 	function storefront_site_branding() {
 		?>
      <div class="beta site-title av_site_header_logo">
        <a href="https://www.alter-verse.com/">
          <?php
        if(is_front_page()) :?>
          <img src="https://www.alter-verse.com/wp-content/uploads/2019/06/alterverse2.png" alt="Alter-verse" />
          <?php else : ?>
        <img src="https://www.alter-verse.com/wp-content/uploads/2019/06/alterverse.png" alt="Alter-verse" />
          <?php endif; ?>
        </a>
      </div>
    <?php;
  	}
 }


 if ( ! function_exists( 'storefront_header_container' ) ) {
 	/**
 	 * The header container
 	 */
 	function storefront_header_container() {
 		echo '<div class="col-full header__grid">';
 	}
 }

if ( ! function_exists( 'storefront_primary_navigation_wrapper' ) ) {
	/**
	 * The primary navigation wrapper
	 */
	function storefront_primary_navigation_wrapper() {
		echo '<div class="storefront-primary-navigation">';
	}
}

if ( ! function_exists( 'storefront_primary_navigation_wrapper_close' ) ) {
	/**
	 * The primary navigation wrapper close
	 */
	function storefront_primary_navigation_wrapper_close() {
    echo '
      </div>
        ';

	}
}

if ( ! function_exists( 'storefront_header_container_close' ) ) {
	/**
	 * The header container close
	 */
	function storefront_header_container_close() {
    echo do_shortcode( '[searchandfilter fields="search" search_placeholder="Search vehicles..." class="home-filter__plugin"]' );
		echo '</div>';
	}
}

/* ---------------------------------------------------------------------- */

/**
 * Template Hooks
 *
 */

/**
 * General
 *
 * @see  storefront_header_widget_region()
 * @see  storefront_get_sidebar()
 */
add_action( 'storefront_before_content', 'storefront_header_widget_region', 10 );
add_action( 'storefront_sidebar',        'storefront_get_sidebar',          10 );

/**
 * Custom ev posts
 *
 */
add_action( 'av_evpost_content', 'av_home_feature_news', 10 );

/**
 * Custom Alter-verse header
 *
 * @see  storefront_skip_links()
 * @see  storefront_secondary_navigation()
 * @see  storefront_site_branding()
 * @see  storefront_primary_navigation()
 */
add_action( 'av_storefront_header', 'storefront_header_container',                 0 );
add_action( 'av_storefront_header', 'storefront_site_branding',                    0 );
add_action( 'av_storefront_header', 'storefront_primary_navigation_wrapper',       0 );
add_action( 'av_storefront_header', 'storefront_primary_navigation',               0 );
add_action( 'av_storefront_header', 'storefront_primary_navigation_wrapper_close', 0 );
add_action( 'av_storefront_header', 'storefront_header_container_close',           0 );
//add_action( 'av_storefront_header', 'storefront_product_search', 40 ); > inc/woocommerce
//add_action( 'av_storefront_header', 'storefront_header_cart',    60 ); > inc/woocommerce

?>
