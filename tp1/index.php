<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title> first TP1 </title>
	</head>
	<body>
		<h1> -- TP1 -- </h1>
		<h2>Table des matières : </h2>
		<?php
			$lignes = file('./biblio.txt');
			$c=0;
			$tmp = [];
			$tab = [];
			echo "<ul>";
			foreach ($lignes as $ligne) {
				$c++;
				// prendre l'identifiant pour faire un lien intern dans la table des matieres
				if ($c % 9 == 1) {
					$identifiant = trim($ligne);
				}
				// prendre le nom pour l'afficher dans la table des matieres
				elseif ($c % 9 == 2) {
				// ici la ligne corespond au nom
				$tab["nom"] = trim($ligne);
				$tab["id"] = $identifiant;
				array_push($tmp, $tab); //permet de mettre les valeurs du tableau tab dans le tableay tmp
				sort ($tmp); //permet de trier par odrdre alphabetique les noms des ouvree dans le tableau tmp 
				//affiche les oeuvres en fonction de l'ordre de ces derniers dans biblio.txt
				// echo "<li>";
				// echo "<p> <a href=#" . $identifiant . ">" . $ligne .  "</a> </p>";	
				// echo "</li>";		
				}	
			}
			//affiche les oeuvre dans l'ordre alphabetique
			foreach ($tmp as $k => $v) {
				echo "<li>";
				echo "<p> <a href=#" . $v["id"] . ">" . $v["nom"] . "</a> </p>";	
				echo "</li>";	
			}
			echo "</ul>";

			
			// foreach ($noms as $n => $i) {
			// 	echo "<ul> <li>";
			// 	echo "<p> <a href=#" . $i . ">" . $n .  "</a> </p>";	
			// 	echo "</ul> </li>";
			// }
		?>
		<hr>
		<?php
			$count = 0;
			foreach ($lignes as $ligne) {
				$count+=1; // count s'incrémente de lignes en lignes et va permettre de selectionner celles souhaitées
				echo "<br>";
				if($count % 9 == 1){
					$triml = trim($ligne); //permet d'avoir l'identifiant sans le retour à la ligne et ainsi faire le lien avec la table des matieres
					echo "<strong id='{$triml}'>Identifiant : </strong>" . $ligne;
				}
				elseif($count % 9 == 2){
					$name = trim($ligne);
					echo "<strong>Titre : </strong>" . $ligne;
				}
				elseif($count % 9 == 3){
					$auteur = trim($ligne);
					echo "<strong>Auteur(s) : </strong>" . $ligne;
				}
				elseif($count % 9 == 4 && $ligne !== "\n"){
					$year = trim($ligne);
					echo "<strong>Année de publication : </strong>" . $year;
				}
				elseif($count % 9 == 5){
					$maison = trim($ligne);
					echo "<strong>Maison d'édition : </strong>" . $maison;
				}
				elseif($count % 9 == 6 && $ligne !== "\n"){ 
					$ed = trim($ligne);
					echo "<strong>Edition : </strong>" . $ed;
				}
				elseif($count % 9 == 7){ 
					$url = trim($ligne);
					echo "<a href=" . $url ."> Site web de l'ouvrage </a>";
				}
				elseif($count % 9 == 8 && $ligne !== "\n"){
					$im = trim($ligne);
					echo "<img src=" . $im . " alt='" . $name ." ecrit par " . $auteur .  "'/>";
				}
				elseif($count % 9 == 0) {
					echo "<hr>";
				}
			}
		?>
	</body>
</html>