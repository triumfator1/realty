<?php
require_once get_theme_file_path('inc/duplicate-post.php');
require_once get_theme_file_path('inc/pagination.php');
add_action( 'wp_enqueue_scripts', 'understrap_child_styles' );
function understrap_child_styles() {
    wp_enqueue_style( 'understrap-child-style', get_stylesheet_uri(),
        ['understrap-styles'],
        filemtime( get_theme_file_path('style.css' )) // this only works if you have Version in the style header
    );
}

add_action( 'wp_enqueue_scripts', 'understrap_child_add_scripts' );
function understrap_child_add_scripts() {
    wp_enqueue_script( 'ajax-form', get_stylesheet_directory_uri() .'/ajax_form.js', ['jquery'], null, true );
    wp_add_inline_script( 'ajax-form', 'const ajaxUrl = `' . admin_url( 'admin-ajax.php' ) . '`', 'before' );
}

add_action( 'wp_ajax_nopriv_add_realty', 'my_ajax_handler' );
add_action( 'wp_ajax_add_realty', 'my_ajax_handler' );

function my_ajax_handler() {
    // Создаем массив
    $post_data = [
        'post_title'    => $_POST['realty_name'],
        'post_content'  => $_POST['description'],
        'post_status'   => 'pending',
        'post_author'   => 1,
        'post_type' => 'realty',
    ];
    $custom_fields = [
        'square',
        'price',
        'address',
        'square_liv',
        'floor',
        'city',
    ];
// Вставляем данные в БД
    $post_id = wp_insert_post( wp_slash($post_data) );

    if( is_wp_error($post_id) ){
        echo $post_id->get_error_message();
        wp_die();
    }
    wp_set_object_terms($post_id, $_POST['type'], 'realty_type');
    foreach ($custom_fields as $field_key){
        update_field( $field_key, $_POST[$field_key], $post_id );
    }
    wp_send_json_success( 'Объект был добавлен', 200);  //Return as array.
    wp_die();
}
