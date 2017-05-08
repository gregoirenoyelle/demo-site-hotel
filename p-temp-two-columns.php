<?php
/**
 * This for the 2 columns template
 *
 * @author Grégoire Noyelle
 * @package Site Hotel
 * @subpackage Customizations
 */

// Template Name: Page sur 2 colonnes

add_action( 'genesis_meta', 'site_hostel_two_columns_template' );
function site_hostel_two_columns_template() {
	// Force content-sidebar layout setting
	add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

	// add ACF content
	add_action( 'genesis_entry_content', 'site_hotel_content_repeater_2_colomn', 15 );
}

// Add ACF fields
function site_hotel_content_repeater_2_colomn() {

	$page_1 = get_field('page_1');
	$page_2 = get_field('page_2');
	// aff_p($page_1->ID);

	$boucle_1 = new WP_Query(array(
		'post_type' => 'page',
		'page_id' => $page_1->ID

	));

	while( $boucle_1->have_posts() ) : $boucle_1->the_post(); ?>
		<article <?php post_class( 'page-two-column' ); ?>>
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail('image-une-page');
			}
			?>
			<h2><?php the_title(); ?></h2>
			<section class="content-page">
				<?php the_content(); ?>
			</section>
		</article>

	<?php endwhile;
	wp_reset_postdata();


	$boucle_1 = new WP_Query(array(
		'post_type' => 'page',
		'page_id' => $page_2->ID

	));

	while( $boucle_1->have_posts() ) : $boucle_1->the_post(); ?>
		<article <?php post_class( 'page-two-column' ); ?>>
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail('image-une-page');
			}
			?>
			<h2><?php the_title(); ?></h2>
			<section class="content-page">
				<?php the_content(); ?>
			</section>
		</article>

	<?php endwhile;
	wp_reset_postdata();




} // END function ghgor_content_repeater_2_colomn()

genesis();