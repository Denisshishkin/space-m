<?php

add_action( 'wp_enqueue_scripts', 'space_m_scripts' );

function space_m_scripts() {
	wp_enqueue_style('main-css', get_stylesheet_directory_uri() . '/style.min.css');
	wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.1');
}



// Remove so,e scripts
function my_deregister_scripts(){

	//   // Удаляю стили
	wp_dequeue_style( 'wp-block-library' );

	//   // Удаляю скрипты
	//wp_dequeue_script( 'wp-embed' );
	wp_deregister_script( 'wp-embed' );

}
add_action( 'wp_enqueue_scripts', 'my_deregister_scripts', 100 );



// Add Post ID to Posts and Pages Admin Columns
add_filter('manage_posts_columns', 'posts_columns_id', 5);
add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
add_filter('manage_pages_columns', 'posts_columns_id', 5);
add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);

function posts_columns_id($defaults){
	$defaults['wps_post_id'] = __('ID');
	return $defaults;
}
function posts_custom_id_columns($column_name, $id){
	if($column_name === 'wps_post_id'){
		echo $id;
	}
}


// Custom Column with Currently Active Page Template
add_filter( 'manage_pages_columns', 'page_column_views' );
add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );
function page_column_views( $defaults )
{
	$defaults['page-layout'] = __('Template');
	return $defaults;
}
function page_custom_column_views( $column_name, $id )
{
	if ( $column_name === 'page-layout' ) {
		$set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
		if ( $set_template == 'default' ) {
			echo 'Default';
		}
		$templates = get_page_templates();
		ksort( $templates );
		foreach ( array_keys( $templates ) as $template ) :
			if ( $set_template == $templates[$template] ) echo $template;
		endforeach;
	}
}


// Create a Media Library URL Column
function muc_column( $cols ) {
    $cols["media_url"] = "URL";
    return $cols;
}
function muc_value( $column_name, $id ) {
    if ( $column_name == "media_url" ) echo '<input type="text" width="100%" onclick="jQuery(this).select();" value="'. wp_get_attachment_url( $id ). '" />';
}
add_filter( 'manage_media_columns', 'muc_column' );
add_action( 'manage_media_custom_column', 'muc_value', 10, 2 );


// Add theme support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );


// Add image column to posts
if (function_exists( 'add_theme_support' )){
    add_filter('manage_posts_columns', 'posts_columns', 1, 5);
    add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
    add_filter('manage_pages_columns', 'posts_columns', 1, 5);
    add_action('manage_pages_custom_column', 'posts_custom_columns', 5, 2);
}
function posts_columns($defaults){
    $defaults['wps_post_thumbs'] = __('Изображение');
    return $defaults;
}
function posts_custom_columns($column_name, $id){
    if($column_name === 'wps_post_thumbs'){
        echo the_post_thumbnail( array(125,80) );
    }
}



// Remove the Comments Column from Pages
function remove_pages_count_columns($defaults) {
  unset($defaults['comments']);
  return $defaults;
}
add_filter('manage_pages_columns', 'remove_pages_count_columns');
add_filter('manage_media_columns', 'remove_pages_count_columns');


// Remove WordPress Version from RSS Feed
function remove_feed_generator() {
return '';
}
add_filter('the_generator', 'remove_feed_generator');


// Add Dimensions Column to WordPress Media Library
// function wh_column( $cols ) {
//     $cols["dimensions"] = "Dimensions (w, h)";
//     return $cols;
// }
// function wh_value( $column_name, $id ) {
//     $meta = wp_get_attachment_metadata($id);
//            if(isset($meta['width']))
//            echo $meta['width'].' x '.$meta['height'];
// }
// add_filter( 'manage_media_columns', 'wh_column' );
// add_action( 'manage_media_custom_column', 'wh_value', 10, 2 );




// Sets the extension and mime type for .webp files.
add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_webp', 10, 4 );
function wpse_file_and_ext_webp( $types, $file, $filename, $mimes ) {
	if ( false !== strpos( $filename, '.webp' ) ) {
		$types['ext'] = 'webp';
		$types['type'] = 'image/webp';
	}

	return $types;
}


// Adds webp filetype to allowed mimes
add_filter( 'upload_mimes', 'wpse_mime_types_webp' );
function wpse_mime_types_webp( $mimes ) {
	$mimes['webp'] = 'image/webp';

	return $mimes;
}





// Remove query
function remove_query_strings() {
	if(!is_admin()) {
		add_filter('script_loader_src', 'remove_query_strings_split', 15);
		add_filter('style_loader_src', 'remove_query_strings_split', 15);
	}
}

function remove_query_strings_split($src){
	$output = preg_split("/(&ver|\?ver)/", $src);
	return $output[0];
}
add_action('init', 'remove_query_strings');




// Disable admin bar except for admin
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

add_action('after_setup_theme', 'remove_admin_bar');



// Disable self pingbacks in WordPress
function disable_self_trackback( &$links ) {
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, get_option( 'home' ) ) )
	unset($links[$l]);
}
add_action( 'pre_ping', 'disable_self_trackback' );






// Disable the emoji's
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );


// Filter function used to remove the tinymce emoji plugin.
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


// Remove emoji CDN hostname from DNS prefetching hints.
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}




// Hide WP version
function dartcreations_remove_version() {
	return '';
}
add_filter('the_generator', 'dartcreations_remove_version');
