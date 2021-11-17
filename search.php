<?php
/**
 * Template Name: Search Page
 */
?>

<?php
get_header();
global  $wp_query;
//echo '<pre/>';
//print_r($wp_query);
//wp_die();
?>
	<section class="search-pages" id="maincontent">
		<div class="container">
			<h2 class="title">Search Results</h2>
			<p> Your search for "<?php the_search_query(); ?>" which returned <?php echo $wp_query -> found_posts; ?>  possible matches. </p>
			<?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php
					echo '<li  class="search-results">';
					$title = the_title();
					$id = get_the_ID();
					$attach_pdf = get_post_meta( $id, 'wp_custom_attachment', true );
					$post_date = get_the_date( 'M j, Y' );
					$attachment = $attach_pdf['url'] ;
					echo '<a href="'.$attachment.'">'.'Visit'.'</li>';
					echo '</a>';
				?>
			<?php endwhile; else : ?>
				<p> <?php esc_html_e('Sorry, no posts matched your criteria'); ?></p>
			<?php endif; ?>
		</div>
	</section>
<?php get_footer(); ?>
