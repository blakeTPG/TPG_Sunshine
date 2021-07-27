<?php
/**
 * TPG Sunshine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TPG_Sunshine
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'tpg_sunshine_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tpg_sunshine_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on TPG Sunshine, use a find and replace
		 * to change 'tpg_sunshine' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tpg_sunshine', get_template_directory() . '/languages' );

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
				'primary' => esc_html__( 'Primary', 'tpg_sunshine' ),
				'secondary' => esc_html__( 'Secondary', 'tpg_sunshine' ),
				'footer' => esc_html__( 'Footer', 'tpg_sunshine' ),
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
				'tpg_sunshine_custom_background_args',
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
add_action( 'after_setup_theme', 'tpg_sunshine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tpg_sunshine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tpg_sunshine_content_width', 640 );
}
add_action( 'after_setup_theme', 'tpg_sunshine_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tpg_sunshine_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tpg_sunshine' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tpg_sunshine' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tpg_sunshine_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tpg_sunshine_scripts() {

	wp_enqueue_script( 'tpg_sunshine-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_style( 'fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	wp_enqueue_style( 'hamburgers', get_stylesheet_directory_uri() . '/inc/hamburgers.css');

	wp_enqueue_script( 'tpg-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array(), '20210311', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'tpg_sunshine-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'tpg_sunshine-style', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'tpg_sunshine_scripts' );

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
 * Include the TGM_Plugin_Activation class.
**/
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'tpg_sunshine_register_required_plugins' );

