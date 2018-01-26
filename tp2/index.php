<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title> TP2 - CRUD </title>
	</head>
	<body>
		<h1> -- TP2 -- </h1>
		<h2>Table des matières : </h2>
		<?php
			$lignes = file('./biblio.txt');
			$c=0;
			$tmp = [];
			$tab = [];
			echo "<ul>";
			foreach ($lignes as $ligne) {
				$c++;
				// prendre l'identifiant pour faire un lien interne dans la table des matieres
				if ($c % 11 == 1) {
					$identifiant = trim($ligne);
				}
				// prendre le nom pour l'afficher dans la table des matieres
				elseif ($c % 11 == 2) {
					// ici la ligne corespond au nom
					$tab["nom"] = trim($ligne);
					$tab["id"] = $identifiant;
					array_push($tmp, $tab); //permet de mettre les valeurs du tableau tab dans le tableau tmp		
				}	
			}
			sort ($tmp); //permet de trier par ordre alphabetique les noms des ouvres dans le tableau tmp
			//affiche les oeuvres dans l'ordre alphabetique
			foreach ($tmp as $k => $v) {
				echo "<li>";
				echo "<p> <a href=#" . $v["id"] . ">" . $v["nom"] . "</a>" . " ". "<a class=item href=delete.php?id=" . $v["id"] . ">" . "Supprimer" . "</a> </p>";
				echo "</li>";	
			}
			echo "</ul>";
		
			echo "<a href='new.php'>Ajouter une nouvelle oeuvre</a>";
			echo "<hr>";
		
			$count = 0;
			foreach ($lignes as $ligne) {
				$count+=1; //count s'incrémente de lignes en lignes et va permettre de selectionner celles souhaitées
				echo "<br>";
				if($count % 11 == 1){
					$triml = trim($ligne); //permet d'avoir l'identifiant sans le retour à la ligne et ainsi faire le lien avec la table des matieres
					echo "<strong id='{$triml}'>Identifiant : </strong>" . $ligne;
				}
				elseif($count % 11 == 2){
					$name = trim($ligne);
					echo "<strong>Titre : </strong>" . $ligne;
				}
				elseif($count % 11 == 3){
					$auteur = trim($ligne);
					echo "<strong>Auteur(s) : </strong>" . $ligne;
				}
				elseif($count % 11 == 4 && $ligne !== "\n"){  // l'annee de publication est optionnelle donc, on l'affiche seulement s'il n'y pas de retour a la ligne : !== "\n"
				$year = trim($ligne);
				echo "<strong>Année de publication : </strong>" . $year;
				}
				elseif($count % 11 == 5){
					$maison = trim($ligne);
					echo "<strong>Maison d'édition : </strong>" . $maison;
				}
				elseif($count % 11 == 6 && $ligne !== "\n"){ 
					$ed = trim($ligne);
					echo "<strong>Edition : </strong>" . $ed;
				}
				elseif($count % 11 == 7){ 
					$url = trim($ligne);
					echo "<a href=" . $url .">Source</a>";
				}
				elseif($count % 11 == 8 && $ligne !== "\n"){
					$im = trim($ligne);
					echo "<img src=" . $im . " alt='" . $name ." ecrit par " . $auteur .  "' ". "width=10%; height=10%/>";
				}
				// Ajout des lignes qui permettent d'avoir le type de l'ouvrage et une description si le type de l'ouvrage est X
				// On ajoute donc 2 lignes et on passe ainsi à 11 lignes
				elseif($count % 11 == 9){
					$type = trim($ligne);
					echo "<strong>Type : </strong>";
						if ($type == 'L') {	
							echo "Livre";
						}
						elseif ($type == 'A') {
							echo "Article";
						}
						elseif ($type == 'P') {
							echo "Publication Scientifique";
						}
						elseif ($type == 'X') {
							echo "Autre";
						}
					}
				elseif($count % 11 == 10 && $type = 'X' && $ligne !== "\n") {
					$desc = trim($ligne);
					echo "<strong>Description : </strong>";
					echo $desc;
				}
				elseif($count % 11 == 0) {
					echo "<hr>";
				}
			}
		?>
	</body>
</html>