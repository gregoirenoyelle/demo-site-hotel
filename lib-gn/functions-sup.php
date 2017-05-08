<?php
/**
 * Fonctions suplémentaires du thème
 *
 * @author Grégoire Noyelle
 * @package CHG Mont d'Or
 * @subpackage Customizations
 */


///////////////////////
// DEBUG
///////////////////////

// Affichage debug print_r
if (!function_exists('aff_p')) {
	function aff_p($v) {
		echo "<pre style='background:#fff'>";
		print_r($v);
		echo "</pre>";
	}
}

// Affichage debug var_dump
if (!function_exists('aff_v')) {
	function aff_v($v) {
		echo "<pre style='background:#fff'>";
		var_dump($v);
		echo "</pre>";
	}
}

// Affichage debug var_export
if (!function_exists('aff_ve')) {
	function aff_ve($v) {
		echo "<pre style='background:#fff'>";
		var_export($v);
		echo "</pre>";
	}
}


///////////////////////
// FUNCTIONS BASIQUES
///////////////////////

// style css tinyMCE
function chgor_editor_styles() {
	add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'chgor_editor_styles' );

//* gnaction Add background_color support
add_theme_support( 'custom-background' );


// footer changer Copyright test
add_filter('genesis_footer_creds_text', 'chgor_texte_copyright');
function chgor_texte_copyright($creds) {
$creds = "Copyright [footer_copyright]";
return $creds;
}


///////////////////////
// FORCER ACF SUR LE SITE
///////////////////////

//* Contrôle si Advanced Custom Field est actif sur le site
if ( ! function_exists( 'get_field' ) ) {

	// Notice dans le back-office au moment de la désactivation
	add_action('admin_notices','gn_warning_admin_missing_acf');
	function gn_warning_admin_missing_acf() {
	   $plugin_url = get_bloginfo('url') . '/wp-admin/plugins.php';

	   $output = '<div id="my-custom-warning" class="error fade">';
	   $output .= sprintf('<p><strong>Attention</strong>, ce site ne fonctionne pas sans l\'extension <strong>Advanced Custom Fields</strong>. Merci d\'activer cette <a href="%s">extension</a>.</p>', $plugin_url);
	   $output .= '</div>';
	   echo $output;
	 }

	// Notice dans le front qui masque tout le contenu et affiche le lien pour ce connecter
	add_action( 'template_redirect', 'gn_template_redirect_warning_missing_acf', 0 );
	function gn_template_redirect_warning_missing_acf() {
		wp_die( sprintf( 'Ce site ne fonctionne pas sans l\'extension <strong>Advanced Custom Fields</strong>. Merci de vous <a href="%s">connecter au site</a> pour l\'activer.', wp_login_url() ) );
	}

}


///////////////////////
// AJOUTS TEMPLATE
///////////////////////

//* Modification des template
add_action( 'genesis_meta', 'chgor_add_template_element' );
function chgor_add_template_element() {

	// Ajout Image une dans les pages
	if ( is_singular( array('page','post') ) ) {
		if ( !has_post_thumbnail() ) return;
		add_action( 'genesis_before_entry', 'chgor_post_thumbnail_page');
		function chgor_post_thumbnail_page() {
			the_post_thumbnail( 'large');
		}
	}
}








