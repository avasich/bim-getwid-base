<?php
function getwid_base_enqueue_styles()
{
    $parent_handle = 'getwid-base-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style(
        $parent_handle,
        get_template_directory_uri() . '/style.css',
        array(),  // If the parent theme code has a dependency, copy it to here.
        $theme->parent()->get('Version')
    );
    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array($parent_handle),
        $theme->get('Version') // This only works if you have Version defined in the style header.
    );
}

add_editor_style();

add_action('wp_enqueue_scripts', 'getwid_base_enqueue_styles');

require get_stylesheet_directory() . '/inc/customizer.php';

add_filter('wp_nav_menu_objects', 'ad_filter_menu', 10, 2);

require_once get_stylesheet_directory() . '/hooks/lightbox-wrapper.php';

function ad_filter_menu($sorted_menu_objects, $args)
{
    global $wp, $post, $wp_query, $basepress_utils;

    if ($args->theme_location != 'menu-1') {
        return $sorted_menu_objects;
    }

    $req = $_SERVER['REQUEST_URI'];
    $is_kb = $req == "/" || str_starts_with($req, "/bim");
    foreach ($sorted_menu_objects as $key => $menu_object) {
        if (!$is_kb && item_has_class($menu_object, "bpress-navmenu-entry")) {
            unset($sorted_menu_objects[$key]);
            continue;
        }

        if (is_user_logged_in()) {
            if (item_has_class($menu_object, "login-navmenu-entry")) {
                unset($sorted_menu_objects[$key]);
                continue;
            }
        } else if (item_has_class($menu_object, "logout-navmenu-entry")) {
            unset($sorted_menu_objects[$key]);
            continue;
        }
    }

    return $sorted_menu_objects;
}

function item_has_class($item, $class)
{
    return in_array($class, $item->classes, true);
}
