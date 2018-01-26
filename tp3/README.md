TP no 3 - Réalisation d'une application Ajax
Vous devez réaliser une application de type Ajax.

Comme dans le TP2, l'application permettra d'afficher la liste de tous les ouvrages et d'ajouter un ouvrage. La suppression n'est pas demandée.

Contrairement au TP2, l'application doit entièrement être réalisée en JavaScript.

Votre code PHP doit utiliser le même format de fichier biblio.txt.

Description des fichiers à fournir :

-- index.html

Le fichier index.html est présenté ici. Il ne s'agit pas d'un fichier php.

Le fichier doit contenir

<!DOCTYPE html>
<html>
  <head>
    <title>TP3</title>
  </head>
  <body>
    <h1>Ouvrages</h1>
    <ul id="liste-ouvrages"></ul>
    <form id="formulaire-ajout">
      <!-- complétez le formulaire -->
    </form>
    <script type="text/javascript" src="application.js"></script>
  </body>
</html>

-- liste.php

Lorsqu'une requête de type GET est reçue par ce fichier php, la liste des ouvrages doit être renvoyée au format JSON. Vous devrez utiliser la fonction php json_encode pour transformer un array php en array JSON.

Dans votre code JavaScript, la méthode fetch pour obtenir la liste ressemblera à ceci:

fetch('liste.php')
  .then(function(r) { return r.json() })
  .then(function(ouvrages) {
    // Utiliser la liste d'ouvrages ici.
  })

-- creer.php

Lorsqu'une requête de type POST est reçue par ce fichier php, le fichier php doit lire le contenu de la requête (avec $_POST) et ajouter le nouvel ouvrage dans la base de données.

Dans votre code JavaScript, la méthode fetch pour envoyer le contenu du formulaire ressemblera à ceci:

const form = document.getElementById("monFormulaire") // ou autre sélecteur
fetch('creer.php', { method: 'POST', body: new FormData(form) })
  .then(function (response) {
    if (response.ok) {
      // L'ouvrage a été ajouté.
    } else {
      // Une erreur s'est produite.
    }
  })

-- afficher.php

Lorsqu'une requête de type GET est reçue par ce fichier php, le fichier php doit lire le contenu de la requête (avec $_GET) et retourner au format JSON l'ouvrage dont l'identifiant a été spécifié dans l'url.

Dans votre code JavaScript, la méthode fetch pour envoyer la requête ressemblera à ceci:

fetch("afficher.php?id=" + id)
  .then(function (r) { return r.json() })
  .then(function (ouvrage) {
    // Utiliser l'ouvrage ici.
  })

-- application.js

Suit le comportement de l'application javascript:

Au chargement de la page index.html, l'application JavaScript doit aller chercher la liste d'ouvrages (fetch('/liste.php')) et utiliser le contenu json reçu pour peupler le contenu de la balise liste-ouvrages.
Chaque ouvrage ajouté doit être dans une balise <li>. L'item doit contenir seulement un lien avec le titre de l'ouvrage (<a href="afficher.php?id=____">).
Lorsque l'utilisateur clique sur un de ces liens, l'application JavaScript doit intercepter le clic, faire un ajax pour obtenir l'information de l'ouvrage (fetch('/afficher.php?id='+____)) puis afficher les détails reçus dans les champs du formulaire.
Lorsque l'utilisateur rempli et envoi le formulaire, les champs obligatoires (voir TP1 et TP2) doivent être validés. Si un ou plusieurs champs est invalide, les champs invalides doivent clairement être affichés en erreur (p.e. avec une bordure rouge). Si tous les champs sont valides, l'application doit faire un appel ajax pour créer l'ouvrage fetch('/creer.php', { ... }).
Si l'ajout est un succès, la liste d'ouvrages doit être mise à jour dynamiquement grâce à un appel ajax.
La boite de sélection pour le type d'ouvrage et le champ 'Type Autre' doivent être liés et validés correctement. Si le type est 'Autre', le champ 'Description Autre' doit être obligatoire. Autrement, si le type n'est pas 'Autre', le champ de description doit être désactivé et ne doit pas se faire valider.


Pondération
Respect des exigences: 75%
Qualité du code source (indentation, identifiants, documentation et commentaires): 25%

Remise
La remise sera faite par Slack dans un message direct m'étant adressé. Le projet doit être remis dans un fichier zip contenant vos 5 fichiers: index.html, application.js, liste.php, afficher.php et creer.php
Vous ne pouvez faire qu'une seule remise. Toute remise subséquente sera ignorée.
Le nom du fichier zip doit être composé du code permanent des membres de l'équipe séparés par un souligné p.e. "ABCD12341234_DEFG56785678.zip". Des points seront retirés si ceci n'est pas respecté.
