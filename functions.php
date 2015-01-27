<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
function enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function my_scripts_method() {
	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '/js/minnow.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

/**
 * Attach a class to linked images' parent anchors
 * e.g. a img => a.img img
 */
function give_linked_images_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
  $classes = 'img'; // separated by spaces, e.g. 'img image-link'

  // check if there are already classes assigned to the anchor
  if (preg_match('/(<a.*?)(class=".*">)/', $html)) {
	$html = preg_replace('/(<a.*? class=")(.*?" )(.*?\="" ?="">)/', '$1 ' . $classes . ' $2 $3', $html);
} else {
	$html = preg_replace('/(<a.*?)(.*?>)/', '$1 class="' . $classes . '" $2', $html);
}
  return $html;
}
add_filter('image_send_to_editor','give_linked_images_class',10,8);


?>