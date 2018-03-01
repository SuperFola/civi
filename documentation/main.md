# Bourse Coddity 2018

* Développer une plateforme permettant aux étudiants de présenter les éléments qui, selon vous, sont pertinents pour candidater à un job étudiant, un stage ou un établissement post-bac*

Identifiants pour `./db` : `Coddity`, `opera`

# Le choix des technologies

J'ai choisi de partir sur la réalisation d'un site web car cela me semblait le plus logique, ainsi que le plus simple : pas besoin de coder un serveur et un client, ni de gérer la durée de vie d'une connexion...

J'ai choisi d'utiliser Bootstrap et JQuery car je m'en étais déjà servi pour d'autres projets et j'avais donc déjà des bases en PHP, ainsi qu'en JS et bien entendu en création de sites web.

Je suis parti sur une idée simple : une sorte de vue qui en fonction des paramètres de l'URL, devait pouvoir tout faire. Bien sûr il y a des raccourcis, au lieu de naviguer vers `index.php?user=Alexandre+Plateau&getinfo=1&editprofile=0&encoreunparametretreslong=1337`, des pages comme `editaccount.php` ou `viewprofile.php` permettront de s'abstraire d'une écriture un peu fastidieuse (surtout pour le partage du profil).