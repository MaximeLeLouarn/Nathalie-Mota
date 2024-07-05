<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nathalieMota
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header">


		<nav id="site-navigation" class="main-navigation">

			<div class="logoHeader">
				<a href="<?php echo get_home_url(); ?>">
					<img src="<?= get_template_directory_uri() . '/assets/Logo.png' ?>" alt="Logo Nathalie Mota">
				</a>
			</div>

			<div class="headerMenusContainer">

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>

				<div class="closedMenu">

					<button class="menuToggle" aria-controls="mobile-menu" aria-expanded="false">
						<span class="line1"></span>
						<span class="line2"></span>
						<span class="line3"></span>
					</button>
					
				</div>
				
			</div>
			
			<div class="openedMenu">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'mobile-menu',
					'menu_id'        => 'Mobile',
				)
			);
			?>
			</div>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
