<?php

// Options des modèles
add_action('genesis_meta', 'grandl_options_modele');
function grandl_options_modele() {
	if ( ! is_single() ) {
		// Imposer la pleine largeur
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
		// pour enlever l'image à la une générée automatiquement
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );		
		// pour enlever le contenu de l'éditeur (contenu classique ou extrait)
		remove_action( 'genesis_entry_content', 'genesis_do_post_content' );		
	}
	
}

// Masquer des éléments de l'interface
/** Supprimer les post info */
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
/** Suprimer les post meta */
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


// Ajouter le contenu de la fiche Equipe
add_action('genesis_entry_content','grandl_fiche_equipe');
function grandl_fiche_equipe() {
	echo '<p>contenu équipe</p>';
}