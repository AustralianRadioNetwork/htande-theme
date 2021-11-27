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
<section id="main-content" class="homepage-container">
	<div class="container">
		<div class="row">
			<?php
			if (is_page('HT&E Home')){
				get_sidebar('homepage');
			}
			?>
		</div>
	</div>
</section>

	<?php
	get_footer();
	?>

