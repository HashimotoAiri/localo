<?php
// Original Custom Type
add_action('init', 'dp_custom_post_type'); 
// Hook before WordPress loaded
function dp_custom_post_type() {
    global $options;

    // ------- News type start --------
    $id = !empty($options['news_cpt_slug_id']) ? $options['news_cpt_slug_id'] : 'news';
    $name = !empty($options['news_cpt_name']) ? $options['news_cpt_name'] : __('Information', 'DigiPress');
    $labels = array(
        'name'          => $name, 
        'add_new_item'  => $name.'を追加',
        'not_found'     => $name.'は見つかりませんでした。', 
        'new_item'      => '新しい'.$name, 
        'view_item'     => $name.'を表示'
    );
    $args = array(
        'labels'                => $labels, 
        'public'                => true, //publicly_queriable, show_ui, show_in_nav_menus, exclude_from_search
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'exclude_from_search'   => false,
        'capability_type'       => 'post', 
        'rewrite'               => true,
        'hierarchical'          => false, 
        'has_archive'           => true,
        'menu_position'         => 5, // 5 or 10 or 20
        'supports'              => array(
                                        'title',
                                        'editor',
                                        'thumbnail',
                                        'author',
                                        'excerpt',
                                        'revisions',
                                        'custom-fields'
                                        ) //add_post_type_support()を直接呼び出すエイリアス
    );
    register_post_type($id, $args);
    // ------- News type end --------
}
?>