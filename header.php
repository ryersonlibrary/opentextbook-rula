<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico">
	<title>
	<?php
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			echo " | $site_description";
		}

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 ) {
			echo ' | ' . sprintf( __( 'Page %s', 'pressbooks' ), max( $paged, $page ) );
		}

		?>
	</title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<script>jQuery( function($) { $( "#tabs" ).tabs(); } );</script>
</head>
<body <?php body_class(); if(wp_title('', false) != '') { print ' id="' . str_replace(' ', '', strtolower(wp_title('', false))) . '"'; } ?>>
	<!-- Facebook share js sdk -->
	<div id="fb-root"></div>
	<?php
	$fb_script = get_option( 'pressbooks_theme_options_web' );
	if ( isset ( $fb_script['social_media'] ) && 1 === $fb_script['social_media'] || !isset( $fb_script['social_media'] )  ) {
		echo '<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, "script", "facebook-jssdk"));</script>';
	}?>
	<!-- end Facebook JS -->

	<?php get_template_part( 'content', 'accessibility-toolbar' ); ?>

	<?php if ( is_front_page() ) : ?>
		<!-- home page wrap -->
		<span itemscope itemtype="http://schema.org/Book" itemref="about alternativeHeadline author copyrightHolder copyrightYear datePublished description editor 
			image inLanguage keywords publisher audience educationalAlignment educationalUse interactivityType learningResourceType typicalAgeRange">
			<div class="book-info-container hfeed">
	<?php else : ?>
		<a class="skip-link" href="#content">Skip to main content</a>
		<span itemscope itemtype="http://schema.org/WebPage" itemref="about copyrightHolder copyrightYear inLanguage publisher">		
			<div class="top-bar">
				<div class="title-area">

					<!-- Book Title -->
					<span class="book-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
					<div class="sub-nav-left">
						<!-- Logo -->
						<span class="pressbooks-logo"><a href="<?php echo network_home_url( '/' ); ?>"><?php echo get_site_option('site_name'); ?></a></span>
					</div>
					<!-- end .sub-nav-left -->

					<div class="sub-nav-right">
						<?php if ( @array_filter( get_option( 'pressbooks_ecommerce_links' ) ) ) : ?>
							<!-- Buy -->
							<div class="buy">
								<a href="<?php echo get_option('home'); ?>/buy" class="button-red"><?php _e('Buy', 'pressbooks'); ?></a>
							</div>
						<?php endif; ?>	
						<?php get_template_part( 'content', 'social-header' ); ?> 
					</div>
					<!-- end .sub-nav-right -->

				</div>

				<div class="sub-nav">   
					<div class="alignright pullleft">
						<?php get_search_form(); ?>
					</div>			     
					<div class="author-wrap"> 
						<?php $metadata = pb_get_book_information(); ?>
						<?php if ( ! empty( $metadata['pb_author'] ) ) {
							echo $metadata['pb_author'];
						} ?>
					</div>
					<!-- end .author-wrap -->
				</div>
				<!-- end sub-nav -->  
			</div>
			<!-- end .top-bar -->

			<div class="wrapper"><!-- for sitting footer at the bottom of the page -->	    
				<div id="wrap">
					<?php if( !is_front_page() ) {
						get_sidebar();
					} ?>

					<?php //get_template_part( 'tabs', 'start'); ?>
						<div id="content" tabindex="-1">
	<?php endif; ?>
