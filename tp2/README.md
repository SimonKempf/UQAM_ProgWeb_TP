TP no 2 - Conception d'une application CRUD
Vous devez construire une application de type Create-Read-Update-Delete. L'application sera basée sur le TP1.

Fichier de données
Deux modifications sont apportées au fichier biblio.txt:

Chaque ouvrage doit avoir un type qui lui est associé. Les types sont:
L: Livre
A: Article
P: Publication scientifique
X: Autre
Si le type d'ouvrage est X (Autre), une description du type peut être donnée.
Voici un exemple de la seconde version du fichier biblio.txt. Vous devez respecter le format du fichier. La correction sera faite avec un fichier biblio.txt différent.

Lecture (Read) :

La page index.php doit afficher la liste de tous les ouvrages;
Vous pouvez utiliser le code produit dans le TP1;
En plus des autres informations, les deux nouvelles informations (type et description de type) doivent apparaître dans la liste d'ouvrages;
Pour chaque ouvrage, un lien "Supprimer" vers la page delete.php?id=___ doit être ajouté. La valeur du paramètre id doit correspondre à la valeur de l'identifiant unique de l'ouvrage;
Dans le bas de liste d'ouvrages, un lien "Ajouter un nouvel ouvrage" vers la page new.php doit être ajouté.

Ajout (Create) :

Lors d'un GET à la page new.php, la page doit afficher un formulaire permettant de saisir toutes les informations (autant obligatoires que optionnelles) d'un ouvrage;
Le type d'ouvrage doit être sélectionné dans un élément <select></select>. L'attribut value des éléments <option> doit correspondre au code de types d'ouvrage soit : L, A, P et X;
Le formulaire doit être envoyé au serveur avec un POST à la page new.php;
Lors d'un POST à la page new.php, le code doit valider que les informations obligatoires sont présentes et que l'identifiant unique n'existe pas déjà dans le fichier biblio.txt;
Lors d'un POST, si des erreurs de validation sont détectées, le formulaire doit être affiché de nouveau avec les messages d'erreur appropriés. Les <input> doivent contenir les valeurs saisies par l'utilisateur;
Lors d'un POST, s'il n'y a pas d'erreur de validation, le nouvel ouvrage doit être ajouté au fichier biblio.txt. Le fureteur doit alors être redirigé vers la page index.php.

Suppression (Delete) :

Lors d'un GET à la page delete.php?id=___, le code doit retirer l'ouvrage indiqué du fichier biblio.txt;
La valeur du paramètre id doit correspondre à la valeur de l'identifiant unique de l'ouvrage;
Après la suppression dans le fichier, le fureteur doit être redirigé vers la page index.php;
Si le paramètre id est manquant ou si sa valeur ne se trouve pas dans le fichier, aucune erreur n'est levée et le fureteur doit quand même être redirigé vers la page index.php.
Pondération
Respect des exigences: 75%
Qualité du code source (indentation, identifiants, documentation et commentaires): 15%
Esthétisme: 10%

Remise
La remise sera faite par Slack dans un message direct m'étant adressé. Le projet doit être remis dans un fichier zip contenant vos 3 fichiers php ainsi que votre fichier biblio.txt.
Vous ne pouvez faire qu'une seule remise. Toute remise subséquente sera ignorée.
Le nom du fichier zip doit être composé du code permanent des membres de l'équipe séparés par un souligné p.e. "ABCD12341234_DEFG56785678.zip". Des points seront retirés si ceci n'est pas respecté.