<?php
get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>
    <div class="row">
        <?php
        global $post;
        $args = array(
        'post_type' => 'city',
        );
        $cities = get_posts($args);
        foreach( $cities as $post ){
            setup_postdata( $post );?>
                <div class="col text-center">
                    <?php if(has_post_thumbnail()): ?>
                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium'); ?></a>
                    <?php endif; ?>
                    <div><?php the_title(); ?></div>
                </div>
        <?php }
        wp_reset_postdata();
        ?>
    </div>
    <div class="wrapper" id="index-wrapper">

        <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

            <div class="row">
                <main class="site-main" id="main">
                    <div class="row">
                    <?php
                    $args = array(
                    'post_type' => 'realty',
                    'paged' => ( get_query_var('page') ? get_query_var('page') : 1),
                    );
                    $q = new WP_Query($args);
                    if ( $q->have_posts() ) {
                        // Start the Loop.
                        while ( $q->have_posts() ) {
                            $q->the_post();

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            ?>
                        <div class="col-xs col-md-4 col-lg-4" style="margin-bottom: 10px;">
                            <div>
                                <a href="<?php the_permalink() ?>"><?php the_title()?></a>
                            </div>
                            <div><?php the_post_thumbnail();?></div>
                            <div>
                                Площадь: <?php echo get_field('площадь') ?>
                            </div>
                            <div>
                                Стоимость: <?php echo get_field('стоимость') ?>
                            </div>
                            <div>
                                Адрес: <?php echo get_field('адрес') ?>
                            </div>
                            <div>
                                Жилая площадь: <?php echo get_field('жилая_площадь') ?>
                            </div>
                            <div>
                                Этаж: <?php echo get_field('этаж') ?>
                            </div>
                        </div>
                        <?php }
                        wp_reset_postdata();
                    } else {
                        get_template_part( 'loop-templates/content', 'none' );
                    }
                    ?>
                    </div>
                </main><!-- #main -->

                <!-- The pagination component -->
                <?php
                $big = 999999999; // need an unlikely integer

                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'prev_text'          => __(' Previous'),
                    'next_text'          => __('Next '),
                    'current' => max( 1, get_query_var('page') ),
                    'total' => $q->max_num_pages
                ) );
                ?>

            </div><!-- .row -->

        </div><!-- #content -->

    </div><!-- #index-wrapper -->

<?php
get_footer();
