<?php
// Template Name: Page Builder

// Maquette Pleine largeur
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Supprimer le fil d'Ariane
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');

// condition sur le modèle
add_action('genesis_meta', 'site_hotel_filtrer_contenu');
function site_hotel_filtrer_contenu() {

	// Variable ACF (Vrai/Faux)
	$masquer_titre = get_field('builder_masquer_titre');
	$masquer_menu = get_field('builder_masquer_menu_principal');

	// aff_v($masquer_titre);

	// Pour masquer le titre
	if ( $masquer_titre ) {
		// Pour enlever toutes les fonctions sur le hook genesis_entry_header
		remove_all_actions( 'genesis_entry_header');
		// pour enlever juste le titre
		// remove_action('genesis_entry_header', 'genesis_do_post_title');
	}

	// Pour masquer le menu
	if ( $masquer_menu ) {
		// Remove main navigation
		remove_action( 'genesis_after_header', 'genesis_do_nav' );
	}

} // FIN function site_hotel_filtrer_contenu()

genesis();