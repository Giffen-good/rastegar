<?php
/**
 * rastegar functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rastegar
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'rastegar_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rastegar_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rastegar, use a find and replace
		 * to change 'rastegar' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rastegar', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'rastegar' ),
				'footer' => esc_html__( 'Footer', 'rastegar' ),
				'social-media' => esc_html__( 'Social Media', 'rastegar' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'rastegar_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'rastegar_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rastegar_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rastegar_content_width', 640 );
}
add_action( 'after_setup_theme', 'rastegar_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rastegar_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'rastegar' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rastegar' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'rastegar_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rastegar_scripts() {
	wp_enqueue_style( 'rastegar-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'rastegar-style', 'rtl', 'replace' );

	wp_enqueue_script( 'rastegar-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'rastegar-index', get_template_directory_uri() . '/js/index.js', array(), _S_VERSION, true );


	$translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
	//after wp_enqueue_script
	wp_localize_script( 'rastegar-index', 'object_name', $translation_array );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rastegar_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/** 
 * Advanced Custom Fields Settings
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

function console_log($str) {
	echo '<script>console.log(' + json_encode($str) + ')</script>';
}
// if( class_exists("Imagick") )
// {
// 		//Imagick is installed
// 		console_log('IMAGE MAGICK WORKS!!');
// }


function my_own_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'my_own_mime_types' );

register_block_pattern(
    'my-plugin/product-card',
    array(
        'title'       => __( 'Hero Banner', 'my-plugin' ),
        'description' => _x( 'The Top banner with overlay featured across the site', 'Block pattern description', 'my-plugin' ),
        'content'     => "<!-- wp:buttons {\"align\":\"center\"} -->\n<div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"backgroundColor\":\"very-dark-gray\",\"borderRadius\":0} -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background has-very-dark-gray-background-color no-border-radius\">" . esc_html__( 'Button One', 'my-plugin' ) . "</a></div>\n<!-- /wp:button -->\n\n<!-- wp:button {\"textColor\":\"very-dark-gray\",\"borderRadius\":0,\"className\":\"is-style-outline\"} -->\n<div class=\"wp-block-button is-style-outline\"><a class=\"wp-block-button__link has-text-color has-very-dark-gray-color no-border-radius\">" . esc_html__( 'Button Two', 'my-plugin' ) . "</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons -->",
    )
);


// Register Block Types

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'product-card',
            'title'             => __('Product Card'),
            'description'       => __('The Block widget used across the site'),
            'render_template'   => 'template-parts/blocks/product-card.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'product-card', 'rastegar' ),
				));
				
				acf_register_block_type(array(
					'name'              => 'team-member',
					'title'             => __('Team Member Gallery'),
					'description'       => __('Card containing Team Member image and modal'),
					'render_template'   => 'template-parts/blocks/team-member.php',
					'category'          => 'formatting',
					'icon'              => 'admin-comments',
					'keywords'          => array( 'team-member', 'rastegar' ),
				));
				acf_register_block_type(array(
					'name'              => 'hero-video',
					'title'             => __('Hero Video'),
					'description'       => __('Hero Banner with optional youtube video embed'),
					'render_template'   => 'template-parts/blocks/hero-video.php',
					'category'          => 'formatting',
					'icon'              => 'admin-comments',
					'keywords'          => array( 'hero-video', 'rastegar' ),
				));
				acf_register_block_type(array(
					'name'              => 'two-column-gallery',
					'title'             => __('Home Page 2-column gallery'),
					'description'       => __('Home Page 2-column gallery'),
					'render_template'   => 'template-parts/blocks/home-page-gallery.php',
					'category'          => 'formatting',
					'icon'              => 'admin-comments',
					'keywords'          => array( 'home-page-gallery', 'rastegar' ),
				));
				acf_register_block_type(array(
					'name'              => 'bubble-image',
					'title'             => __('Bubble with cover Image'),
					'description'       => __('Home Page Bubble with cover Image'),
					'render_template'   => 'template-parts/blocks/bubble-image.php',
					'category'          => 'formatting',
					'icon'              => 'admin-comments',
					'keywords'          => array( 'bubble-image', 'rastegar' ),
				));
				acf_register_block_type(array(
					'name'              => 'alt-bubble-image',
					'title'             => __('Alt bubble with cover Image'),
					'description'       => __('About Bubble with cover Image'),
					'render_template'   => 'template-parts/blocks/alt-bubble-image.php',
					'category'          => 'formatting',
					'icon'              => 'admin-comments',
					'keywords'          => array( 'bubble-image', 'rastegar' ),
				));

    }
}


add_action('acf/init', 'my_acf_init_block_types');

if ( function_exists( 'register_block_pattern_category' ) ) {
	register_block_pattern_category(
		'custom',
		array( 'label' => __( 'Custom Blocks', 'text-domain' ) )
 );
}

register_block_pattern(
	'rastegar/hero-banner',
	array(
			'title'       => __( 'Hero Banner', 'rastegar' ),
			'description' => _x( 'Two horizontal buttons, the left button is filled in, and the right button is outlined.', 'Block pattern description', 'my-plugin' ),
			'content'     => "<!-- wp:group {\"className\":\"hero-banner\"} -->\n<div class=\"wp-block-group hero-banner\"><div class=\"wp-block-group__inner-container\"><!-- wp:cover {\"url\":\"http://localhost/rastegar/wp-content/uploads/2021/03/aerial0045-aw-2-1.png\",\"id\":158} -->\n<div class=\"wp-block-cover has-background-dim\"><img class=\"wp-block-cover__image-background wp-image-158\" alt=\"\" src=\"http://localhost/rastegar/wp-content/uploads/2021/03/aerial0045-aw-2-1.png\" data-object-fit=\"cover\"/><div class=\"wp-block-cover__inner-container\"><!-- wp:group -->\n<div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"level\":1} -->\n<h1></h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"fontSize\":\"normal\"} -->\n<p class=\"has-normal-font-size\">Hello</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link\"></a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div></div>\n<!-- /wp:group --></div></div>\n<!-- /wp:cover --></div></div>\n<!-- /wp:group -->"
	)
);




register_block_pattern(
	'rastegar/centered-blue-columns',
	array(
			'title'       => __( 'Centered Bubble Columns', 'rastegar' ),
			'description' => _x( 'Columns containing elements with the blue wrapper/', 'Block pattern description', 'my-plugin' ),
			'content'     => '<!-- wp:columns {"className":"bubble-columns"} -->
			<div class="wp-block-columns bubble-columns"><!-- wp:column -->
			<div class="wp-block-column"><!-- wp:group {"className":"standard-wrapper"} -->
			<div class="wp-block-group standard-wrapper"><div class="wp-block-group__inner-container"></div></div>
			<!-- /wp:group --></div>
			<!-- /wp:column -->
			
			<!-- wp:column -->
			<div class="wp-block-column"><!-- wp:group {"className":"standard-wrapper"} -->
			<div class="wp-block-group standard-wrapper"><div class="wp-block-group__inner-container"></div></div>
			<!-- /wp:group --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->' 
		)
);


register_block_pattern(
	'rastegar/blue-wrapper',
	array(
			'title'       => __( 'Blue Bubble Wrapper', 'rastegar' ),
			'description' => _x( 'Blue Boxes found throughout the web design.', 'Block pattern description', 'my-plugin' ),
			'content'     => '<!-- wp:group {"className":"standard-wrapper"} --> <div class="wp-block-group standard-wrapper"><div class="wp-block-group__inner-container"><!-- wp:heading --> <h2></h2> <!-- /wp:heading --> <!-- wp:paragraph --> <p></p> <!-- /wp:paragraph --></div></div> <!-- /wp:group -->'
		)
);



register_block_pattern(
	'rastegar/cover-image',
	array(
			'title'       => __( 'About - Cover image Bubble', 'rastegar' ),
			'description' => _x( 'Blue Boxes found throughout the web design.', 'Block pattern description', 'my-plugin' ),
			'content'     => '<!-- wp:group {"className":"standard-wrapper image-bubble"} -->
			<div class="wp-block-group standard-wrapper image-bubble"><div class="wp-block-group__inner-container"><!-- wp:cover {"url":"http://localhost/rastegar/wp-content/uploads/2021/03/Rectangle-59.png","id":238,"dimRatio":33} -->
			<div class="wp-block-cover has-background-dim-30 has-background-dim"><img class="wp-block-cover__image-background wp-image-238" alt="" src="http://localhost/rastegar/wp-content/uploads/2021/03/Rectangle-59.png" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"fontSize":"normal"} -->
			<p class="has-normal-font-size"></p>
			<!-- /wp:paragraph -->
			
			<!-- wp:heading {"level":3} -->
			<h3></h3>
			<!-- /wp:heading --></div></div>
			<!-- /wp:cover --></div></div>
			<!-- /wp:group -->
			
			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph -->'
		)
);


register_block_pattern(
	'rastegar/sixty-forty',
	array(
			'title'       => __( 'Home 2-Column 60/40 ', 'rastegar' ),
			'description' => _x( 'Blue Boxes found throughout the web design.', 'Block pattern description', 'my-plugin' ),
			'content'     => '
			<!-- wp:group -->
			<div class="wp-block-group sixty-forty"><div class="wp-block-group__inner-container"><!-- wp:columns {"className":"sixty-forty"} -->
			<div class="wp-block-columns "><!-- wp:column {"verticalAlignment":"center","className":"text-box"} -->
			<div class="wp-block-column is-vertically-aligned-center text-box"><!-- wp:group {"className":"text-box"} -->
			<div class="wp-block-group text-box"><div class="wp-block-group__inner-container"><!-- wp:heading -->
			<h2>Our Mission</h2>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p>is to deliver passive income and capital appreciation through tax-efficient strategies and transparent policies.</p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:group --></div>
			<!-- /wp:column -->
			
			<!-- wp:column {"width":"60%"} -->
			<div class="wp-block-column" style="flex-basis:60%"><!-- wp:image {"id":96,"sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="http://localhost/rastegar/wp-content/uploads/2021/03/image-36.png" alt="" class="wp-image-96"/></figure>
			<!-- /wp:image -->
			
			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns --></div></div>
			<!-- /wp:group -->'
		)
);



