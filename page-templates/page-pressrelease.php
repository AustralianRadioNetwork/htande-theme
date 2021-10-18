<?php

/*
Template Name: Press Release
*/

/* =========================
 * Template for the 'Press' page.
 * =========================
 */
?>

<?php
get_header();
?>
	<section id="maincontent" class="press-page">
		<div class="container">
			<div class="press-title">
				<h2>Press Releases</h2>
<!--				<h2>--><?php //the_title() ?><!-- </h2>-->
			</div>
			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
						'post_type' => 'pressrelease',
						'post_status' => 'publish',
						'posts_per_page' => 5,
						'paged' => $paged,
						'orderby' => 'post_date',
						'order' => 'ASC',
					);

				$loop = new WP_Query( $args );
			?>

				<?php if ( $loop->have_posts()) : ?>
					<?php while ( $loop->have_posts() ) : $loop->the_post();?>
						<?php
							echo '<div class="press-block">';
								$id = get_the_ID();
								$attach_pdf = get_post_meta( $id, 'wp_custom_attachment', true );
								$post_date = get_the_date( 'M j, Y' );
								$attachment = $attach_pdf['url'] ;
								echo '<h4>';
								the_title();
								echo '</h4>';
								echo '<p class="date">';
								echo $post_date;
								echo '</p>';
								 the_excerpt();
								echo '<li><a class="press-items" href="'.$attachment.'">'.'Open PDF Doc'.'</li>';
								echo '</a>';
							echo '</div>';
						?>
					<?endwhile;?>
						<div class="pagination">
							<?php
							echo paginate_links( array(
								'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
								'total'        => $loop->max_num_pages,
								'current'      => max( 1, get_query_var( 'paged' ) ),
								'format'       => '?paged=%#%',
								'show_all'     => false,
								'type'         => 'plain',
								'end_size'     => 2,
								'mid_size'     => 1,
								'prev_next'    => true,
								'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
								'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
								'add_args'     => false,
								'add_fragment' => '',
							) );
							?>
						</div>
				<?php next_posts_link(); ?>
				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
		</div>
	</section>

<?php
get_footer();
?>
