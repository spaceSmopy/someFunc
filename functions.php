<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own twentysixteen_setup() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 */
	function twentysixteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		 * If you're building a theme based on Twenty Sixteen, use a find and replace
		 * to change 'twentysixteen' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'twentysixteen' );

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
		 * Enable support for custom logo.
		 *
		 *  @since Twenty Sixteen 1.2
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'twentysixteen' ),
				'social'  => __( 'Social Links Menu', 'twentysixteen' ),
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
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Dark Gray', 'twentysixteen' ),
					'slug'  => 'dark-gray',
					'color' => '#1a1a1a',
				),
				array(
					'name'  => __( 'Medium Gray', 'twentysixteen' ),
					'slug'  => 'medium-gray',
					'color' => '#686868',
				),
				array(
					'name'  => __( 'Light Gray', 'twentysixteen' ),
					'slug'  => 'light-gray',
					'color' => '#e5e5e5',
				),
				array(
					'name'  => __( 'White', 'twentysixteen' ),
					'slug'  => 'white',
					'color' => '#fff',
				),
				array(
					'name'  => __( 'Blue Gray', 'twentysixteen' ),
					'slug'  => 'blue-gray',
					'color' => '#4d545c',
				),
				array(
					'name'  => __( 'Bright Blue', 'twentysixteen' ),
					'slug'  => 'bright-blue',
					'color' => '#007acc',
				),
				array(
					'name'  => __( 'Light Blue', 'twentysixteen' ),
					'slug'  => 'light-blue',
					'color' => '#9adffd',
				),
				array(
					'name'  => __( 'Dark Brown', 'twentysixteen' ),
					'slug'  => 'dark-brown',
					'color' => '#402b30',
				),
				array(
					'name'  => __( 'Medium Brown', 'twentysixteen' ),
					'slug'  => 'medium-brown',
					'color' => '#774e24',
				),
				array(
					'name'  => __( 'Dark Red', 'twentysixteen' ),
					'slug'  => 'dark-red',
					'color' => '#640c1f',
				),
				array(
					'name'  => __( 'Bright Red', 'twentysixteen' ),
					'slug'  => 'bright-red',
					'color' => '#ff675f',
				),
				array(
					'name'  => __( 'Yellow', 'twentysixteen' ),
					'slug'  => 'yellow',
					'color' => '#ffef8e',
				),
			)
		);

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Sixteen 1.6
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentysixteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentysixteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentysixteen_resource_hints', 10, 2 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'twentysixteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
	/**
	 * Register Google fonts for Twenty Sixteen.
	 *
	 * Create your own twentysixteen_fonts_url() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function twentysixteen_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}

		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Montserrat:400,700';
		}

		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Inconsolata:400';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentysixteen-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'twentysixteen-style' ), '20181230' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20181230', true );

	wp_localize_script(
		'twentysixteen-script',
		'screenReaderText',
		array(
			'expand'   => __( 'expand child menu', 'twentysixteen' ),
			'collapse' => __( 'collapse child menu', 'twentysixteen' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Twenty Sixteen 1.6
 */
function twentysixteen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentysixteen-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css', array(), '20181230' );
	// Add custom fonts.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'twentysixteen_block_editor_styles' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10, 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );



/**
 *
 * #### CUSTOM POST IMAGES ####
 *
 */


/**
 * Add a theme settings page to the WordPress admin panel
 */
