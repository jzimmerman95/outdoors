<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
 
    global $page, $paged;
 
    wp_title( '|', true, 'right' );
 
    bloginfo( 'name' );
 
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";
 
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );
 
    ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.0/css/iziModal.min.css">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.6.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.0/js/iziModal.min.js" type="text/javascript"></script>
 
<?php
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
 
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
?>
</head>
 
<body <?php body_class(); ?>>
 
    <header>
        <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to the 'starkers_menu' function which can be found in functions.php.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ 
        if (is_user_logged_in()): ?>
            <nav class="menu-external-menu-container">
                <ul id="menu-external-menu" class="menu">
                    <li id="menu-item-5" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5"><a href="/outdoors/profile/" class="menu-image-title-after"><span class="menu-image-title">PROFILE</span></a></li>
                    <li id="menu-item-16" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-16"><a href="/outdoors/upcoming-trips/" class="menu-image-title-after"><span class="menu-image-title">UPCOMING TRIPS</span></a></li>
                    <li id="menu-item-81" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-30 current_page_item menu-item-81"><a href="/outdoors/" class="menu-image-title-hide menu-image-not-hovered"><span class="menu-image-title">Home</span><img width="110" height="87" src="/outdoors/wp-content/uploads/logo.png" class="menu-image menu-image-title-hide" alt="" srcset="/outdoors/wp-content/uploads/logo.png 110w, /outdoors/wp-content/uploads/logo-24x19.png 24w, /outdoors/wp-content/uploads/logo-36x28.png 36w, /outdoors/wp-content/uploads/logo-48x38.png 48w" sizes="(max-width: 110px) 100vw, 110px"></a></li>
                    <li id="menu-item-17" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-17"><a href="/outdoors/faq/" class="menu-image-title-after"><span class="menu-image-title">FAQ</span></a></li>
                    <li id="menu-item-18" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-18"><a href="/outdoors/contact/" class="menu-image-title-after"><span class="menu-image-title">CONTACT</span></a></li>
                </ul>
            </nav>
        <?php else: ?>
            <nav class="menu-external-menu-container">
                <ul id="menu-external-menu" class="menu">
                    <li id="menu-item-5" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5"><a href="/outdoors/sign-in/" class="menu-image-title-after"><span class="menu-image-title">SIGN IN</span></a></li>
                    <li id="menu-item-16" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-16"><a href="/outdoors/sign-up/" class="menu-image-title-after"><span class="menu-image-title">SIGN UP</span></a></li>
                    <li id="menu-item-81" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-30 current_page_item menu-item-81"><a href="/outdoors/" class="menu-image-title-hide menu-image-not-hovered"><span class="menu-image-title">Home</span><img width="110" height="87" src="/outdoors/wp-content/uploads/logo.png" class="menu-image menu-image-title-hide" alt="" srcset="/outdoors/wp-content/uploads/logo.png 110w, /outdoors/wp-content/uploads/logo-24x19.png 24w, /outdoors/wp-content/uploads/logo-36x28.png 36w, /outdoors/wp-content/uploads/logo-48x38.png 48w" sizes="(max-width: 110px) 100vw, 110px"></a></li>
                    <li id="menu-item-17" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-17"><a href="/outdoors/faq/" class="menu-image-title-after"><span class="menu-image-title">FAQ</span></a></li>
                    <li id="menu-item-18" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-18"><a href="/outdoors/contact/" class="menu-image-title-after"><span class="menu-image-title">CONTACT</span></a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </header>
    