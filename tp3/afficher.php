 <?php
if( $_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id']) ){ 
    $id = $_GET['id'];
    echo get_ouvrage($id);
}
// chercher un ouvrage selon un id
function get_ouvrage($id){
	$ouvrages = array_chunk(array_map('rtrim', file('./biblio.txt')), 11); //lit le fichier et renvoie le résultat dans un tableau
    foreach ($ouvrages as $ouvrage) {
    	if ($id == $ouvrage[0]) {
    		return json_encode($ouvrage);
    	}
    }
}
?>