function custom_post_image_setting( $wp_customize ) {
    $wp_customize->add_section(
    // ID
        'data_site_section',
        // Arguments array
        array(
            'title' => 'Custom post images',
            'capability' => 'edit_theme_options',
            'description' => "Settings for custom post images"
        )
    );
    $wp_customize->add_setting(
    // ID
        'number_of_custom_img',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'number_of_custom_img_control',
        // Arguments array
        array(
            'type' => 'text',
            'label' => "Number of Custom post images",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'number_of_custom_img'
        )
    );

    $wp_customize->add_setting(
    // ID
        'size_of_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'size_of_custom_imgs_control',
        // Arguments array
        array(
            'type' => 'hidden',
            'label' => "Size of Custom post images",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'size_of_custom_imgs'
        )
    );

    $wp_customize->add_setting(
    // ID
        'thumb_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'thumb_custom_imgs_control',
        // Arguments array
        array(
            'type' => 'hidden',
            'label' => "Thumbnail",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'thumb_custom_imgs'
        )
    );

    $wp_customize->add_setting(
    // ID
        'thumb_width_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'thumb_width_custom_imgs_control',
        // Arguments array
        array(
            'type' => 'number',
            'label' => "Width: ",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'thumb_width_custom_imgs'
        )
    );

    $wp_customize->add_setting(
    // ID
        'thumb_height_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'thumb_height_imgs_control',
        // Arguments array
        array(
            'type' => 'number',
            'label' => "Height: ",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'thumb_height_custom_imgs'
        )
    );

    $wp_customize->add_setting(
    // ID
        'medium_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'medium_custom_imgs_control',
        // Arguments array
        array(
            'type' => 'hidden',
            'label' => "Medium image",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'medium_custom_imgs'
        )
    );

    $wp_customize->add_setting(
    // ID
        'medium_width_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'medium_width_custom_imgs_control',
        // Arguments array
        array(
            'type' => 'number',
            'label' => "Width: ",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'medium_width_custom_imgs'
        )
    );

    $wp_customize->add_setting(
    // ID
        'medium_height_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'medium_height_imgs_control',
        // Arguments array
        array(
            'type' => 'number',
            'label' => "Height: ",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'medium_height_custom_imgs'
        )
    );

    $wp_customize->add_setting(
    // ID
        'large_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'large_custom_imgs_control',
        // Arguments array
        array(
            'type' => 'hidden',
            'label' => "Large image",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'large_custom_imgs'
        )
    );


    $wp_customize->add_setting(
    // ID
        'large_height_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );


    $wp_customize->add_setting(
    // ID
        'large_width_custom_imgs',
        // Arguments array
        array(
            'default' => '',
            'type' => 'option'
        )
    );
    $wp_customize->add_control(
    // ID
        'large_width_custom_imgs_control',
        // Arguments array
        array(
            'type' => 'number',
            'label' => "Width: ",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'large_width_custom_imgs'
        )
    );
    $wp_customize->add_control(
    // ID
        'large_height_imgs_control',
        // Arguments array
        array(
            'type' => 'number',
            'label' => "Height: ",
            'section' => 'data_site_section',
            // This last one must match setting ID from above
            'settings' => 'large_height_custom_imgs'
        )
    );
}
add_action( 'customize_register', 'custom_post_image_setting' );


/**
 * Create Metaboxes
 */
add_action('add_meta_boxes', 'custom_img_box');
function custom_img_box(){
    $screens = array( 'post' );
    add_meta_box( 'custom_img_box', 'Enter custom images', 'custom_post_img_meta_box_callback', $screens );
}


// HTML of Metabox
function custom_post_img_meta_box_callback( $post ){
    $thumb_width = get_option( 'thumb_width_custom_imgs' );;
    $thumb_height = get_option( 'thumb_height_custom_imgs' );;
    $medium_width = get_option( 'medium_width_custom_imgs' );;
    $medium_height = get_option( 'medium_height_custom_imgs' );;
    $large_width = get_option( 'large_width_custom_imgs' );;
    $large_height = get_option( 'large_height_custom_imgs' );;
    $number_of_custom_post_imgs = get_option( 'number_of_custom_img' );

    for ($i = 1; $i <= $number_of_custom_post_imgs; $i++) {
            $url = get_post_meta($post->ID, 'custom_post_img'.$i, true);
            $custom_attr = get_post_meta($post->ID, 'custom_attr'.$i, true);
            $custom_post_img_size = get_post_meta( $post->ID,'custom_post_img_size'.$i,true );
     ?>
        <table width="100%" style="margin: 10px 0;">
            <tr>
                <td style="border-right: 1px solid #eee;width: 5%;text-align: center;">
                    <h3><?php echo $i; ?></h3>
                </td>
                <td>
                    <table width="100%">
                        <tr>
                            <td><h4>Image</h4></td>
                            <td><img src="<?php echo $url;?>" style="width: 200px;" id="picsrc<?php echo $i;?>" /></td>
                            <td>
                                <input id="my_image_URL<?php echo $i;?>" name="my_image_URL<?php echo $i;?>" type="text"
                                       value="<?php echo $url;?>" style="width:400px;" />
                                <input id="my_upl_button<?php echo $i;?>" type="button" value="Upload Image" class="button tagadd" />

                                <script>
                                    jQuery(document).ready( function($) {
                                        jQuery('#my_upl_button<?php echo $i;?>').click(function() {
                                            window.send_to_editor = function(html) {
                                                imgurl = jQuery(html).attr('src')
                                                jQuery('#my_image_URL<?php echo $i;?>').val(imgurl);
                                                jQuery('#picsrc<?php echo $i;?>').attr("src", imgurl);
                                                tb_remove();
                                            }

                                            formfield = jQuery('#my_image_URL<?php echo $i;?>').attr('name');
                                            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true' );
                                            return false;
                                        }); // End on click
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td><h4>Image size</h4></td>
                            <td>
                                <select name="customImgs<?php echo $i;?>" id="customImgs_select">
                                    <option value="thumbnail" <?php var_dump($custom_post_img_size); selected( $custom_post_img_size, 'thumbnail' ); ?>>Thumbnail (<?php echo $thumb_width;?>px * <?php echo $thumb_height;?>px)</option>
                                    <option value="medium" <?php selected( $custom_post_img_size, 'medium' ); ?>>Medium (<?php echo $medium_width;?>px * <?php echo $medium_height;?>px)</option>
                                    <option value="large" <?php selected( $custom_post_img_size, 'large' ); ?>>Large (<?php echo $large_width;?>px * <?php echo $large_height;?>px)</option>
                                </select>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><h4>Custom attribute:</h4></td>
                            <td><input id="custom_attr<?php echo $i;?>" name="custom_attr<?php echo $i;?>" type="text" value="<?php echo $custom_attr;?>" style="width:400px;" /></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
<?php
    }
}
/**
 * Save Metaboxes
 */
add_action('save_post', function ($post_id) {
    if (isset($_POST['my_image_URL2'])){
        $number_of_custom_post_imgs = get_option( 'number_of_custom_img' );
        for ($i = 1; $i <= $number_of_custom_post_imgs; $i++) {
            update_post_meta($post_id, 'custom_attr'.$i, $_POST['custom_attr'.$i]);
            update_post_meta($post_id, 'custom_post_img'.$i, $_POST['my_image_URL'.$i]);
            update_post_meta( $post_id, 'custom_post_img_size'.$i,  $_POST['customImgs'.$i] );
        }
    }
});
/**
 * Add a filter that adds ShortCode of CustomPostImages in content of post
 */
add_filter( 'default_content', 'add_shortcode_to_editor_content' );
function add_shortcode_to_editor_content( $content ) {
    $content = "[custom_post_images]";
    return $content;
}
/**
 * Make ShortCode for output values
 */
function short_code_custom_post_imgs( $atts ){
    $thumb_width = get_option( 'thumb_width_custom_imgs' );;
    $thumb_height = get_option( 'thumb_height_custom_imgs' );;
    $medium_width = get_option( 'medium_width_custom_imgs' );;
    $medium_height = get_option( 'medium_height_custom_imgs' );;
    $large_width = get_option( 'large_width_custom_imgs' );;
    $large_height = get_option( 'large_height_custom_imgs' );;

    $number_of_custom_post_imgs = get_option( 'number_of_custom_img' );
    $post_id = get_the_ID();
    $html = "";

    for ($i = 1; $i <= $number_of_custom_post_imgs; $i++) {
        $url_post_imgs = get_post_meta($post_id, 'custom_post_img'.$i, true);
        $custom_attr = get_post_meta($post_id, 'custom_attr'.$i, true);
        $custom_post_img_size = get_post_meta( $post_id,'custom_post_img_size'.$i,true );

        switch ($custom_post_img_size){
            case 'thumbnail':
                $img_size = "width=".$thumb_width. " height=".$thumb_height."";
                break;
            case 'medium':
                $img_size = "width=".$medium_width. " height=".$medium_height."";
                break;
            case 'large':
                $img_size = "width=".$large_width. " height=".$large_height."";
                break;
        }
        $html .= " <img src='". $url_post_imgs ."' ". $custom_attr ." ". $img_size .">"; ;

    }
    return $html;
}

add_shortcode( 'custom_post_images', 'short_code_custom_post_imgs' );