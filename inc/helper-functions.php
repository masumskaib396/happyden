<?php 
/**
 * Get Pages
 * 
 * @since 1.0
 * 
 * @return array
 */
if ( ! function_exists( 'happyden_get_all_pages' ) ) {
    function happyden_get_all_pages($posttype = 'page')
    {
        $args = array(
            'post_type' => $posttype, 
            'post_status' => 'publish', 
            'posts_per_page' => -1
        );

        $page_list = array();
        if( $data = get_posts($args)){
            foreach($data as $key){
                $page_list[$key->ID] = $key->post_title;
            }
        }
        return  $page_list;
    }
}
/**
 * Meta Output
 * 
 * @since 1.0
 * 
 * @return array
 */
if ( ! function_exists( 'happyden_get_meta' ) ) {
    function happyden_get_meta( $data ) {
        global $wp_embed;
        $content = $wp_embed->autoembed( $data );
        $content = $wp_embed->run_shortcode( $content );
        $content = do_shortcode( $content );
        $content = wpautop( $content );
        return $content;
    }
}

/**
 * Get a list of all CF7 forms
 *
 * @return array
 */
if ( ! function_exists( 'happyden_get_cf7_forms' ) ) {
    function happyden_get_cf7_forms() {
        $forms = get_posts( [
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        if ( ! empty( $forms ) ) {
            return wp_list_pluck( $forms, 'post_title', 'ID' );
        }
        return [];
    }
}
 /**
 * Check if contact form 7 is activated
 *
 * @return bool
 */
if ( ! function_exists( 'happyden_is_cf7_activated' ) ) {
   
    function happyden_is_cf7_activated() {
        return class_exists( 'WPCF7' );
    }
}

if ( ! function_exists( 'happyden_do_shortcode' ) ) {
    function happyden_do_shortcode( $tag, array $atts = array(), $content = null ) {
        global $shortcode_tags;
        if ( ! isset( $shortcode_tags[ $tag ] ) ) {
            return false;
        }
        return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
    }
}

/**
 * Add Font swap
 */
function happyden_start_modify_html() {
    ob_start();
 }
 function happyden_end_modify_html() {
    $html = ob_get_clean();
    $html = str_replace( 'font-display:swap;', '', $html );
    echo $html;
 }
 add_action( 'wp_head', 'happyden_start_modify_html' );
 add_action( 'wp_footer', 'happyden_end_modify_html' );

/**
 * Add Font Group
 */
add_filter('elementor/fonts/groups', function ($font_groups) {
    $font_groups['happyden_fonts'] = __('happyden Fonts');
    return $font_groups;
});

add_filter('elementor/fonts/additional_fonts', function ($additional_fonts) {
    $additional_fonts['Mazzard H'] = 'happyden_fonts';
    return $additional_fonts;
});


/**
 * Taxonomy Function 
 */
function happyden_cpt_taxonomy_slug_and_name($taxonomy_name, $option_tag = false)
{
    $taxonomyies = get_terms($taxonomy_name);
    if(true == $option_tag){
        $cpt_terms = '';
        foreach ($taxonomyies as $category) {
            if( isset( $category->slug ) && isset( $category->name ) ){
               $cpt_terms .= '<option value="'. esc_attr( $category->slug) .'">'.  $category->name .'</option>';
            }
        }
        return $cpt_terms;
    }
    $cpt_terms = [];
    foreach ($taxonomyies as $category) {
        if( isset( $category->slug ) && isset( $category->name ) ){
            $cpt_terms[$category->slug] = $category->name;
        }
    }
    return $cpt_terms;
}

/**
 * Custom Post Slug Function 
 */
function happyden_cpt_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => $post_type,
    ));
    $cpt_posts = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $cpt_posts[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_postdata();
    return $cpt_posts;
}

/**
 * Author Slug Function
 */
function happyden_cpt_author_slug_and_id($post_type)
{
    $the_query = new WP_Query(array(
        'posts_per_page' => -1,
        'post_type' => $post_type,
    ));
    $author_meta = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $author_meta[get_the_author_meta('ID')] = get_the_author_meta('display_name');
    endwhile;
    wp_reset_postdata();
    return array_unique($author_meta);
}

/**
 * Meta Keys Function
 */
function happyden_get_meta_field_keys($post_type, $field_name, $fild_type = "choices")
{
    $the_query = new WP_Query(array(
        'posts_per_page' => 1,
        'post_type' => $post_type,
    ));
    $field_object = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $field_object = get_field_object($field_name)[$fild_type];
    endwhile;
    return $field_object;
    wp_reset_postdata();
}

/**
 * LodeMore Function
 */
function happyden_loadmore_callback()
{
    // maybe it isn't the best way to declare global $post variable, but it is simple and works perfectly!
    $nonce = (isset($_POST['nonce'])) ? $_POST['nonce'] : '';
    if(check_ajax_referer( 'happyden_loadmore_callback', 'folio_nonce' )){
        $settings = (isset($_POST['portfolio_settings'])) ? $_POST['portfolio_settings']['settings'] : [];
        $paged = (isset($_POST['paged'])) ? $_POST['paged'] : '';
        include(__DIR__ . '/../widget/portfolio/queries/portfolio-query.php');
        include(__DIR__ . '/../widget/portfolio/contents/portfolio-content.php');
        wp_reset_postdata();
        wp_die( ' ' );
    }else{
        echo "something wrong";
        wp_die( ' ' );
    }
}
add_action('wp_ajax_happyden_loadmore_callback', 'happyden_loadmore_callback'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_happyden_loadmore_callback', 'happyden_loadmore_callback'); // wp_ajax_nopriv_{action}


//Catgory List
if ( ! function_exists( 'happyden_blog_post_catgory' ) ) :
	function happyden_blog_post_catgory(){
        $category = get_the_category();
        if ( $category[0] ) {
            echo '<span class="cat-links"><a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . esc_html($category[0]->cat_name) . '</a></span>';
        }
	}
endif;

/**
 * Post orderby list
 */
function finisys_get_post_orderby_options()
{
    $orderby = array(
        'ID' => 'Post ID',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );
    $orderby = apply_filters('finisys_post_orderby', $orderby);
    return $orderby;
}

/**
 * Get Posts
 * 
 * @since 1.0
 * 
 * @return array
 */
if ( ! function_exists( 'finisys_get_all_posts' ) ) {
    function finisys_get_all_posts($posttype)
    {
        $args = array(
            'post_type' => $posttype, 
            'post_status' => 'publish', 
            'posts_per_page' => -1
        );

        $post_list = array();
        if( $data = get_posts($args)){
            foreach($data as $key){
                $post_list[$key->ID] = $key->post_title;
            }
        }
        return  $post_list;
    }
}


/**
 * Get Author list
 * 
 * @since 1.0
 * 
 * @return array
 */
if ( ! function_exists( 'finisys_get_authors' ) ) 
{
    function finisys_get_authors()
    {
        $user_query = new \WP_User_Query(
            [
                'who' => 'authors',
                'has_published_posts' => true,
                'fields' => [
                    'ID',
                    'display_name',
                ],
            ]
        );
        $authors = [];
        foreach ($user_query->get_results() as $result) {
            $authors[$result->ID] = $result->display_name;
        }
        return $authors;
    }
}



function happyden_get_post_types()
	{
    $post_type_args = array(
        'public'            => true,
        'show_in_nav_menus' => true
    );

    $post_types = get_post_types($post_type_args, 'objects');
    $post_lists = array();
    foreach ($post_types as $post_type) {
        $post_lists[$post_type->name] = $post_type->labels->singular_name;
    }
    return $post_lists;
}


