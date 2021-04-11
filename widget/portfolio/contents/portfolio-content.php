<?php
if (!defined('ABSPATH')) {
    exit;
}
while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <?php
    $idd = get_the_ID();
    $categories = get_the_terms($idd, 'project-category');
    $grid = '';
    $image_height = ' height-' . get_post_meta($idd, 'image_height', true);
    $pf_cat_slug = '';
    $pf_cat_name = '';
    if (!empty($categories)) {
        $pf_cat_name = join(' ', wp_list_pluck($categories, 'name'));
        $pf_cat_slug = join(' ', wp_list_pluck($categories, 'slug'));
    }
    if ('yes' == $settings['use_meta_grid']) {
        $grid =  'col-md-' . get_post_meta($idd, 'image_width', true);
    } else {
        $grid = $column_class;
    }
    ?>
    <div id="post-<?php the_ID(); ?>" class="<?php printf('happyden-portfolio-item-wrap %s %s %s' , $grid  , $pf_cat_slug , $image_height); ?>">
        <div class="happyden-portfolio-item">
            <a href="<?php echo get_the_permalink() ?>" class="happyden-portfolio-image d-block <?php echo esc_attr( 'elementor-animation-'.$settings['image_hover_animation'] ) ?>">
                <?php the_post_thumbnail() ?>
            </a>
            <a href="<?php echo get_the_permalink() ?>" class="happyden-portfolio-content content-postion-<?php echo $settings['content_position'] . " text-" . $settings['content_align'] ?>">
               
                <h3 class="happyden-portfolio-title">
                    <?php echo get_the_title() ?>
                </h3>
                
                <div class="happyden-portfolio-bottom">

                   <?php
                    $show_excerpt = $settings['show_excerpt'];
                    $excerpt_leanth = $settings['excerpt_leanth'];
                    $show_excerpt_icon = $settings['show_excerpt_icon'];
                   ?>
                    <?php if('yes' == $show_excerpt): ?>
                        <div class="happyden-portfolio-excerpt">
                            <?php
                                $excerpt = get_the_excerpt();
                                $excerpt_content = substr( $excerpt, 0, $excerpt_leanth );
                            ?>
                            <p><?php echo $excerpt_content?></p>
                        </div>
                    <?php endif; ?>
                    
                    <?php if('yes' == $settings['show_title_icon'] && $settings['title_icon'] ): ?>
                        <div class="title-icon">
                        <?php  Elementor\Icons_Manager::render_icon($settings['title_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    <?php endif; ?>


                </div>
                
            </a>
        </div>
    </div><!-- #post-<?php the_ID(); ?> -->
<?php
endwhile;
?>