
<?php 
  $ident="";
  $name="";
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
    if(isset($_POST['name'])) { 
      $name = test_input($_POST['name']);
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
    if(isset($_POST['description'])) { 
      $description = test_input($_POST['description']);
    }
    // Verifier si les champs obligatoires sont bien remplis
    if(!empty($ident) && !empty($name) && !empty($aut) && !empty($maison) && !empty($siteWeb) && !empty($type)){
        //verification
    }else{
      $erreur = "Vous n'avez pas complété toutes les informations concernées par le symbole : *";
      $valide = false;
    }
    //verifier que l'ID de la nouvelle oeuvre n'existe pas déjà parmi les autres oeuvres
    $id = file('./biblio.txt');
    foreach ($id as $key) {
      if (trim($key) == $ident) { // trim permet d'avoir la clef sans les caractères inutiles d'espaces ou autres
        $valideId = false;
        $erreurId = "L'Identifiant que vous avez rentré existe déjà";
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
      'n' => $_POST['name'],
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
    // rediriger le fureteur à la liste de contacts
    header("Location: index.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'/>
    <title>Ajouter une oeuvre</title>
    <style type="text/css">
      .erreur {
        color: red;
        font-weight: bold;  
      }
    </style>
  </head>
  <body class="ui container" style="padding-top:2rem">
    <h1 class="ui header">Ajouter une nouvelle oeuvre</h1>
    <p class="erreur" > <?php echo $erreur ?> </p>
    <form method="POST" action"/">
      <fieldset>
        <legend> Contact </legend>
        <table>
          <tr>
            <th>Identifiant*</th>
            <td><input name = "ident" value = "<?php echo $ident; ?>"></td>
            <p class="erreur"> <?php echo $erreurId ?> </p>
          </tr>
          <tr>
            <th>Nom*</th>
            <td><input name = "name" value = "<?php echo $name; ?>"></td>
          </tr>
          <tr>
            <th>Auteur(s)*</th>
            <td><input name = "aut" value = "<?php echo $aut; ?>"></td>
          </tr>
          <tr>
            <th>Année Publication</th>  <!-- OPTIONNELLE -->
            <td><input name = "year" value = "<?php echo $year; ?>"></td> 
          </tr>
          <tr>
            <th>Maison d'édition*</th>
            <td><input name = "maison" value = "<?php echo $maison; ?>"></td>
          </tr>
          <tr>
            <th>Edition</th> <!-- OPTIONNELLE -->
            <td><input name = "ed" value = "<?php echo $ed; ?>"></td> 
          </tr>
          <tr>
            <th>Site web*</th>
            <td><input name = "siteWeb" value = "<?php echo $siteWeb; ?>"></td>
          </tr>
          <tr>
            <th>Image</th> <!-- OPTIONNELLE -->
            <td><input name = "image" value = "<?php echo $image; ?>"></td>
          </tr>
          <tr>
            <th>Type*</th>
            <td><select id="select" name="type">
                  <option value = "L"  <?= $type=="L" ? "selected": "" ?> >Livre</option> 
                  <option value = "A" <?= $type=="A" ? "selected": "" ?> >Article</option>
                  <option value = "P" <?= $type=="P" ? "selected": "" ?>>Publication Scientifique</option>
                  <option value = "X" <?= $type=="X" ? "selected": "" ?>>Autres</option>
                </select>
            </td> 
          </tr>
          <tr>
            <th>Description si Autre</th>
            <td>
              <TEXTAREA name="description" value ="<?php echo $description; ?>" rows=3 cols=40></TEXTAREA>
          </tr>
        </table>
        <p style="font-size:10px;">* : champs obligatoires</p>
      </fieldset>
      <button>AJOUTER</button>
    </form>
  </body>
</html>