<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
	wp_head();
	?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-210562479-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-210562479-1');
	</script>
</head>

<body>
<header class="navbar">
	<div class="container">
		<div class="navbar-logo">
			<a href="/" class="navbar-brand logo_header">HT&amp;E - Here There and Everywhere</a>
		</div>
		<div class="navbar-middle">
			<nav class="navbar-container" >
				<?php
				wp_nav_menu(
					array(
						'menu' => 'primary',
						'container'=> '',
						'theme_location' => 'primary',
						'items_wrap' => '<ul id="ulMenu" class="navbar-nav">%3$s</ul>'
					)
				);
				?>
			</nav>
			<div class="responsive-searchbar">
				<?php
				get_search_form();
				?>
			</div>

			<div>
				<div class="search-button" onclick="searchtoggle()"></div>
				<div class="hamburger"  onclick="menutoggle()">
					<div class="bar"></div>
					<div class="bar"></div>
					<div class="bar"></div>
				</div>
			</div>
		</div>
		<div class="navbar-right">
			<nav class="navbar-right-container">
				<?php
				wp_nav_menu(
					array(
						'menu' => 'secondary',
						'container'=> '',
						'theme_location' => 'secondary',
						'items_wrap' => '<ul id="" class="navbar-nav-right">%3$s</ul>'
					)
				);
				?>
			</nav>
		</div>
	</div>
</header>


