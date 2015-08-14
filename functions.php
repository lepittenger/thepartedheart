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

/* remove woocommerce wrappers */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/* remove my theme's wrapper for woocommerce pages */
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="entry-content">';
}

function my_theme_wrapper_end() {
  echo '</div></main></div>';
}

/* add woocommerce support */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

?>
