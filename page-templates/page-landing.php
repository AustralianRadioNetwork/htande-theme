<?php

/*
Template Name: Landing
*/

/* =========================
 * Template for the '' page.
 * Template for the 'Digital & Radio' page.
 * =========================
 */
?>
<?php
get_header();
?>
	<div class="landing-page-container">
		<?php
		if( have_posts()) {
			while ( have_posts()) {
				the_post();
				the_content();
			}
		}
		?>
	</div>

<?php
get_footer();
?>


