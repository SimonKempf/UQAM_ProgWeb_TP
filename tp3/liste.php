<?php
function ouvrage(){
	// Lire les lignes du fichier biblio.txt,
	// appliquer "rtrim" sur chaque ligne et les regrouper par ensembles de 11 lignes.
	if (file_exists('biblio.txt')){
		$ouvrages = array_chunk(array_map('rtrim', file('./biblio.txt')), 11);
		// trier les ouvrages en ordre croissant de nom.
		usort($ouvrages, function ($a, $b) { return $a[1] <=> $b[1]; });
	}
	return json_encode($ouvrages);
}
if($_SERVER["REQUEST_METHOD"] == 'GET'){
	echo ouvrage();
} 
?>