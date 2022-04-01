<?php /*
Plugin Name: Realty plugin
*/

function register_realty_post_type() {
    register_taxonomy( 'realty_type', [ 'realty' ], [
        'label'                 => 'Тип недвижимости', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Тип недвижимости',
            'singular_name'     => 'Тип недвижимости',
            'search_items'      => 'Искать Тип недвижимости',
            'all_items'         => 'Все Типы недвижимости',
            'parent_item'       => null,
            'parent_item_colon' => null,
            'edit_item'         => 'Ред. Тип недвижимости',
            'update_item'       => 'Обновить Тип недвижимости',
            'add_new_item'      => 'Добавить Тип недвижимости',
            'new_item_name'     => 'Новый Тип недвижимости',
            'menu_name'         => 'Тип недвижимости',
        ),
        'description'           => 'Рубрики для Типов недвижимости', // описание таксономии
        'public'                => true,
        'hierarchical'          => false,
        'rewrite'               => true,
        'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ] );

    register_post_type( 'realty', [
        'label'               => 'Недвижимость',
        'labels'              => array(
            'name'          => 'Недвижимость',
            'singular_name' => 'Недвижимость',
            'menu_name'     => 'Недвижимость',
            'all_items'     => 'Все объекты',
            'add_new'       => 'Добавить объект',
            'add_new_item'  => 'Добавить новый объект',
            'edit'          => 'Редактировать',
            'edit_item'     => 'Редактировать объект',
            'new_item'      => 'Новый объект',
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_rest'        => false,
        'rest_base'           => '',
        'show_in_menu'        => true,
        'exclude_from_search' => false,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
        'hierarchical'        => false,
        'rewrite'             => true,
        'has_archive'         => false,
        'query_var'           => true,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'          => array( 'realty_type' ),
    ] );

    register_post_type( 'city', [
        'label'               => 'Города',
        'labels'              => array(
            'name'          => 'Города',
            'singular_name' => 'Город',
            'menu_name'     => 'Города',
            'all_items'     => 'Все Города',
            'add_new'       => 'Добавить Город',
            'add_new_item'  => 'Добавить новый Город',
            'edit'          => 'Редактировать',
            'edit_item'     => 'Редактировать Город',
            'new_item'      => 'Новый Город',
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_rest'        => false,
        'rest_base'           => '',
        'show_in_menu'        => true,
        'exclude_from_search' => false,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
        'hierarchical'        => false,
        'rewrite'             => true,
        'has_archive'         => false,
        'query_var'           => true,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
    ] );
}

function add_city_metabox(){
    add_meta_box(
        'city',
        'Город',
        'city_metabox',
        'realty',
        'side',
        'default'
    );
}

function city_metabox($post){
    wp_nonce_field( plugin_basename( __FILE__ ), 'realty_city_nonce' );
    $city = get_post_meta($post->ID, 'city', true);

    echo "<p>Город</p>";
    echo "<select id='city' name='city'>";
    // Query the cities here
    $query = new WP_Query( 'post_type=city' );
    while ( $query->have_posts() ) {
        $query->the_post();
        $id = get_the_ID();
        $selected = "";

        if($id == $city){
            $selected = ' selected="selected"';
        }
        echo '<option' . $selected . ' value=' . $id . '>' . get_the_title() . '</option>';
    }
    echo "</select>";
}

function save_city_metabox($post_id){
    // Don't wanna save this now, right?
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !isset( $_POST['realty_city_nonce'] ) )
        return;
    if ( !wp_verify_nonce( $_POST['realty_city_nonce'], plugin_basename( __FILE__ ) ) )
        return;

    // We do want to save? Ok!
    $key = 'city';
    $value = $_POST[$key];
    if ( get_post_meta( $post_id, $key, FALSE ) ) { // If the custom field already has a value
        update_post_meta( $post_id, $key, $value );
    } else { // If the custom field doesn't have a value
        add_post_meta( $post_id, $key, $value );
    }
    if ( !$value ) delete_post_meta( $post_id, $key ); // Delete if blank
}

function add_city_column($columns){
    $columns['cb'] = '<input type="checkbox" />';

    $columns['title'] = _x('Title', 'column name');

    $columns['city'] = __('City');

    return $columns;
}

add_action( 'init', 'register_realty_post_type' );
add_action('admin_init', 'add_city_metabox');
add_action('save_post', 'save_city_metabox', 1, 2);
add_filter('manage_edit-realty_columns', 'add_city_column');
add_action('manage_realty_posts_custom_column', 'fill_city_columns', 10, 2);

function fill_city_columns($column_name, $id) {
    if('city' !== $column_name) return;
    $city_id = get_post_meta($id, 'city', true);
    if($city_id) {
        $city = get_post($city_id);
        $permalink = get_permalink($city);
        echo "<a href='" . $permalink . "'>" . $city->post_title . "</a>";
    }
}
