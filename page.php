<?php

/*
Template Name: Press Release
*/

/* =========================
 * Template for the 'Static' page.
 * =========================
 */
?>

<?php
get_header();
?>

<div id="default" class="container">
	<?php
	if( have_posts()) {
		while ( have_posts()) {
			the_post();
			the_content();
		}
	}
	?>
	<?php
	if (is_page('Corporate Governance')){
		get_sidebar();
	}
	?>
</div>

<?php
get_footer();
?>
