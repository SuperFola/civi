# Procédure d'installation

Si vous testez le projet en local, pensez à modifier l'adresse du site dans `config.php` pour que sa valeur soit `localhost`.

Il n'y a nul besoin d'installer une base de données car les données sont stockées via des fichiers JSON.

La version de PHP requise est la 5.4[.12].

**Important**: pour des raisons de compatibilités entre systèmes, pensez à supprimer le fichier de base de données : `db/users`, à chaque nouvelle installation (celui-ci se recrée automatiquement).

Ce projet a été testé en local sur Windows 10, WAMP serveur version 2.4 avec PHP 5.4.12 et Apache 2.4.4, et sur alwaysdata (http://cv-dot-com.alwaysdata.net) avec PHP 5.4.45 et un php.ini modifié (trouvable [ici](modified-php.ini)).