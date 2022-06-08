<?php 

//require_once('class-wp-bootstrap-navwalker.php');
add_theme_support( 'post-thumbnails' );
///////////////////////////////////////////////////////////////////////////////////////////////
                   /* Css scripts */
///////////////////////////////////////////////////////////////////////////////////////////////
function website_design(){
    wp_enqueue_style('slick',get_template_directory_uri().'/css/slick.css');
    wp_enqueue_style('animate',get_template_directory_uri().'/css/animate.css');
    wp_enqueue_style('nice-select',get_template_directory_uri().'/css/nice-select.css');
    wp_enqueue_style('jquery-nice-number',get_template_directory_uri().'/css/jquery.nice-number.min.css');
    wp_enqueue_style('magnific-popup',get_template_directory_uri().'/css/magnific-popup.css');
    wp_enqueue_style('bootstrap-css',get_template_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style('default',get_template_directory_uri().'/css/default.css');
    wp_enqueue_style('style',get_template_directory_uri().'/css/style.css');
    wp_enqueue_style('responsive',get_template_directory_uri().'/css/responsive.css');
}
///////////////////////////////////////////////////////////////////////////////////////////////
                   /* Js scripts */
///////////////////////////////////////////////////////////////////////////////////////////////
function website_scripts(){
    wp_deregister_script('jquery'); // remove old jquery because wordpress put it in head
    wp_register_script('jquery',get_template_directory_uri().'/js/vendor/jquery-1.12.4.min.js',array(),false,true); // add nw jquery
    wp_enqueue_script('jquery');// enqueue jquery
    wp_enqueue_script('modernizr',get_template_directory_uri().'/js/vendor/modernizr-3.6.0.min.js',array(),false,true);
    wp_enqueue_script('bootstrap-js',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),false,true);
    wp_enqueue_script('slick',get_template_directory_uri().'/js/slick.min.js',array(),false,true);
    wp_enqueue_script('jquery-magnific-popup',get_template_directory_uri().'/js/jquery.magnific-popup.min.js',array(),false,true);
    wp_enqueue_script('waypoints',get_template_directory_uri().'/js/waypoints.min.js',array(),false,true);
    wp_enqueue_script('jquery-counterup',get_template_directory_uri().'/js/jquery.counterup.min.js',array(),false,true);
    wp_enqueue_script('jquery-nice-select',get_template_directory_uri().'/js/jquery.nice-select.min.js',array(),false,true);
    wp_enqueue_script('jquery-nice-number',get_template_directory_uri().'/js/jquery.nice-number.min.js',array(),false,true);
    wp_enqueue_script('jquery-countdown.min',get_template_directory_uri().'/js/jquery.countdown.min.js',array(),false,true);
    wp_enqueue_script('validator',get_template_directory_uri().'/js/validator.min.js',array(),false,true);
    wp_enqueue_script('ajax-contact',get_template_directory_uri().'/js/ajax-contact.js',array(),false,true);
    wp_enqueue_script('main',get_template_directory_uri().'/js/main.js',array(),false,true);
    wp_enqueue_script('map-script',get_template_directory_uri().'/js/map-script.js',array(),false,true);
    wp_enqueue_script('html5shiv',get_template_directory_uri().'/js/html5shiv.js');
    wp_script_add_data('html5shiv','conditional','lte IE 9'); // Add script depend on condition
    wp_enqueue_script('respond',get_template_directory_uri().'/js/respond.min.js');
    wp_script_add_data('respond','conditional','lte IE 9'); // Add script depend on condition
}
add_action('wp_enqueue_scripts','website_design');
add_action('wp_enqueue_scripts','website_scripts');
///////////////////////////////////////////////////////////////////////////////////////////////
                   /* show how many words show per post */
///////////////////////////////////////////////////////////////////////////////////////////////
function WebsiteExcerptLingth($length){
    return 8;
}
add_filter('excerpt_length','WebsiteExcerptLingth');
///////////////////////////////////////////////////////////////////////////////////////////////
                   /* more to show post in single page */
///////////////////////////////////////////////////////////////////////////////////////////////
function WebsiteExcerptMore($more){
    return ' ...';
}
add_filter('excerpt_more','WebsiteExcerptMore');
///////////////////////////////////////////////////////////////////////////////////////////////
                   /* register header and footer menu */
