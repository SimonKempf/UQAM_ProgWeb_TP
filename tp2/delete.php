<?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $bibli = file('./biblio.txt');
      //Lit le fichier et renvoie le résultat dans un tableau
      foreach ($bibli as $key => $value) {
        $v = trim($value);
        if ($v == $id) {
          for ($i=$key; $i <= $key+10; $i++) {  //parcourt les lignes à supprimer qui suivent la ligne de l'id
            unset($bibli[$i]);     
          }
          break; // pour éviter de parcourir le reste de $bibli si l'id a déjà été trouvée
        }
      }
      file_put_contents('./biblio.txt', ''); // écrase le contenu du fichier
      foreach ($bibli as $key => $value) {
        file_put_contents('./biblio.txt', $value , FILE_APPEND); // réécriture du tableau $bibli dans le fichier biblio.txt sans les lignes qui ont été supprimées 
      }
    header("Location: index.php");
    exit;
?>