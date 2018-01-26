<?php 
  $ident="";
  $titre="";
  $aut="";
  $year="";
  $maison="";
  $ed="";
  $siteWeb="";
  $image="";
  $type="";
  $description="";
  $erreur="";
  $valide=true;
  $valideId = true;
  $erreurId = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['ident'])) { // est-ce que la variable est setée / existe
      $ident = test_input($_POST['ident']);
    }
    if(isset($_POST['titre'])) { 
      $titre = test_input($_POST['titre']);
    }
    if(isset($_POST['aut'])) { 
      $aut = test_input($_POST['aut']);
    }
    if(isset($_POST['year'])) { 
      $year = test_input($_POST['year']);
    }
    if(isset($_POST['maison'])) { 
      $maison = test_input($_POST['maison']);
    }
    if(isset($_POST['ed'])) { 
      $ed = test_input($_POST['ed']);
    }
    if(isset($_POST['siteWeb'])) { 
      $siteWeb = test_input($_POST['siteWeb']);
    }
    if(isset($_POST['image'])) { 
      $image = test_input($_POST['image']);
    }
    if(isset($_POST['type'])) { 
      $type = test_input($_POST['type']);
    }
    if(isset($_POST['description_1'])) { 
      $description = test_input($_POST['description']);
    }
    // Verifier si les champs obligatoires sont bien remplis
    if(!empty($ident) && !empty($titre) && !empty($aut) && !empty($maison) && !empty($siteWeb) && !empty($type)){
        //verification
    }else{
      $valide = false;
    }

    //verifier que l'ID de la nouvelle oeuvre n'existe pas déjà parmi les autres oeuvres
    $id = file('./biblio.txt');
    foreach ($id as $key) {
      if (trim($key) == $ident) { // trim permet d'avoir la clef sans les caractères inutiles d'espaces ou autres
        $valideId = false;
      }
    }
  }
  // raffiner les textes rentrées par le user 
  function test_input($txt){
    $txt = trim($txt);
    $txt = stripslashes($txt);
    $txt = htmlspecialchars($txt);
  return $txt;
  }
  //récupérer la derniere ligne du fichier rentré en parametre
  function lireDerniereLigne ($file) {
    $fp = fopen($file, "r" );
    $pos = -1;
    $t = " ";
    while ($t != "\n" ) {
      if (!fseek($fp, $pos, SEEK_END)) { //  fseek retourne 0 si succes, et -1 si pas de succes dans la recherche 
        $t = fgetc($fp);
        $pos = $pos - 1;
      } else { 
        rewind($fp);
        break; 
      } 
    }
    $t = fgets($fp);
    fclose($fp);
    return $t;
  }

  $der = lireDerniereLigne('./biblio.txt');

  if( $_SERVER['REQUEST_METHOD'] == "POST" && $valide && $valideId){
    // récupérer les données du formulaire dans un tableau
    $new_oeuvre = [
      'i' => $_POST['ident'],
      'n' => $_POST['titre'],
      'a' => $_POST['aut'],
      'y' => $_POST['year'],
      'm' => $_POST['maison'],
      'e' => $_POST['ed'],
      'sw' => $_POST['siteWeb'],
      'im' => $_POST['image'],
      't' => $_POST['type'],
      'd' => $_POST['description']
    ];
    // ecrire ligne par ligne dans le fichier biblio.txt les valeur du tableau new_oeuvre
    $content = file('./biblio.txt');
    // si la derniere ligne est egale a "* * *" alors on saute une ligne pour ecrire a la suite du fichier
    if ($der == "* * *") {
        file_put_contents('./biblio.txt', "\n" , FILE_APPEND);
    }
    foreach ($new_oeuvre as $key => $value) {
      file_put_contents('./biblio.txt', $value . "\n" , FILE_APPEND);
    }
      file_put_contents('./biblio.txt', "* * *"  , FILE_APPEND);
  } else {
  	http_response_code(400);
  }
?>