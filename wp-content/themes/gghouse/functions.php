<?php
// Enqueue styles and scripts
function my_theme_enqueue_styles()
{
    wp_enqueue_style('my-theme-style', get_stylesheet_uri() . '/style.css');
    wp_enqueue_script('my-theme-scripts', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Register Navigation Menu
function my_theme_register_menus()
{
    register_nav_menus(array(
        'main-menu' => 'Main Menu',
    ));
}
add_action('after_setup_theme', 'my_theme_register_menus');





// Đăng ký menu cho footer
function my_theme_register_footer_menu()
{
    register_nav_menus(array(
        'footer-menu' => 'Footer Menu', // Tên của menu
        'footer-bottom-menu' => 'Footer Bottom Menu'
    ));
}
add_action('after_setup_theme', 'my_theme_register_footer_menu');


function enqueue_fontawesome()
{
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_fontawesome');