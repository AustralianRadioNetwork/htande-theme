<?php
/**
 *  functions
 */
?>

<?php

// Theme support
function _theme_support(){
	add_theme_support('title-tag');
	add_theme_support('custom-logo');
	add_theme_support('html5', 'gallery');
	add_theme_support('custom-background', [
		'default-color' => '#fff',
		'default-image' => get_template_directory_uri() . '/assets/images/fingerpatt-light-top.gif',
	]);
}

add_action('after_setup_theme', '_theme_support');

// Register new sidebar
function new_sidebar() {

	register_sidebar( array(
		'name'          => 'Main Sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<div class="chw-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="chw-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'new_sidebar' );


// All navigation menus
function site_menus() {
	$locations = array(
		'primary' => "Desktop header menu",
		'secondary' => "Desktop right menu",
		'footer' => "Footer menu"

	);
	register_nav_menus($locations);
}
add_action('init', 'site_menus');

// Using hook to install scripts/styles

function new_styles() {

	// JS
	wp_enqueue_script('slick-js', get_template_directory_uri() ."/assets/js/slick.min.js", ['jquery'], false, true);
	wp_enqueue_script('carousel-js', get_template_directory_uri() ."/assets/js/carousel.js", ['jquery', 'slick-js'], false, true);
	wp_enqueue_script('menu-js', get_template_directory_uri() ."/assets/js/menu.js", array(), false, true);

	// CSS
	wp_enqueue_style('htande-style', get_template_directory_uri() . "/style.css", array(), '1.0', 'all');
	wp_enqueue_style('slick-css', get_template_directory_uri() . "/assets/css/slick.css", array(), false, 'all');
	wp_enqueue_style('slick-theme-css', get_template_directory_uri() . "/assets/css/slick-theme.css", ['slick-css'], false, 'all');
}
add_action('wp_enqueue_scripts', 'new_styles');

// New post type - Press Relaese
function custom_post_type() {

	$labels = array(
		'name'                => _x( 'Press Releases', 'Post Type General Name', 'HT&E' ),
		'singular_name'       => _x( 'Press Release', 'Post Type Singular Name', 'HT&E' ),
		'menu_name'           => __( 'Press Releases', 'HT&E' ),
		'parent_item_colon'   => __( 'Parent Movie', 'HT&E' ),
		'all_items'           => __( 'All ', 'HT&E' ),
		'view_item'           => __( 'View Press Release', 'HT&E' ),
		'add_new_item'        => __( 'Add New Press Release', 'HT&E' ),
		'add_new'             => __( 'Add New', 'HT&E' ),
		'edit_item'           => __( 'Edit Press Release', 'HT&E' ),
		'update_item'         => __( 'Update Press Release', 'HT&E' ),
		'search_items'        => __( 'Search Press Release', 'HT&E' ),
		'not_found'           => __( 'Not Found', 'HT&E' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'HT&E' ),
	);

	$args = array(
		'label'               => __( 'press release', 'HT&E' ),
		'description'         => __( 'All the press releases', 'HT&E' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions','date' ),
		'taxonomies'          => array( 'genres' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,
		'register_meta_box_cb' => true,
		'supports' => array( "title", "editor", "thumbnail", "excerpt", "custom-fields"),

	);
	register_post_type( 'pressrelease', $args );
}
add_action( 'init', 'custom_post_type', 0 );


// New metadata field
function add_custom_meta_boxes() {
	add_meta_box('wp_custom_attachment', 'Attach PDF', 'wp_custom_attachment', 'pressrelease', side, 'default');
}
add_action('add_meta_boxes', 'add_custom_meta_boxes');

// PDF attachment
function wp_custom_attachment() {
	wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');
	$html = '<p class="description">';
	$html .= 'Upload your PDF here.';
	$html .= '</p>';
	$html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25">';
	$filearray = get_post_meta( get_the_ID(), 'wp_custom_attachment', true );
	$this_file = $filearray['url'];
	if($this_file != ""){
		$html .= '<div>Current file:<br>"' . $this_file . '"</div>';
	}
	echo $html;
}

function save_custom_meta_data($id) {

	/* --- security verification --- */
	if(!wp_verify_nonce($_POST['wp_custom_attachment_nonce'], plugin_basename(__FILE__))) {
		return $id;
	} // end if

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $id;
	} // end if

	if('page' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $id)) {
			return $id;
		} // end if
	} else {
		if(!current_user_can('edit_page', $id)) {
			return $id;
		} // end if
	} // end if
	/* - end security verification - */

	// Make sure the file array isn't empty
	if(!empty($_FILES['wp_custom_attachment']['name'])) {

		// Setup the array of supported file types. In this case, it's just PDF.
		$supported_types = array('application/pdf');

		// Get the file type of the upload
		$arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));
		$uploaded_type = $arr_file_type['type'];

		// Check if the type is supported. If not, throw an error.
		if(in_array($uploaded_type, $supported_types)) {

			// Use the WordPress API to upload the file
			$upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));

			if(isset($upload['error']) && $upload['error'] != 0) {
				wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
			} else {
				add_post_meta($id, 'wp_custom_attachment', $upload);
				update_post_meta($id, 'wp_custom_attachment', $upload);
			} // end if/else

		} else {
			wp_die("The file type that you've uploaded is not a PDF.");
		} // end if/else

	} // end if

} // end save_custom_meta_data

add_action('save_post', 'save_custom_meta_data');

function update_edit_form() {
	echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'update_edit_form');


// read/write function for custom_meta_field

add_action("rest_insert_pressrelease", function ($post, $request, $creating) {
	$metas = $request->get_param("meta");

	if (is_array($metas)) {
		foreach ($metas as $name => $value) {
			update_post_meta($post->ID, $name, $value);
		}

	}
}, 10, 3);

// Show in Rest API
add_action( 'rest_api_init', function () {
	register_rest_field( 'pressrelease', 'wp_custom_attachment', array(
		'get_callback' => function( $post_arr ) {
			return get_post_meta( $post_arr['id'], 'wp_custom_attachment', true );
		},
//		'update_callback' => function($value, $post_arr ) {
//			// Perform Validation of input
//			if (!$value || !is_string($value)) {
//				return;
//			}
//			// Update the field
//			return update_post_meta($post_arr['id'], 'wp_custom_attachment', $value);
//		},
//		'schema' => array(
//			'description' => 'The attached file.',
//			'context' => array('view', 'edit')
//		)
	) );
} );


// Use this to register meta-field inside meta:{}
//$args = array(
//	'type'=>'string',
//	'single'=>true,
//	'show_in_rest'=>true
//);
//register_post_meta('pressrelease', 'wp_custom_attachment', $args);


// custom html gallery output
add_filter('post_gallery','customFormatGallery',10,2);

function customFormatGallery($string,$attr){

	$output = "<div class=\"gallery-carousel\">";
	$posts = get_posts(array('include' => $attr['ids'],'post_type' => 'attachment'));
	foreach($posts as $imagePost){
		$output .= "<div class=''><img src='".wp_get_attachment_image_src($imagePost->ID, 'full')[0]."'> </div>";
	}

	$output .= "</div>";

	return $output;
}
?>



