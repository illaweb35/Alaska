# Alaska
## Projet 3

### Réalisation d'un moteur de blog en PHP et MYSQL

  **FrontEnd** _ pour la gestion côté visiteur

  _ Index
  * Affichage des billets avec possibilité de commenter et de modéré les commentaires.
  * Affichage Page d'accueil sur forme de CARD, nombre de card afficher  gérer dans le fichier Config.php.
  * Affichage d'un billet avec ses commentaires  et la possibilité de poster ou modéré les commentaires.
  * Affichage de la liste des billets.

**BackEnd** _ pour l'administration du site

  _ Accès à l'administration par login

  _ Tableau de bord
  * Nombres total de billets du site , et le nombre publié.
  * Nombre de commentaires total , et nombre modérés.
  * Nombre d'utilisateur inscrit sur le site.
  * Affichage sous forme de tableau des commentaires modérés, avec la possibilité de les valider ou de les supprimer.

_ Ecrire un billet
  * Formulaire de création avec interface WYSIWYG [TinyMCE](https://www.tinymce.com/), pour une meilleure ergonomie de saisie.
  * Possibilité d'insérer une image pour illustrer le billet (jpg,jpeg,gif,png)
  * Auteur de l'article paramétrable avec par défaut *Jean FORTEROCHE*.
  * Switch pour poster ou pas le billet sur le site.

_ Liste des billets
  * Affichage de tous les billets du site.
  * Switch pour l'état de publication ou non des billets.
  * Icône pour ouvrir la page de modification du billet
  * Icône pour supprimer le billet.

_ Utilisateurs
  * Liste des utilisateurs du site  avec nom, email, date de création de la fiche et icônes pour la modification de la fiche ou la suppression.
  * Formulaire pour la création d'un nouvel utilisateur.

_ Connexion
  * Quitter qui renvoi vers la page d'accueil du front pour vérifier le visuel des publications.
  * Déconnexion qui efface la session et renvoie vers le FrontEnd.


---
Moteur en PHP et MYSQL

Affichage HTML / CSS et framework [Bulma](https://bulma.io/)

Interaction utilisateur JAVASCRIPT.

Pour étude seulement.
Tous droits réservés 2018 [illaweb35](https://www.illaweb.fr).
