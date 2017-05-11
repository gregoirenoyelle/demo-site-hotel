<?php
// Options des modèles
add_action('genesis_meta', 'grandl_options_modele');
function grandl_options_modele() {
	if ( ! is_single() ) {
		// Imposer la pleine largeur
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
		// Enlever le fil d'Ariane
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
		// pour enlever l'image à la une générée automatiquement
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );		
		// pour enlever le contenu de l'éditeur (contenu classique ou extrait)
		remove_action( 'genesis_entry_content', 'genesis_do_post_content' );		
	}
	
} // FIN function grandl_options_modele()

// Masquer des éléments de l'interface
/** Supprimer les post info */
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
/** Suprimer les post meta */
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


// Ajouter l'image de la fiche Equipe avant le titre
add_action('genesis_entry_header', 'grandl_image_equipe', 5);
function grandl_image_equipe() { 
// Variables Image
$image_id = get_field('equipe_photo');
$img = wp_get_attachment_image($image_id, 'equipe');
// Lien vers le contenu
$lien_equipe  = get_permalink();
?>

	<figure class="visuel">
		<?php 

		if ( is_singular('equipe') ) {
			echo $img;
		} else {
			printf('<a href="%s">%s</a>', $lien_equipe, $img);
		}
		
		?>


	</figure>

<?php } // FIN function grandl_image_equipe()

// Ajouter le contenu de la fiche Equipe
add_action('genesis_entry_content','grandl_fiche_equipe');
function grandl_fiche_equipe() { 
// Lien vers le contenu
$lien_equipe  = get_permalink();
?>
	<section class="fiche-cuisinier">
		<a href="mailto:<?php the_field('equipe_email'); ?>">Envoyer un message</a><br>		

		<?php 

		if ( is_singular('equipe') ) {
			printf('<p>%s</p>', the_field('equipe_biographie_longue'));
		} else {
			the_field('equipe_biographie_courte');
			printf('<br><a href="%s">Voir la bio complète</a>', $lien_equipe);
		}			
		?>

	</section>

<?php } // FIN function grandl_fiche_equipe()