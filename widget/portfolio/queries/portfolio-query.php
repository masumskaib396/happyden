<?php
if (!defined('ABSPATH')) {
    exit;
}
$include_categories = array();
$exclude_tags = array();
$include_tags = array();
$include_authors = array();
$exclude_categories = array();
$exclude_authors = array();
$current_post_id = '';
$column_class = '';
$columns = $settings['post_grid'];
switch ($columns) {
    case 'col-md-4':
        $column_class = "col-lg-4 col-md-6";
        break;
    case 'col-md-3':
        $column_class = "col-lg-3 col-md-6";
        break;
    case 'col-md-6':
        $column_class = "col-md-6";
        break;
    case 'col-md-12':
        $column_class = "col-md-12";
        break;
    default:
        $column_class = "col-md-4";
}
if (0 != count($settings['include_categories'])) {
    $include_categories['tax_query'] = [
        'taxonomy' => 'project-category',
        'field'    => 'slug',
        'terms'    => $settings['include_categories'],
    ];
}
if (0 != count($settings['include_tags'])) {
    $include_tags = implode(',', $settings['include_tags']);
}
if (0 != count($settings['include_authors'])) {
    $include_authors = implode(',', $settings['include_authors']);
}
if (0 != count($settings['exclude_categories'])) {
    $exclude_categories['tax_query'] = [
        'taxonomy' => 'project-category',
        'operator' => 'NOT IN',
        'field'    => 'slug',
        'terms'    => $settings['exclude_categories'],
    ];
}
if (0 != count($settings['exclude_tags'])) {
    $exclude_tags['tax_query'] = [
        'taxonomy' => 'project-tag',
        'operator' => 'NOT IN',
        'field'    => 'slug',
        'terms'    => $settings['exclude_tags'],
    ];
}
if (0 != count($settings['exclude_authors'])) {
    $exclude_authors = implode(',', $settings['exclude_authors']);
}
if (array_search('current_post', $settings['exclude_by'])  && is_single() && 'portfolio' == get_post_type()) {
    $current_post_id = get_the_ID();
}
// var_dump($settings['exclude_categories']);
if ('related' == $settings['source'] && is_single() && 'portfolio' == get_post_type()) {
    $related_categories = get_the_terms(get_the_ID(), 'project-category');
    $related_cats = [];
    if ($related_categories) {
        foreach ($related_categories as $related_cat) {
            $related_cats[] = $related_cat->slug;
        }
    }
    $the_query = new \WP_Query(array(
        'posts_per_page' => $settings['posts_per_page'],
        'post_type' => 'project',
        'orderby' => $settings['orderby'],
        'order' => $settings['order'],
        'post__not_in' => array($current_post_id),
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'project-category',
                'operator' => 'IN',
                'field'    => 'slug',
                'terms'    => $related_cats,
            ),
        ),
    ));
} elseif ('meta' == $settings['source']) {
    $the_query = new \WP_Query(array(
        'posts_per_page' => $settings['posts_per_page'],
        'post_type' => 'project',
        'orderby' => $settings['orderby'],
        'order' => $settings['order'],
        'paged' => $paged,
        'post__in' => (0 != count($settings['manual_selection'])) ? $settings['manual_selection'] : array(),
        'project-tag' => (0 != count($settings['include_tags'])) ? $include_tags : '',
        'post__not_in' => array($current_post_id),
        'author' => (0 != count($settings['include_authors'])) ? $include_authors : '',
        'author__not_in' => (0 != count($settings['exclude_authors'])) ? $exclude_authors : '',
        'tax_query' => array(
            'relation' => 'AND',
            (0 != count($settings['exclude_tags'])) ? $exclude_tags : '',
            (0 != count($settings['exclude_categories'])) ? $exclude_categories : '',
            (0 != count($settings['include_categories'])) ? $include_categories : '',
        ),
        'meta_query' => array(
            array(
                'key' => 'portfolio_type',
                'value' => $settings['portfolio_type']
            )
        )
    ));
} else {
    $the_query = new \WP_Query(array(
        'posts_per_page' => $settings['posts_per_page'],
        'post_type' => 'project',
        'orderby' => $settings['orderby'],
        'order' => $settings['order'],
        'paged' => $paged,
        'post__in' => (0 != count($settings['manual_selection'])) ? $settings['manual_selection'] : array(),
        'project-tag' => (0 != count($settings['include_tags'])) ? $include_tags : '',
        'post__not_in' => array($current_post_id),
        'author' => (0 != count($settings['include_authors'])) ? $include_authors : '',
        'author__not_in' => (0 != count($settings['exclude_authors'])) ? $exclude_authors : '',
        'tax_query' => array(
            'relation' => 'AND',
            (0 != count($settings['exclude_tags'])) ? $exclude_tags : '',
            (0 != count($settings['exclude_categories'])) ? $exclude_categories : '',
            (0 != count($settings['include_categories'])) ? $include_categories : '',
        ),
    ));
}
