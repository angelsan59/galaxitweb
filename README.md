Galax-IT website
========================

La société de services Galax-IT (Lille Métropole, France) voulait une refonte complète de son site axée sur trois pôles :
* Présenter ses nombreuses activités
* Attirer et fidéliser les clients
* Attirer des futurs collaborateurs

Pour cela, elle m'a engagée dans le cadre de mon stage de fin de formation AFPA "Concepteur Développeur Informatique".

Etat des travaux
----------------

10/05/2016 : Le gros de la programmation est faite, surtout la section administration. Il reste la partie Candidature et Espace utilisateur.
Technologies utilisées
----------------------

Le site est conçu avec le framework [** Symfony 3 **] [https://symfony.com] On y retrouve :

  * HTML, CSS, javascript classiques

  * Bootstrap (CSS framework)

  * JQuery

  * Backend MySQL

  * FOSUserBundle, IvoryCKeditorBundle, DompdfBundle, VichUploaderBundle

Architecture
------------
Le site se compose d'une landing page pour les visiteurs et d'une section administration pour la gestion. Les éléments sont découpés en bundles :

  * Admin Bundle

  * Core Bundle

  * Event Bundle : Gestion des évènements et des inscriptions des visiteurs à ces évènements

  * News Bundle : L'actualité du site

  * Offres Bundle : les offres d'emploi et les candidatures à ces offres

  * User Bundle : Gestion des comptes utilisateurs