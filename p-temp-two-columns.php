<?php
/**
 * This for the 2 columns template
 *
 * @author Grégoire Noyelle
 * @package CHG Mont d'Or
 * @subpackage Customizations
 */

// Template Name: Page sur 2 colonnes

add_action( 'genesis_meta', 'chgor_two_columns_template' );
function chgor_two_columns_template() {
	// Force content-sidebar layout setting
	add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

	// add ACF content
	add_action( 'genesis_entry_content', 'ghgor_content_repeater_2_colomn', 15 );
}

// Add ACF fields
function ghgor_content_repeater_2_colomn() {

	// START check if ACF is actif
	if ( !function_exists('get_field') ) :
		$url = get_bloginfo( 'url');
		echo "<p><strong>Notice: Merci d'activer l'extension <a href='{$url}/wp-admin/plugins.php'>Advanced Custom Fields Pro</a></strong></p>";
		return;
	endif;
	// END check if ACF is actif

	// START ACF REPEATER
	if ( have_rows('chg_bloc_contenu') ) :
		while ( have_rows('chg_bloc_contenu') ) : the_row();

			$page = array();
			$left_page = get_sub_field('chg_left_col');
			$right_page = get_sub_field('chg_right_col');
			array_push($page, $left_page, $right_page );

			// start loop
			foreach($page as $page_id) :
				$query = new WP_Query(array('page_id' => $page_id));
				while ( $query->have_posts() ) : $query->the_post(); ?>
					<article <?php post_class('page-two-column');?>>
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('image-une-page'); ?>
							</a>
						<?php } ?>
						<header class="entry-header">
							<h3 class="entry-title-two-column"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</header>
						<div class="entry-content entry-two-column">
							<?php the_content(); ?>
						</div>
					</article>
				<?php
				endwhile;
				wp_reset_postdata();
			endforeach;

		endwhile;
	else :
		echo "Merci d'intégrer des rang dans votre page";
	endif;
	// END ACF REPEATER

} // END function ghgor_content_repeater_2_colomn()

genesis();