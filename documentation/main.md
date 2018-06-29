# Bourse Coddity 2018

*Développer une plateforme permettant aux étudiants de présenter les éléments qui, selon vous, sont pertinents pour postuler à un job étudiant, un stage ou un établissement post-bac.*

Identifiants pour `./db` : `Coddity`, `opera`

Identifiants du compte administrateur sur le site : `ADMIN`, `admin`

# Le choix des technologies

J'ai choisi de partir sur la réalisation d'un site web car cela me semblait le plus logique pour ce type de projet, ainsi que le plus simple : pas besoin de coder un serveur et un client, ni de gérer la durée de vie d'une connexion...

J'ai choisi d'utiliser Bootstrap et JQuery car je m'en étais déjà servi pour d'autres projets et j'avais donc déjà des bases en PHP, ainsi qu'en JS et bien entendu en création de sites web.

Je suis parti sur une idée simple : une sorte de vue qui en fonction des paramètres de l'URL, devait pouvoir tout faire. Bien sûr il y a des raccourcis, au lieu de naviguer vers `index.php?user=Alexandre+Plateau&getinfo=1&editprofile=0&encoreunparametretreslong=1337`, des pages comme `editaccount.php` ou `viewprofile.php` permettront de s'abstraire d'une écriture un peu fastidieuse (surtout pour le partage du profil).

# Des remarques en vrac sur le code

J'utilise `session_start()` de façon à créer une session par utilisateur côté serveur (qui utilise des cookies côté client pour lier l'utilisateur à sa session), et les bases de données sont constituées de fichier .json (pour aller plus vite pendant le déploiement et débugguer plus facilement ; une amélioration serait d'utiliser une base de données MySQL, plus rapide et plus sécurisée).

Il y a concrètement une seule page, index.php, qui charge toutes les autres *on the go*, en fonction des besoins (et de la vue actuelle). Plus simple, mais aussi plus long à charger car une page en charge (pour le moment) une petite dizaine.

Chaque vue est un fichier markdown et certaines choses qui ont besoin d'être gérées dynamiquement sont gérées avec du code PHP. Cela permet de modifier les vues plus facilement (elles sont donc affichées avec Parsedown).

Le moteur de recherches est *regex friendly* (tant qu'il n'y a pas de caractères trop spéciaux qui seraient remplacés par un équivalent comme la recherche est passée dans un `htmlspecialchars()`) et permet de chercher quelqu'un par mots clés, en regardant dans 
les Curriculum Vitae, compétences, informations complémentaires, adresses mails, noms et prénoms, âge, et dates d'inscription et de dernière connexion. On peut donc lister tous les utilisateurs en recherchant uniquement `@` (caractère présent dans les e-mail).

# Usage du `$_SESSION`

Cette variable globale est utilisée pour stocker un peu de tout, des résultats de recherches au format markdown à l'identifiant de connexion d'une personne, aux différents indicateurs d'affichage des vues.

Champs réservés : `error`, `id`, `search`, `search-head`, `search-error`, `viewingprofileof`, `name`.

# Critiques

Un rôle ADMINISTRATEUR est créé et est exploitable en utilisant la méthode `is(String $role)` sur un User, mais n'est implémenté nulle part (autrement dit, avoir un compte administrateur ne sert pas à grand chose actuellement). 
On pourrait voir comme amélioration la possibilité de modérer des comptes, les modifier, en étant administrateur.

De plus, il n'est actuellement pas possible de mettre une photo de profil sur le site. Cela en est ainsi pour deux raisons :

- la première étant que je ne voulais pas que les utilisateurs soient plutôt jugés sur leur apparence physique que sur leurs compétences réelles
- la seconde est liée au manque de temps (pour faire une mise en forme convenable entre autre)

Du côté des bugs, nous avons très certainement une faille XSS sur le remplissage des compétences (édition du profil) comme cette partie a dû être faite en grande partie en JavaScript mixé avec du PHP sans grande protection (manque de `htmlspecialchars()` entre autre). 
De plus, le premier utilisateur inscrit se retrouve dupliqué dans la base de donnée (mais heureusement il n'en est pas de même pour les utilisateurs suivants).

# Difficultés rencontrées

J'ai dû me remettre à niveau en PHP (même si j'avais des bases j'avais pas mal perdu niveau connaissances de la bibliothèque standard) et en JS pour réaliser ce projet.

Les vraies difficultés sont venues quand j'ai dû transmettre la liste des compétences dans une requête POST, sachant que ces compétences étaient générées via du JS et que je ne pouvais pas leur attribuer un `name` (pour que le POST puisse les récupérer après).
Également, comment pouvais-je envoyer l'état de boutons dans une requête POST et lire tout cela simplement ? Je ne voyais tout simplement pas. Donc un code JS s'occupe de lire le DOM, de trouver les compétences et d'en faire un dictionnaire pour savoir que 
compétence X=niveau 5 car on a 5 boutons d'enfoncés, ensuite cela est réinjecté dans un champ caché unique avec un attribut name, pour l'envoyer dans la requête POST.

Générer proprement les compétences de façon à pouvoir en rajouter ou en supprimer, charger celles déjà existantes sans repartir à 0, m'a demandé de mettre en lien du code PHP et du code JS (l'un génère un bout de l'autre par endroit pour que l'autre utilise le premier de façon détournée, un gros casse-tête).

Je l'ai déjà citée dans les critiques et principalement les bugs mais c'est une difficulté que j'ai identifiée mais pas fixée (par manque de temps et de moyens pour la débusquer) : le premier utilisateur est dupliqué (parfois non, parfois oui), et des messages d'erreurs
fantômes apparaissent sans qu'aucune erreur ne soit lancée (sûrement parce que j'utilise `$_SESSION['error']` pour les transmettre et qu'à un endroit je ne les ai pas supprimés comme j'aurais dû, je pense).

Cela mis à part je ne pense avoir vu d'autres difficultés majeures (en dehors du fameux "comment dois-je mettre ci/ça en forme ?", étant donné que je n'ai pas vraiment une âme de designer mais plus de programmeur) dans cette réalisation, qui m'a permis de 
me remettre à développer un projet web (ce qui en un sens m'avait un peu manqué je trouve), de découvrir des fonctionnalités que je ne soupçonnais pas en JS et en PHP. J'ai également pû me torturer un peu l'esprit quant à l'imbrication de mes vues et leur usage
ainsi qu'à propos de l'architecture d'un site web (ce qui fait du bien de temps à autre).