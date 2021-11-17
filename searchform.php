<section class="header-search-form" id="search">
	<form role="search" method="get" id="searchform"
		  class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="text" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" id="search-input" />
			<button type="submit" id="searchsubmit" value=""/>
	</form>
</section>

