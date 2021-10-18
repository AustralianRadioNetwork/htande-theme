<?php
	/*
	Template Name: Homepage
	*/

	/* =========================
	 * Template for the 'HT&E Main' page.
	 * =========================
	 */
?>
	<?php
	get_header();
	?>
		<?php
			if( have_posts()) {
			while ( have_posts()) {
				the_post();
				the_content();
			}
		}
		?>
	<?php
	get_footer();
	?>