function tpg_sunshine_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		// array(
		// 	'name'               => 'TPG Sunshine Theme Options', // The plugin name.
		// 	'slug'               => 'theme-options-1.3', // The plugin slug (typically the folder name).
		// 	'source'             => '/wp-content/plugins/theme-options-1.3', // The plugin source.
		// 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
		// 	'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
		// 	'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
		// 	'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		// 	'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		// 	'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		// ),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => true,
		),

		array(
			'name'		=> 'Advanced Contact form 7 DB',
			'slug'		=> 'advanced-cf7-db',
			'required'	=> true,
		),

		array(
			'name'		=> 'WP Mail SMTP by WPForms',
			'slug'		=> 'wp-mail-smtp',
			'required'	=> true,
		),

		array(
			'name'		=> 'WordPress Native PHP Sessions',
			'slug'		=> 'wp-native-php-sessions',
			'required'	=> true,
		),

		array(
			'name'		=> 'Advanced Custom Fields',
			'slug'		=> 'advanced-custom-fields',
			'required'	=> true,
		),

		// This is an example of the use of 'is_callable' functionality. A user could - for instance -
		// have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
		// 'wordpress-seo-premium'.
		// By setting 'is_callable' to either a function from that plugin or a class method
		// `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
		// recognize the plugin as being installed.
		// array(
		// 	'name'        => 'WordPress SEO by Yoast',
		// 	'slug'        => 'wordpress-seo',
		// 	'is_callable' => 'wpseo_init',
		// ),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tpg_sunshine',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'tpg_sunshine' ),
			'menu_title'                      => __( 'Install Plugins', 'tpg_sunshine' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'tpg_sunshine' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'tpg_sunshine' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'tpg_sunshine' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'tpg_sunshine'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'tpg_sunshine'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'tpg_sunshine'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'tpg_sunshine'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'tpg_sunshine'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'tpg_sunshine'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'tpg_sunshine'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'tpg_sunshine'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'tpg_sunshine'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'tpg_sunshine' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'tpg_sunshine' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'tpg_sunshine' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'tpg_sunshine' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'tpg_sunshine' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'tpg_sunshine' ),
			'dismiss'                         => __( 'Dismiss this notice', 'tpg_sunshine' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'tpg_sunshine' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tpg_sunshine' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}

/*
	ADD 7 BLOG POSTS WITH LOREM IPSUM CONTENT, PAGES, AND PRIMARY MENU
*/
add_option('initial_content_loaded', 0);
if (get_option('initial_content_loaded') == 0) {
	// set site tagline 'blogdescription' to ''
	update_option('blogdescription', '');
	// delete hello world post and sample page
	wp_delete_post(1);
	wp_delete_post(2);
	wp_delete_post(3);
	// one time insert posts programmatically
	wp_insert_post([
		'post_title'		=> 'Vulputate mi sit amet mauris',
		'post_content'		=> '<!-- wp:paragraph --><p>Quam id leo in vitae turpis massa. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Egestas integer eget aliquet nibh praesent tristique magna sit amet. Tellus at urna condimentum mattis pellentesque id nibh tortor. Justo nec ultrices dui sapien. Sem et tortor consequat id porta nibh venenatis. Sed risus ultricies tristique nulla aliquet. Ante metus dictum at tempor commodo ullamcorper a lacus vestibulum. Massa eget egestas purus viverra accumsan in nisl. Ornare arcu odio ut sem nulla pharetra diam. Id ornare arcu odio ut sem nulla pharetra diam sit. Et malesuada fames ac turpis. Ornare aenean euismod elementum nisi quis eleifend quam adipiscing vitae. Egestas fringilla phasellus faucibus scelerisque eleifend donec. Quam nulla porttitor massa id neque.</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
	]);
	wp_insert_post([
		'post_title'		=> 'Pulvinar sapien et ligula ullamcorper malesuada proin',
		'post_content'		=> '<!-- wp:paragraph --><p>Risus viverra adipiscing at in tellus integer feugiat. Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio. Lacinia at quis risus sed vulputate. Id diam vel quam elementum pulvinar. Nec ultrices dui sapien eget mi proin sed libero. Sed blandit libero volutpat sed. Enim tortor at auctor urna. Sagittis eu volutpat odio facilisis. Faucibus ornare suspendisse sed nisi. Nunc sed blandit libero volutpat. Non blandit massa enim nec dui nunc mattis enim ut. Gravida in fermentum et sollicitudin ac orci phasellus egestas. Ipsum consequat nisl vel pretium lectus. Id leo in vitae turpis.</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
	]);
	wp_insert_post([
		'post_title'		=> 'Nec ultrices dui sapien eget mi proin',
		'post_content'		=> '<!-- wp:paragraph --><p>Sed euismod nisi porta lorem mollis aliquam ut. Amet consectetur adipiscing elit ut. Purus in mollis nunc sed id semper. Morbi tempus iaculis urna id volutpat lacus laoreet non curabitur. Volutpat ac tincidunt vitae semper. Mauris rhoncus aenean vel elit. Vitae et leo duis ut diam. Sed id semper risus in hendrerit gravida rutrum. Odio aenean sed adipiscing diam. Urna nunc id cursus metus aliquam eleifend mi in nulla. Laoreet sit amet cursus sit. Arcu odio ut sem nulla pharetra diam. Eget gravida cum sociis natoque penatibus et magnis.</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
	]);
	wp_insert_post([
		'post_title'		=> 'Condimentum mattis pellentesque id nibh',
		'post_content'		=> '<!-- wp:paragraph --><p>A arcu cursus vitae congue mauris. Eu nisl nunc mi ipsum faucibus vitae aliquet nec. Vitae tortor condimentum lacinia quis. Velit ut tortor pretium viverra suspendisse potenti. Etiam erat velit scelerisque in dictum. Ultrices neque ornare aenean euismod elementum nisi. Gravida cum sociis natoque penatibus et magnis dis parturient montes. Sed adipiscing diam donec adipiscing tristique risus nec feugiat in. Amet aliquam id diam maecenas ultricies. A pellentesque sit amet porttitor. Elit at imperdiet dui accumsan sit amet nulla facilisi morbi. Dui nunc mattis enim ut tellus elementum. Congue nisi vitae suscipit tellus mauris. Enim nec dui nunc mattis enim ut. Mauris pellentesque pulvinar pellentesque habitant morbi. Eget duis at tellus at urna condimentum mattis pellentesque id.</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
	]);
	wp_insert_post([
		'post_title'		=> 'Bibendum est ultricies integer quis auctor',
		'post_content'		=> '<!-- wp:paragraph --><p>Posuere lorem ipsum dolor sit amet consectetur. Pellentesque nec nam aliquam sem et tortor consequat id porta. Fusce id velit ut tortor. Et malesuada fames ac turpis egestas sed tempus urna. Nec sagittis aliquam malesuada bibendum arcu vitae elementum. Massa eget egestas purus viverra. Fermentum et sollicitudin ac orci phasellus. Sed risus pretium quam vulputate dignissim suspendisse in. Ac placerat vestibulum lectus mauris ultrices eros in cursus. Sed adipiscing diam donec adipiscing tristique. Et malesuada fames ac turpis egestas sed tempus.</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
	]);
	wp_insert_post([
		'post_title'		=> 'Ut tortor pretium viverra suspendisse potenti',
		'post_content'		=> '<!-- wp:paragraph --><p>Sit amet nulla facilisi morbi tempus iaculis urna id. Rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis. Aliquet nibh praesent tristique magna sit amet purus gravida quis. At tempor commodo ullamcorper a. Duis at tellus at urna condimentum mattis pellentesque id. Pellentesque habitant morbi tristique senectus et netus et. Justo nec ultrices dui sapien eget mi proin sed libero. Eu augue ut lectus arcu bibendum at. Lorem sed risus ultricies tristique nulla aliquet enim. Venenatis lectus magna fringilla urna porttitor. Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam. Tempus quam pellentesque nec nam aliquam sem et tortor consequat. Enim eu turpis egestas pretium aenean pharetra magna ac placerat. Sit amet luctus venenatis lectus magna.</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
	]);
	wp_insert_post([
		'post_title'		=> 'Eu consequat ac felis donec et',
		'post_content'		=> '<!-- wp:paragraph --><p>Vitae et leo duis ut diam quam. Mauris vitae ultricies leo integer malesuada nunc vel risus commodo. Metus dictum at tempor commodo ullamcorper a lacus vestibulum. Tellus id interdum velit laoreet id donec ultrices tincidunt arcu. Interdum consectetur libero id faucibus nisl tincidunt. Scelerisque purus semper eget duis at. Erat nam at lectus urna. Enim ut sem viverra aliquet eget sit amet tellus. Dictum sit amet justo donec enim. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet. Mollis aliquam ut porttitor leo. In cursus turpis massa tincidunt dui ut ornare lectus. Luctus venenatis lectus magna fringilla urna. Integer feugiat scelerisque varius morbi enim nunc faucibus a pellentesque. Mattis aliquam faucibus purus in.</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
	]);
	// one time insert pages programmatically
	$home_page_id = wp_insert_post([
		'post_title'		=> 'Home',
		'post_content'		=> '',
		'post_status'		=> 'publish',
		'post_type'			=> 'page',
		'page_template'		=> 'page-home.php',
		'menu_order'		=> 1
	]);
	$home_id_by_title = get_page_by_title('Home');
	update_option( 'page_on_front', $home_id_by_title->ID );
	update_option( 'show_on_front', 'page' );
	$about_page_id = wp_insert_post([
		'post_title'		=> 'About',
		'post_content'		=> '<!-- wp:paragraph --><p>The almond is native to Iran and surrounding countries. It was spread by humans in ancient times along the shores of the Mediterranean into northern Africa and southern Europe, and more recently transported to other parts of the world, notably California, United States. The wild form of domesticated almond grows in parts of the Levant. Selection of the sweet type from the many bitter types in the wild marked the beginning of almond domestication. It is unclear as to which wild ancestor of the almond created the domesticated species. The species Prunus fenzliana may be the most likely wild ancestor of the almond, in part because it is native of Armenia and western Azerbaijan, where it was apparently domesticated. Wild almond species were grown by early farmers, "at first unintentionally in the garbage heaps, and later intentionally in their orchards". Almonds were one of the earliest domesticated fruit trees, due to "the ability of the grower to raise attractive almonds from seed. Thus, in spite of the fact that this plant does not lend itself to propagation from suckers or from cuttings, it could have been domesticated even before the introduction of grafting". Domesticated almonds appear in the Early Bronze Age (3000–2000 BC), such as the archaeological sites of Numeira (Jordan), or possibly earlier. Another well-known archaeological example of the almond is the fruit found in Tutankhamun\'s tomb in Egypt (c. 1325 BC), probably imported from the Levant. Of the European countries that the Royal Botanic Garden Edinburgh reported as cultivating almonds, Germany is the northernmost, though the domesticated form can be found as far north as Iceland.</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
		'post_type'			=> 'page',
		'menu_order'		=> 2
	]);
	$issues_page_id = wp_insert_post([
		'post_title'		=> 'Issues',
		'post_content'		=> '<!-- wp:paragraph --><p>List issues besetting the almond here...</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
		'post_type'			=> 'page',
		'menu_order'		=> 3
	]);
	$news_page_id = wp_insert_post([
		'post_title'		=> 'News',
		'post_content'		=> '',
		'post_status'		=> 'publish',
		'post_type'			=> 'page',
		'page_template'		=> 'page-blog.php',
		'menu_order'		=> 4
	]);
	$contact_page_id = wp_insert_post([
		'post_title'		=> 'Contact',
		'post_content'		=> '<!-- wp:paragraph --><p>Please complete the form below and we\'ll get back to you as soon as possible.</p><!-- /wp:paragraph -->',
		'post_status'		=> 'publish',
		'post_type'			=> 'page',
		'menu_order'		=> 5
	]);
	$contact_form_page_id = wp_insert_post([
		'post_title'		=> 'CF7 Defaults',
		'post_content'		=> '<p><strong>Contact
		Page Shortcode</strong></p>
		<pre class="wp-block-code"><code>&#91;contact-form-7 title="Contact Page" html_class="contact-page"]</code></pre>
		<p><strong>Contact
		Page Form Fields</strong></p>
		<pre class="wp-block-code"><code>&#91;text* your-name placeholder "Name"]&#91;email* your-email placeholder "Email"]&#91;textarea your-message placeholder "Message"]&#91;submit "Send"]</code></pre>
		<p><strong>Signup
		Shortcode</strong></p>
		<pre class="wp-block-code"><code>&#91;contact-form-7 title="Home Page Signup Form"]</code></pre>
		<p><strong>Signup
		Form Fields</strong></p>
		<pre class="wp-block-code"><code>&#91;text* your-name placeholder "Name"]&#91;email* your-email placeholder "Email"]&#91;textarea your-message placeholder "Message"]&#91;submit "Send"]</code></pre>',
		'post_status'		=> 'draft',
		'post_type'			=> 'page',
		'menu_order'		=> 6
	]);
	$privacy_page_id = wp_insert_post([
		'post_title'		=> 'Privacy Policy',
		'post_content'		=> '',
		'post_status'		=> 'publish',
		'post_type'			=> 'page',
		'page_template'		=> 'privacy.php'
	]);
	update_option('wp_page_for_privacy_policy', $privacy_page_id); 
	// one time insert primary menu programmatically
	$menu_name 		= 'Primary Menu';
	$menu_exists 	= wp_get_nav_menu_object( $menu_name );
	if ( !$menu_exists ) {
		// create Primary Menu
		$menu_id = wp_create_nav_menu('Primary Menu');
		// add menu items
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' 		=> 'Home',
			'menu-item-object-id' 	=> $home_page_id,
			'menu-item-object' 		=> 'page',
			'menu-item-status' 		=> 'publish',
			'menu-item-type' 		=> 'post_type',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' 		=> 'About',
			'menu-item-object-id' 	=> $about_page_id,
			'menu-item-object' 		=> 'page',
			'menu-item-status' 		=> 'publish',
			'menu-item-type' 		=> 'post_type',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' 		=> 'Issues',
			'menu-item-object-id' 	=> $issues_page_id,
			'menu-item-object' 		=> 'page',
			'menu-item-status' 		=> 'publish',
			'menu-item-type' 		=> 'post_type',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' 		=> 'News',
			'menu-item-object-id' 	=> $news_page_id,
			'menu-item-object' 		=> 'page',
			'menu-item-status' 		=> 'publish',
			'menu-item-type' 		=> 'post_type',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' 		=> 'Contact',
			'menu-item-object-id' 	=> $contact_page_id,
			'menu-item-object' 		=> 'page',
			'menu-item-status' 		=> 'publish',
			'menu-item-type' 		=> 'post_type',
		));
		wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' 		=> 'Donate',
			'menu-item-url' 		=> 'http://winred.com',
			'menu-item-status' 		=> 'publish',
			'menu-item-type' 		=> 'custom', // optional
			'menu-item-classes' 	=> 'donate',
			'menu-item-target'		=> '_blank'
		));
		// Set the menu to primary menu location
		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['primary'] = $menu_id;
		set_theme_mod ( 'nav_menu_locations', $locations );
	}
	// update category from "Uncategorized" to "News" which is a better default
	wp_update_term(1, 'category', array(
		'name' => 'News',
		'slug' => 'news'
	  ));
	// update initial content loaded option
	update_option('initial_content_loaded', 1);
}

/* ACF OPTIONS */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_605261075fa72',
	'title' => 'Meta Options',
	'fields' => array(
		array(
			'key' => 'field_605262069ac0d',
			'label' => 'Meta Description',
			'name' => 'meta_description',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => 4,
			'new_lines' => '',
		),
		array(
			'key' => 'field_6053a10f5f837',
			'label' => 'OpenGraph Image',
			'name' => 'opengraph_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-home.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;

function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');