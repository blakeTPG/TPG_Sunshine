<?php
/**
 * @package TPG_Sunshine
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<?php $home_id = get_option( 'page_on_front' ); ?>
	<meta name="description" content="<?php echo the_field('meta_description', $home_id); ?>" />
	<meta property="og:site_name" content="<?php echo bloginfo('name'); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo bloginfo('name'); ?>" />
	<meta property="og:description" content="<?php echo the_field('meta_description', $home_id); ?>" />
	<meta property="og:url" content="<?php echo home_url() ?>" />
	<meta property="og:image" content="<?php echo the_field('opengraph_image', $home_id); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'tpg_sunshine' ); ?></a>
<header class="fixed">
	<div class="navigation-section">
        <div class="desktop-navbar">
            <button class="hamburger hamburger--squeeze" type="button" onclick="hamburgerToggle(this);">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
            <nav role="navigation">
                <?php wp_nav_menu( array( 'menu'=> 'primary', 'theme_location' => 'primary', 'depth' => 2,) ); ?>
            </nav>
        </div>
        <div class="mobile-navbar">
            <nav role="navigation">
                <?php wp_nav_menu( array( 'menu'=> 'primary', 'theme_location' => 'primary', 'depth' => 2,) ); ?>
            </nav>
        </div>
    </div>
</header>
