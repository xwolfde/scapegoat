<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<!-- load the Theme Options -->
	<?php $options = get_option('scapegoat_theme_options'); ?>

	<head profile="http://gmpg.org/xfn/11">

		<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>

		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

		<!-- ♥ ♥ ♥ Oh nice, you take a look at the sourcecode. I'm flattered. ♥ ♥ ♥ -->
		<meta name="author" content="Peter Amende" />
		<meta name="description" content="<?php bloginfo('description'); ?>" />

		<!-- Stylesheet -->
		<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>" media="screen" />
		<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/print.css" media="print" />
		<!--[if IE]>
			<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/ie.css" media="screen" />
		<![endif]-->

		<?php if($options['style'] == TRUE) : ?>
			<style type="text/css"><?php echo $options['style']; ?></style>
		<?php endif; ?>

		<!-- Favicon -->
		<link rel="Shortcut Icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />

		<!-- Touch Icon -->
		<?php if($options['icon'] == TRUE) : ?>
			<link rel="apple-touch-icon" href="<?php echo $options['icon']; ?>"/>
			<link rel="apple-touch-icon-precomposed" href="<?php echo $options['icon']; ?>"/>
		<?php else : ?>
			<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/touch-icon.png"/>
			<link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_directory'); ?>/touch-icon.png"/>
		<?php endif; ?>

		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss2_url'); ?>">
		<link rel='canonical' href='<?php bloginfo('url'); ?>' />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link rel='index' title='<?php bloginfo('description'); ?>' href='<?php bloginfo('url'); ?>' />
		
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.1.7.1.js"></script>
		<?php if(is_front_page()) : ?>
			<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cycle.js"></script>
			<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js"></script>
		<?php endif; ?>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.fitvids.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.smoothscroll.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cookie.js"></script>
		<!--[if IE]>
			<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/libs/modernizr-1.7.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/global.js"></script>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<div id="header-outside">
			<header id="header-inside" class="inside clearfix">
				<figure id="logo">
					<a title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>">
						<?php if($options['logo'] == TRUE) : ?>
							<img src="<?php echo $options['logo']; ?>" alt="<?php bloginfo('name'); ?>" />
						<?php else : ?>
							<?php bloginfo('name'); ?>
						<?php endif; ?>
					</a>
				</figure>

				<nav id="main-nav">
					<a href="#main-nav" class="menu-toggle">Navigation</a>
					<?php wp_nav_menu(array('theme_location' => 'header', 'fallback_cb' => fallback_menu, 'walker' => new My_Walker_Nav_Menu())); ?>
				</nav>
				<div class="clear"></div>
				<aside id="header-social-links">
					<?php if($options['rss'] == TRUE) : ?>
						<a target="_blank" class="social-icon rss" href="<?php echo $options['rss']; ?>" title="Feed">Feed</a>
					<?php else : ?>
						<a target="_blank" class="social-icon rss" href="<?php bloginfo('rss2_url'); ?>" title="Feed">Feed</a>
					<?php endif; ?>
					<?php if($options['twitter'] == TRUE) : ?><a target="_blank" class="social-icon twitter" href="<?php echo $options['twitter']; ?>" title="Twitter">Twitter</a><?php endif; ?>
					<?php if($options['facebook'] == TRUE) : ?><a target="_blank" class="social-icon facebook" href="<?php echo $options['facebook']; ?>" title="Facebook">Facebook</a><?php endif; ?>
					<?php if($options['google'] == TRUE) : ?><a target="_blank" class="social-icon google" href="<?php echo $options['google']; ?>" title="Google +">Google +</a><?php endif; ?>
					<?php if($options['youtube'] == TRUE) : ?><a target="_blank" class="social-icon youtube" href="<?php echo $options['youtube']; ?>" title="Youtube">Youtube</a><?php endif; ?>
					<?php if($options['mail'] == TRUE) : ?><a target="_blank" class="social-icon mail" href="<?php echo $options['mail']; ?>" title="Newsletter">Newsletter</a><?php endif; ?>
					<?php if($options['podcast'] == TRUE) : ?><a target="_blank" class="social-icon podcast" href="<?php echo $options['podcast']; ?>" title="Podcast">Podcast</a><?php endif; ?>
				</aside><!-- header-social-links -->
			</header><!-- header-inside -->
		</div><!-- header-outside -->
		
		<?php if($options['breadcrumb-show'] && (is_single() || is_page() || is_archive())) : ?>
			<?php if(function_exists('breadcrumb')) : ?>
				<div id="breadcrumb-outside">
					<div id="breadcrumb-inside" class="inside clearfix">
						<?php breadcrumb(); ?> 
					</div><!-- breadcrumb-inside -->
				</div><!-- breadcrumb-outside -->
			<?php endif; ?>
		<?php endif; ?>
		
		<!-- Featured Container for Frontpage Slider and "Sidebar" -->
		<?php if(is_home() && !is_paged() &&  is_front_page()) : ?>
			<?php if($options['header-option'] == 'show-slider') : ?>
			<!-- customize slider by theme-options -->
			<?php if($options['slider-num'] == TRUE) : $num=$options['slider-num']; else : $num=5; endif; ?>
			<?php if($options['slider-cat'] == TRUE) : $cat=$options['slider-cat']; else : $cat=''; endif; ?>
			<!-- filter post formats from slider query -->
			<?php $no_formats = array(array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array('post-format-status'), 'operator' => 'NOT IN')); ?>
			<!-- all parameters for the query -->
			<?php $args = array('posts_per_page'=>$num,'cat'=>$cat,'tax_query'=>$no_formats,'post__not_in'=>get_option('sticky_posts')); ?>
			<?php query_posts($args); ?>
			<?php if(have_posts()) : ?>
			<section id="front-page-header-outside">
				<div id="front-page-header-inside" class="inside">
					<div id="toggling" class="toggling">
						<div id="slideshow">
							<div id="front-page-slider">
								<?php while (have_posts()) : the_post(); ?>
								<section class="front-page-slide">
									<header class="slide-text">
										<h2 class="slide-text-title">
											<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
											</a>
										</h2>
									</header>
									<?php if(has_post_thumbnail()) : ?>
									<figure class="slide-image">
										<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('featured'); ?>
										</a>
									</figure>
									<?php endif; ?>
								</section>
								<?php endwhile; ?>
							</div><!-- front-page-slider -->
						</div><!-- slideshow -->
						<div id="front-page-adverts">
							<?php if($options['featured-link-1'] || $options['featured-link-2'] || $options['featured-link-3'] == TRUE) : ?>
								<aside id="featured-links">
									<ul>
										<?php if($options['featured-link-1'] && $options['featured-link-title-1'] == TRUE) : ?>
											<li>
												<a target="_blank" class="featured-link" href="<?php echo $options['featured-link-1']; ?>" title="<?php echo $options['featured-link-title-1']; ?>"><?php echo $options['featured-link-title-1']; ?></a>
											</li>
										<?php endif; ?>
										<?php if($options['featured-link-2'] && $options['featured-link-title-2'] == TRUE) : ?>
											<li>
												<a target="_blank" class="featured-link" href="<?php echo $options['featured-link-2']; ?>" title="<?php echo $options['featured-link-title-2']; ?>"><?php echo $options['featured-link-title-2']; ?></a>
											</li>
										<?php endif; ?>
										<?php if($options['featured-link-3'] && $options['featured-link-title-3'] == TRUE) : ?>
											<li>
												<a target="_blank" class="featured-link" href="<?php echo $options['featured-link-3']; ?>" title="<?php echo $options['featured-link-title-3']; ?>"><?php echo $options['featured-link-title-3']; ?></a>
											</li>
										<?php endif; ?>
									</ul>
								</aside>
							<?php endif; ?>
						</div><!-- front-page-adverts -->
						<div class="clear"></div>
					</div><!-- toggling -->
					<a id="front-page-slider-toggle"></a>
					<div class="clear"></div>
				</div><!-- front-page-header-inside -->
			</section><!-- front-page-header-outside -->
			<?php endif; wp_reset_query(); ?>
			<?php elseif($options['header-option'] == 'show-header') : ?>
				<?php $header_image = get_header_image(); if($header_image == TRUE) : ?>
					<section id="front-page-header-image-outside">
						<div id="front-page-header-image-inside" class="custom-header inside">
						</div>
					</section>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		<!-- Featured Container End -->

		<div id="wrapper-outside">
			<div id="wrapper-inside" class="inside">