///////////////////////////////////////////////////////////////////////////////////////////////
function addCustomMenu(){
    register_nav_menus(array(
        'Header-Menu-Logout' => 'HeaderForLogout',
        'Header-Menu' => 'Header',
        'Footer-Menu' => 'Footer'
    ));// add menu
}
add_action('init','addCustomMenu');
///////////////////////////////////////////////////////////////////////////////////////////////
                    /* Header menu */
///////////////////////////////////////////////////////////////////////////////////////////////
// Menu for logout
function HeaderLogoutMenu(){
    wp_nav_menu(array(
    'menu' => 'Header-Menu-Logout',
    'menu_class' => 'navbar-nav mr-auto',
        ));
    }
// Menu for login
function HeaderMenu(){
wp_nav_menu(array(
'menu' => 'Header-Menu',
'menu_class' => 'navbar-nav mr-auto',
    ));
}
///////////////////////////////////////////////////////////////////////////////////////////////
                     /* Footer menu */
///////////////////////////////////////////////////////////////////////////////////////////////
function FooterMenu(){
wp_nav_menu(array(
'menu' => 'Footer-Menu',
'menu_class' => 'navbar-nav mr-auto',
'link_before' => '<i class="fa fa-angle-right"></i>',
    ));
}
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );
///////////////////////////////////////////////////////////////////////////////////////////////
                    /* Add slider section by adding new post type called slider */
///////////////////////////////////////////////////////////////////////////////////////////////
function create_post_type(){
$values = array(
    'public'          => true, 
    'labels'          => array('name' => 'slider'), 
    'menu_icon'        => 'dashicons-images-alt',
    'supports'   => array('title','editor','thumbnail'),
);
register_post_type('slider',$values);
}
add_action('init','create_post_type');
///////////////////////////////////////////////////////////////////////////////////////////////
                    /* Count post view by add meta key post_views_count */
///////////////////////////////////////////////////////////////////////////////////////////////
function setPostViews($postID) {
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
    }else{
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////
                  /* Create custom MetaBox */
///////////////////////////////////////////////////////////////////////////////////////////////
function CreateTextfield()
{
$screen = 'post';
add_meta_box('my-meta-box-id','Featured Courses','displayeditor',$screen,'normal','high');
}
add_action( 'add_meta_boxes', 'CreateTextfield' ) ;

/*Display PostMeta*/
function displayeditor($post)
{
global $wbdb;
$metaeditor = 'metaeditor';
$custom = get_post_custom($post->ID);
$sl_meta_box_sidebar = $custom["metaeditor"][0]; 
?>
<label for="my_meta_box_text">On</label>
<input type="checkbox" name="my_meta_box_text" <?php if( $sl_meta_box_sidebar == true ) { ?>checked="checked"<?php } ?> /> 
   <?php        
}

/*Save Post Meta*/
function saveshorttexteditor($post)
{
$editor = $_POST['my_meta_box_text'];
update_post_meta(  $post, 'metaeditor', $editor);
}
add_action('save_post','saveshorttexteditor');
///////////////////////////////////////////////////////////////////////////////////////////////
                     /* Show header menu depending on user loged in or not */
///////////////////////////////////////////////////////////////////////////////////////////////
function my_wp_nav_menu_args( $args = '' ) {                         
    if( is_user_logged_in() ) {
    // Logged in menu to display
    $args['theme_location'] = 'Header-Menu-Logout';
    } else {
    // Non-logged-in menu to display
    $args['theme_location'] = 'Header-Menu';
    }
    return $args;
    }
    add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
///////////////////////////////////////////////////////////////////////////////////////////////
                    /* Redirect user or admin to home page after login */
///////////////////////////////////////////////////////////////////////////////////////////////
    function admin_default_page() {
        return '/wordpress';
      }
      add_filter('login_redirect', 'admin_default_page');
///////////////////////////////////////////////////////////////////////////////////////////////
                    /* Logout without confirm redirect to home page */
///////////////////////////////////////////////////////////////////////////////////////////////
      add_action('check_admin_referer', 'logout_without_confirm', 10, 2);
      function logout_without_confirm($action, $result)
      {
          /**
           * Allow logout without confirmation
           */
          if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
              $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : '/wordpress';
              $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
              header("Location: $location");
              die;
          }
      }