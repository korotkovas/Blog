<?php

function wptuts_setup() {
	//leidziam isversti kalba
	load_theme_textdomain('wptuts');

	//leidziam pluginam ir temom keisti metataga title
	add_theme_support('title-tag');

	//palaikymas uzkrovimo custominio logo per customizeri
	add_theme_support('custom-logo', array(
		'height' => 30,
	 	'width' => 134,
	 	'flex-height' => true 
	));

	// supportas thumbnailo
	add_theme_support('post-thumbnails');
	//musu thumbnails(nuotrauku sizas)
	set_post_thumbnail_size(730,446);
	// supportas html5 (paieskos formai, komantaram, galerijai )
	add_theme_support('html5', array(
		'search-form',
		'comment-list',
		'gallery'
	));
	// as naudoju tik image tai kitus galima uzkomentuoti.
	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'gallery',
	));
	// Sia funcija galima kviesti bet nepatariama, yra kita.
	// add_theme_support('menus');

	//sita funkcija kvieciama ant evento after_setup_theme.
	register_nav_menu('primary', 'Primary menu');
}

add_action('after_setup_theme', 'wptuts_setup');


function wptuts_scripts() {
	wp_enqueue_style( 'style-css', get_stylesheet_uri() );
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.min.css' );
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

	// prijungiam scriptus
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . 'js/js/example.js' );
	wp_enqueue_script( 'css3-animate-it', get_template_directory_uri() . 'js/css3-animate-it.js' );
	wp_enqueue_script( 'agency', get_template_directory_uri() . 'js/agency.js' );
	wp_enqueue_script( 'agency', get_template_directory_uri() . 'js/jquery.jquery.easing.min.js' );

}
//perduodam pavadinima funkcijos
add_action ('wp_enqueue_scripts', 'wptuts_scripts');