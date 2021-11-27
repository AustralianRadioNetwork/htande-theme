<?php
/** HomePage Side bar */
?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-homepage') ) : ?>
<?php endif; ?>

<div id="rightcolumn" class="side-content">
	<div class="content"></div>
	<div class="pressreleases clearfix">
		<h2>HT&E News</h2>
		<ul>
			<?php
			$recent_posts = wp_get_recent_posts(
				array(
					'post_type'=>'Press Release',
					'posts_per_page' => 4,
					'orderby' => 'date',
				));
			foreach( $recent_posts as $recent ){
				$id = $recent['ID'];
				$attach_pdf = get_post_meta( $id, 'wp_custom_attachment', true );
				$attachment = $attach_pdf['url'] ;
				echo '<li><h4>' .$recent["post_title"]. '</h4><p><a href="'.$attachment.'" >Open PDF Doc</a></p></li> ';
			}
			?>
		</ul>
		<p><a class="viewmore" href="/wordpress/press">View More Press Releases &gt;</a></p>
	</div>
</div>
