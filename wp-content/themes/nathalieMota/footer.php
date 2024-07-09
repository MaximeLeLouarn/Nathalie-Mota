<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nathalieMota
 */

?>

	<footer id="colophon" class="site-footer">

	<nav id="footer-menu" class="footer-menu">
		<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu',
						'menu_id'        => 'footer-menu',
					)
				);
		?>
	</nav>

	<div class="modalContactCf7">
		
		<div class="cf7Container">
			
			<span class="XModal">&times;</span>
			
			<img src="<?= get_template_directory_uri() . '/assets/ContactHeader.png' ?>" alt="Contact">
			
			<div class="formContainer">
				<?= do_shortcode('[contact-form-7 id="b3be6c6" title="Modale de Contact"]'); ?>
			</div>

		</div>

	</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
