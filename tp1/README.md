TP no 1 - Conception d'un site dynamique
Vous devez construire une page web dynamique. La page représente une bibliothèque. Les critères suivants doivent être respectés:

Le fichier PHP nommé index.php doit lire un fichier texte nommé biblio.txt
Le fichier biblio.txt représente un ensemble d'ouvrages. La description de chaque ouvrage dans le fichier est composé de 9 lignes:
L'identifiant de l'ouvrage p.e. "hunt1999ppj↵"
Le titre p.e. "The Pragmatic Programmer↵"
Le nom des auteurs p.e. "Hunt, A. et Thomas, D.↵"
(optionnelle, la ligne peut être vide) L'année de publication p.e. "1999↵"
La maison d'édition p.e. "Addison-Wesley Professional↵"
(optionnelle, la ligne peut être vide) L'édition p.e. "1↵"
Un URL vers le site web de l'ouvrage p.e. "https://pragprog.com/book/tpp/the-pragmatic-programmer↵"
(optionnelle, la ligne peut être vide) Un URL vers une image de l'ouvrage p.e. "https://imagery.pragprog.com/products/59/tpp_xlargecover.jpg↵"
La ligne de délimitation "* * *↵"
La page HTML générée dynamiquement doit contenir une section pour chaque ouvrage avec toutes les informations correspondantes incluant l'image (si présente dans le fichier biblio.txt).
Chaque hyperlien externe vers le site d'un ouvrage doit fonctionner.
Dans le haut de la page, une table des matières doit afficher le titre de chaque ouvrage dans un hyperlien interne. Le lien doit pointer vers la section de l'ouvrage dans la page (l'utilisation de l'identifiant de l'ouvrage est une bonne option ici)
Voici un exemple d'un fichier biblio.txt. Vous devez respecter le format du fichier. La correction sera faite avec un fichier biblio.txt différent.

D'autres critères doivent êtres respectés:

Tous les fichiers source doivent être encodés en UTF-8;
La page web ne doit pas contenir d'erreur d'encodage de caractères;
Le document HTML5 doit être valide;
Le site doit fonctionner avec la dernière version de Chrome;
Le projet doit fonctionner à partir de la commande $ php -S localhost:8080 avec PHP 7
Vous ne pouvez en aucun cas utiliser des librairies CSS ou HTML ou des thèmes préfabriqués;
Le code source doit être correctement indenté et documenté.

Pondération

Respect des exigences: 75%
Qualité du code source (indentation, identifiants, documentation et commentaires): 15%
Esthétisme: 10%

Remise : 

La remise sera faite par Slack dans un message direct m'étant adressé. Le projet doit être remis dans un fichier zip contenant votre fichier index.php ainsi que votre fichier biblio.txt.
Vous ne pouvez faire qu'une seule remise. Toute remise subséquente sera ignorée.
Le nom du fichier zip doit être composé du code permanent des membres de l'équipe séparés par un souligné p.e. "ABCD12341234_DEFG56785678.zip". Des points seront retirés si ceci n'est pas respecté.
