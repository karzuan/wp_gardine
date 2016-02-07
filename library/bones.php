<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

  - head cleanup (remove rsd, uri links, junk css, ect)
  - enqueueing scripts & styles
  - theme support functions
  - custom menu output & fallbacks
  - related post function
  - page-navi function
  - removing <p> from around images
  - customizing the post excerpt

*/

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {

		
		// register main stylesheet
		wp_register_style( 'main', get_stylesheet_directory_uri() . '/library/css/main.css', array(), '', 'all' );
                wp_register_style( 'fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,300,500&subset=latin,cyrillic', array(), '', 'all' );
    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		  wp_enqueue_script( 'comment-reply' );
    }

		//adding scripts file in the footer
                wp_register_script( 'flexslider-min', get_stylesheet_directory_uri() . '/library/js/jquery.flexslider-min.js', array( '' ), '', false );
                wp_register_script( 'main_script', get_stylesheet_directory_uri() . '/library/js/main.js', array(), '', true );
                wp_register_script( 'google', get_stylesheet_directory_uri() . '/library/js/google.js', array(), '', true );

		// enqueue styles and scripts
                wp_enqueue_script( 'flexslider-min' );
                wp_enqueue_script( 'main_script' );
                wp_enqueue_script( 'google' );
		
                wp_enqueue_style ( 'main' );
                wp_enqueue_style ( 'fonts' );


	}
}

/* Allow shortcodes in widget areas */
add_filter('widget_text', 'do_shortcode');

// Google jquery вместо стандартной wordpress
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => '',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'bonestheme' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'bonestheme' ) // secondary nav in footer
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

} /* end bones theme support */


/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts() {
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'bonestheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} /* end bones related posts function */

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function bones_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'bonestheme' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'bonestheme' ) .'</a>';
}

function breadcrumbs(){
    
        //Хлебные крошки
      echo  '<ul id="breadcrumbs">';
         if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('<li>','</li>');
}								
       echo      '</ul>';
}

function blog_piece($content, $num ){
     //$content = get_the_content(); // for blog_piece()   
     $content = strip_tags($content);
     return mb_substr($content, 0, $num);
                                
}


/************* Функция добавления последних постов из категории ********************/

function my_recent_posts_shortcode($atts){
 
 $q = new WP_Query(
 array( 'orderby' => 'date', 'posts_per_page' => '3')
 );

$list = '<div class="row">';

while($q->have_posts()) : $q->the_post();
$content = get_the_content();
$list .= '<div class="col-third">'. '<div class="latest-post"><span class="latest-post-time">'. get_the_time( 'd F', $post ) .'</span>'

. '<a class="latest-post-title-link" href="'  . get_permalink() . '">' . get_the_title() . '</a>'
        
. '<p class="latest-post-exerpt">' . 
                                blog_piece($content, 350) . '...</p>'
. '<p><a href="' . get_permalink() . '">' . 'читать далее' . '</a></p>'

.'</div>'
.'</div>';

endwhile;

wp_reset_query();

return $list . '</div>';

}

add_shortcode('ZIHUATANUKA', 'my_recent_posts_shortcode');



////// категории статей

    function my_category($categories){      
             
             // function got category from fetching
             $category_id = $categories[0]->cat_ID;
             $current_name = $categories[0]->cat_name;
          
             $cat = array(
              "ID"   => $category_id,
              "name" => $current_name,
              "link" => get_category_link( $category_id )
                    );
             
          return $cat; // returns array
    }
    
    
////// поиск для шапки
    
    function my_searchform(){
        
   $list .= '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '">'
        
        . '<input type="search" placeholder="Поиск..." id="s" name="s" value="">'
        . '</form>';
   return $list;
    
                            }
                            
////********** add custom Background to pages *********////
                           

  function adding_custom_meta_boxes( $pages ) {
      
    
    add_meta_box( 
        'my-meta-box',
        'Изображение фона заголовка(шапки)',
        'render_my_meta_box',
        'page',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'adding_custom_meta_boxes', 10, 2 );

    function render_my_meta_box($post)
{
        
        global $wpdb;
$b_uri = $wpdb->get_var( 'SELECT b_uri FROM kot_posts WHERE id = ' . get_the_ID () );

     if($b_uri) { 
        $b_uri = $b_uri ;        
                      }
     else $b_uri = 'пустое_поле';
    
?>

    <label>Введите URL изображения</label>
    <input class="postbox" value='<?=$b_uri;?>' type="text" name="b_uri" size="60%" maxlength="255">

 <?php
}

add_action( 'save_post', 'my_meta_box_save_data' );
function my_meta_box_save_data( $page_id ) {
    if ( array_key_exists('b_uri', $_POST ) ) {
     global $wpdb;
     $table = 'kot_posts';
     $data = array( 
		'b_uri' => stripslashes( $_POST['b_uri'])	// string
                  );
          
     $where = array( 'ID' => $page_id );
     
     
     
     $wpdb->update( $table, $data, $where, $format = null, $where_format = null );
    }
}
/*
 function update_my_meta_box($b_uri, $post){
     $table = 'kot_posts';
     $data = array( 
		'b_uri' => stripslashes($b_uri)	// string
                  );
          
     $where = array( 'ID' => $page_id );
     
     
     
     $wpdb->update( $table, $data, $where, $format = null, $where_format = null );
                                    }
*/

     
     function pages_back($page_id){
         global $wpdb;
         // fetch df if there is url for background
         $results = $wpdb->get_var( 'SELECT b_uri FROM kot_posts WHERE id = ' .$page_id );
         
         if ( $results ){
             // sql  querry
             // //kot_posts - таблица
             // // // b_uri - коломнa
             $b_iri = $results;
             
         }
         
         else {
             // default picture
         $b_iri = 'https://lh3.googleusercontent.com/-P67hv3NzJsk/VSjasTIFzcI/AAAAAAAAADA/0hPeCcG-KXE/w1498-h1124-no/';
// get_template_directory_uri();    '/library/images/anypicture.jpg';
              }
         //return $b_iri[b_uri];
         return $b_iri;
         // array(1) { [0]=> object(stdClass)#4479 (1) { ["b_uri"]=> string(18) "102010102010120102" } }
     }
     ////********************** END ************************///
     ////********** add custom Background to pages *********///
     
  //**********************/ START \**************************\\
//******************/ GET FEATURED IMAGE \**********************\\
 // IN DA POSTS AREA
     
//add_theme_support('post-thumbnails');
//add_image_size('featured_preview', 55, 55, true);
     
     
function ST4_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN
function ST4_columns_head($defaults) {
    $defaults['featured_image'] = 'Featured Image';
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function ST4_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = ST4_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img width="125" height="125" src="' . $post_featured_image . '" />';
        }
    }
                                                      }

/// hooks
add_filter('manage_posts_columns', 'ST4_columns_head');
add_action('manage_posts_custom_column', 'ST4_columns_content', 10, 2);



//******************\ GET FEATURED IMAGE /**********************/
 //************************\ END /*****************************//
?>
