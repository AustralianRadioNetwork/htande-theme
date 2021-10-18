

<footer>
	<div class="container">
		<div class="brandlogos">

		</div>
		<?php
		wp_nav_menu(
			array(
				'menu' => 'footer',
				'container'=> '',
				'theme_location' => 'footer',
			)
		);
		?>
		<div class="copyright">&#169; HT&amp;E 2019</div>
	</div>
</footer>

</body>
</html>

<!--TODO build html css and navigation-->
<?php wp_footer(); ?>
