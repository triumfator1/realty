<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">
        <div class="row">
            <form action="" method="POST" id="add_realty_form">
                <h3>Добавить объект</h3>
                <div class="form_row">
                    <label>Тип недвижимости
                        <select id='type' name='type'>
                            <?php
                            // Query the cities here
                            $terms = get_terms( array(
                                'taxonomy' => 'realty_type',
                                'hide_empty' => true,
                            ) );
                            foreach ( $terms as $term ) {
                                $selected = "";
                                echo '<option' . $selected . ' value=' . $term->slug . '>' . $term->name . '</option>';
                            } ?>
                        </select>
                    </label>
                </div>
                <div class="form_row">
                    <label>Название
                        <input type="text" name="realty_name" class="event_name required">
                    </label>
                </div>
                <div class="form_row">
                    <label>Площадь
                        <input type="text" name="square" class="event_name required">
                    </label>
                </div>
                <div class="form_row">
                    <label>Стоимотсь
                        <input type="text" name="price" class="event_name required">
                    </label>
                </div>
                <div class="form_row">
                    <label>Адресс
                        <input type="text" name="address" class="event_name required">
                    </label>
                </div>
                <div class="form_row">
                    <label>Жилая площадь
                        <input type="text" name="square_liv" class="event_name required">
                    </label>
                </div>
                <div class="form_row">
                    <label>Город
                        <select id='city' name='city'>
                            <?php
                        // Query the cities here
                        $query = new WP_Query( 'post_type=city' );
                        while ( $query->have_posts() ) {
                        $query->the_post();
                        $id = get_the_ID();
                        $selected = "";
                        echo '<option' . $selected . ' value=' . $id . '>' . get_the_title() . '</option>';
                        } ?>
                        </select>
                    </label>
                </div>
                <div class="form_row">
                    <label>Этаж
                        <input type="text" name="floor" class="event_name required">
                    </label>
                </div>
                <div class="form_row">
                    <label>Описание
                        <textarea type="text" name="description" class="event_name required" rows="4" cols="50"></textarea>
                    </label>
                </div>
                <button id="btnSubmit" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						<?php understrap_site_info(); ?>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->
	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

