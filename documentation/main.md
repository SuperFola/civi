# Bourse Coddity 2018

*Développer une plateforme permettant aux étudiants de présenter les éléments qui, selon vous, sont pertinents pour candidater à un job étudiant, un stage ou un établissement post-bac*

Identifiants pour `./db` : `Coddity`, `opera`

Identifiants du compte adminstrateur sur le site : `ADMIN`, `admin`

# Le choix des technologies

J'ai choisi de partir sur la réalisation d'un site web car cela me semblait le plus logique pour ce type de projet, ainsi que le plus simple : pas besoin de coder un serveur et un client, ni de gérer la durée de vie d'une connexion...

J'ai choisi d'utiliser Bootstrap et JQuery car je m'en étais déjà servi pour d'autres projets et j'avais donc déjà des bases en PHP, ainsi qu'en JS et bien entendu en création de sites web.

Je suis parti sur une idée simple : une sorte de vue qui en fonction des paramètres de l'URL, devait pouvoir tout faire. Bien sûr il y a des raccourcis, au lieu de naviguer vers `index.php?user=Alexandre+Plateau&getinfo=1&editprofile=0&encoreunparametretreslong=1337`, des pages comme `editaccount.php` ou `viewprofile.php` permettront de s'abstraire d'une écriture un peu fastidieuse (surtout pour le partage du profil).

# Des remarques en vrac sur le code

J'utilise `session_start()` de façon à créer une session par utilisateur côté serveur, et les bases de données sont constituées de fichier .json (pour aller plus vite pendant le déploiement et débugguer plus facilement ; une amélioration serait d'utiliser une base de données MySQL, plus rapide et plus sécurisée).

Il y a concrètement une seule page, index.php, qui charge toutes les autres *on the go*, en fonction des besoins (et de la vue actuelle). Plus simple, mais aussi plus long à charger du coup car une page en charge (pour le moment) une petite dizaine.

Chaque vue est un fichier markdown et certaines choses qui ont besoin d'être gérées dynamiquement sont gérées avec du code PHP. Cela permet de modifier les vues plus facilement (elles sont donc affichées avec Parsedown).

Le moteur de recherche est regex friendly (tant qu'il n'y a pas de caractères trop spéciaux qui seraient remplacés par un équivalent comme la recherche est passée dans un `htmlspecialchars()`) et permet de chercher quelqu'un par mots clés, en regardant dans 
les Curriculum Vitae, compétences, informations complémentaires, adresses mails, noms et prénoms, âge, et dates d'inscription et de dernière connexion. On peut donc lister tous les utilisateurs en recherchant uniquement `@` (caractère présent dans les e-mail).

# Usage du $_SESSION

Cette variable globale est utilisée pour stocker un peu de tout, des résultats de recherche au format markdown à l'identifiant de connexion d'une personne, aux différents indicateurs d'affichage des vues.

Champs réservés : `error`, `id`, `search`, `search-head`, `search-error`, `viewingprofileof`, `name`.

# Critiques

Un rôle ADMINISTRATEUR est créé et est exploitable en utilisant la méthode `is(String $role)` sur un User, mais n'est implémenté nul part (autrement dit, avoir un compte administrateur ne sert pas à grand chose actuellement). 
On pourrait voir comme amélioration la possibilité de modérer des comptes, les modifier, en étant administrateur.

De plus, il n'est actuellement pas possible de mettre une photo de profil sur le site. Cela en est ainsi pour deux raisons :

* la première étant que je ne voulais pas que les utilisateurs soient plutôt jugés sur leur apparence physique que sur leurs compétences réelles

* la seconde est liée au manque de temps (pour faire une mise en forme convenable entre autre)

Du côté des bugs, nous avons très certainement une faille XSS sur le remplissage des compétences (édition du profil) comme cette partie a dû être faite en grande partie en JavaScript mixé avec du PHP sans grande protection (manque de `htmlspecialchars()` entre autre). 
De plus, le premier utilisateur inscrit se retrouve dupliqué dans la base de donnée (mais heureusement il n'en est pas de même pour les utilisateurs suivants).