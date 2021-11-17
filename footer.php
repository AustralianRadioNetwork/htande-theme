<footer>
	<div class="container">
		<div class="brandlogos">
			<?php $logo = get_option('logo_image') ?>
			<?php $brand = get_option('brand_url')  ?>
			<ul>
				<?php for($i = 0; $i < count($logo); $i++) {?>
					<li><a href="<?php $options_value = esc_url($brand[$i]); echo $options_value;?>" target="__blank"><img src=" <?php $options_value = esc_url($logo[$i]); echo $options_value;?>" id="logo[<?php echo  $i ?>]" alt="" /></a></li>
				<?php }?>
			</ul>
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
		<div class="copyright">&#169; HT&amp;E <?php echo date("Y"); ?></div>
	</div>
</footer>

</body>
</html>

<?php wp_footer(); ?>
