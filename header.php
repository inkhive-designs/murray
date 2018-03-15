<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package murray
 */
?>
<?php get_template_part('modules/header/head');?>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'murray' ); ?></a>
    <?php get_template_part('modules/header/jumbosearch'); ?>

	<div id="social-icons-fixed" title="<?php _e('Follow us on Social Media','murray'); ?>">
		<?php get_template_part('modules/social/social', 'soshion'); ?>
	</div>	
	
	<header id="masthead" class="site-header" role="banner">			
		<div class="container">
            <?php get_template_part('modules/header/masthead-inner'); ?>
			
			<div class="searchform">
				<?php get_template_part('modules/header/searchform', 'top'); ?>
			</div>
			
		</div>	
	</header><!-- #masthead -->

    <?php get_template_part('modules/navigation/menu-single'); ?>
	<!-- #site-navigation -->
	
	<?php if( class_exists('rt_slider') ) {
			 rt_slider::render('framework/featured-components/slider', 'nivo' );
		} ?>
	
	<div class="mega-container">
	
		<div id="content" class="site-content container">