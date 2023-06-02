# P5 OC - Créer son blog en PHP
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/c45486539ee243ef993ae7c6ce2f6491)](https://app.codacy.com/gh/cavmandos/P5/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

## Pré-requis pour lancer le projet
-   PHP 8.2 ou supérieur
-   Composer
-   Un serveur web (Apache, MySQL, PHP)
-   Un éditeur de code

## Installation du projet
Pour installer ce projet, les étapes sont :

1.  Cloner le repository

2.  A la racine du projet, installer les dépendances avec composer

3.  Importer la base de données se trouvant à la racine du projet

4.  Créer un fichier "config.php" où vous placerez vos informations de connexion à la Base de données / services de messagerie pour l'envoi de mail.

5.  Dans ce fichier "config.php", déclarer vos constantes comme ceci :

```
define('DB_HOST', 'localhost');
define('DB_NAME', 'Blog_P5');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
```
define('EMAIL', 'votre_email_ici');
define('PASSWORD', 'votre_mot_de_passe_ici');

6.  Lancer votre serveur local

7.  Tester le site

Vous avez deux exemples de rôles :
-   Un admin = test@mail.com (mdp: test)
-   Un inscrit = test2@mail.com (mdp: test)

### Description du Projet 5
Le projet est de développer son blog professionnel. Ce site web se décompose en deux grands groupes de pages :

1.les pages utiles à tous les visiteurs ;
2.les pages permettant d’administrer votre blog ;

Voici la liste des pages qui devront être accessibles depuis votre site web :

la page d'accueil ;
la page listant l’ensemble des blog posts ;
la page affichant un blog post ;
la page permettant d’ajouter un blog post ;
la page permettant de modifier un blog post ;
les pages permettant de modifier/supprimer un blog post ;
les pages de connexion/enregistrement des utilisateurs.
Vous développerez une partie administration qui devra être accessible uniquement aux utilisateurs inscrits et validés.

Les pages d’administration seront donc accessibles sur conditions et vous veillerez à la sécurité de la partie administration.

Commençons par les pages utiles à tous les internautes.

Sur la page d’accueil, il faudra présenter les informations suivantes :

votre nom et votre prénom ;
une photo et/ou un logo ;
une phrase d’accroche qui vous ressemble (exemple : “Martin Durand, le développeur qu’il vous faut !”) ;
un menu permettant de naviguer parmi l’ensemble des pages de votre site web ;
un formulaire de contact (à la soumission de ce formulaire, un e-mail avec toutes ces informations vous sera envoyé) avec les champs suivants :
nom/prénom,
e-mail de contact,
message,
un lien vers votre CV au format PDF ;
et l’ensemble des liens vers les réseaux sociaux où l’on peut vous suivre (GitHub, LinkedIn, Twitter…).
Sur la page listant tous les blogs posts (du plus récent au plus ancien), il faut afficher les informations suivantes pour chaque blog post :

le titre ;
la date de dernière modification ;
le chapô ;
et un lien vers le blog post.

Sur la page présentant le détail d’un blog post, il faut afficher les informations suivantes :

le titre ;
le chapô ;
le contenu ;
l’auteur ;
la date de dernière mise à jour ;
le formulaire permettant d’ajouter un commentaire (soumis pour validation) ;
les listes des commentaires validés et publiés.
Sur la page permettant de modifier un blog post, l’utilisateur a la possibilité de modifier les champs titre, chapô, auteur et contenu.

Dans le footer menu, il doit figurer un lien pour accéder à l’administration du blog.
