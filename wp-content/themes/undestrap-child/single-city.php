<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
global $wp_query;
$area_id = $wp_query->get_queried_object_id();
$args = array(
    'post_type' => 'realty',
    'meta_query' => array(
        array(
            'key' => 'city',
            'value' => $area_id,
            'compare' => '=',
            'type' => 'NUMERIC'
        )
    )
);
query_posts( $args );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
<!--			--><?php //get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'loop-templates/content', 'single' );
				}
				?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
<!--			--><?php //get_template_part( 'global-templates/right-sidebar-check' ); ?>

            <?php understrap_pagination() ?>
		</div><!-- .row -->

	</div><!-- #content -->
</div><!-- #single-wrapper -->

<?php
get_footer();
