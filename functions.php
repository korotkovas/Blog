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
	set_post_thumbnail_size(690,430);
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
	wp_enqueue_style('images', get_template_directory_uri() . '/images' );
	wp_enqueue_style( 'style-css', get_stylesheet_uri() );
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.min.css' );
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

	// prijungiam scriptus
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . 'js/js/example.js' );
	wp_enqueue_script( 'css3-animate-it', get_template_directory_uri() . 'js/css3-animate-it.js' );
	wp_enqueue_script( 'agency', get_template_directory_uri() . 'js/agency.js' );
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . 'js/jquery.jquery.easing.min.js' );

}
//perduodam pavadinima funkcijos
add_action ('wp_enqueue_scripts', 'wptuts_scripts');

add_filter('excerpt_more', function($more) {
	return '';
});

// funkcija radau pas truemisha.com (realiai nezinau net kaip ji veikia. isveda i haederi pavadinima puslapio)
function wptuts_the_breadcrumb(){
	global $post;
	if(!is_home()){ 
	   echo '<li><a href="'.site_url().'"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li> <li> / </li> ';
		if(is_single()){ // posts
		the_category(', ');
		echo " <li> / </li> ";
		echo '<li>';
			the_title();
		echo '</li>';
		}
		elseif (is_page()) { // pages
			if ($post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . '<li> / </li> ';
			}
			echo the_title();
		}
		elseif (is_category()) { // category
			global $wp_query;
			$obj_cat = $wp_query->get_queried_object();
			$current_cat = $obj_cat->term_id;
			$current_cat = get_category($current_cat);
			$parent_cat = get_category($current_cat->parent);
			if ($current_cat->parent != 0) 
				echo(get_category_parents($parent_cat, TRUE, ' <li> / </li> '));
			single_cat_title();
		}
		elseif (is_search()) { // search pages
			echo 'Search results "' . get_search_query() . '"';
		}
		elseif (is_tag()) { // tags
			echo single_tag_title('', false);
		}
		elseif (is_day()) { // archive (days)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li> ';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> <li> / </li> ';
			echo get_the_time('d');
		}
		elseif (is_month()) { // archive (months)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li>';
			echo get_the_time('F');
		}
		elseif (is_year()) { // archive (years)
			echo get_the_time('Y');
		}
		elseif (is_author()) { // authors
			global $author;
			$userdata = get_userdata($author);
			echo '<li>Posted ' . $userdata->display_name . '</li>';
		} elseif (is_404()) { // if page not found
			echo '<li>Error 404</li>';
		}
	 
		if (get_query_var('paged')) // number of page
			echo ' (' . get_query_var('paged').'- page)';
	 
	} else { // home
	   $pageNum=(get_query_var('paged')) ? get_query_var('paged') : 1;
	   if($pageNum>1)
	      echo '<li><a href="'.site_url().'"><i class="fa fa-home" aria-hidden="true">Home</a></li> <li> / </li> '.$pageNum.'- page';
	   else
	      echo '<li><i class="fa fa-home" aria-hidden="true"></i>Home</li>';
	}
}