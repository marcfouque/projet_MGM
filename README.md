<p align="center">
  <a href="http://www.isped.u-bordeaux.fr/" target="_blank">
    <img src="http://www.isped.u-bordeaux.fr/Portals/0/ISPED-UBX_2019CJMN.jpg?ver=2019-03-27-141509-167" alt="isped-ub logo">
   </a>
</p>
<p align="center"><b>M</b>anon Gest - <b>G</b>régory Lobre - <b>M</b>arc Fouqué</p>

# projet_MGM

Projet dans le cadre de l'UE INF204,  consistant en une interface web permettant de visualiser et de gérer des données issue d'une cohorte.

### Prérequis
 Serveur Apache >2.2
 PHP >7
 MySQL >8
 Navigateur Internet lisant le Javascript
 💻

## Installation

Cloner le projet dans le repertoire source du localhost ou public du serveur Apache
```
git clone https://github.com/marcfouque/projet_MGM.git
```
Importation du fichier bd_ahai.sql dans MySQL (Lancer MySQL avant)
```
mysql -u username < PATH_TO_PROJECT/bd_ahai.sql
```
Passage via une interface d'administration de MySQL possible

<p>Paramétrage du fichier <i>./tools/connect.php</i> avec vos identifiants mysql</p>

<p>Lancer le serveur Apache et MySQL</p>

## Utilisation

<p><i>./index.php</i> , vous affiche la page d'accueil, de là possiblité d'accéder à l'ajout d'entités dans la base de données via l'option Ajouter ou d'en rechercher via l'option Consulter
La recherche des entités vous permettra de modifier ou de supprimer les entités trouvées.
L'ajout, la Modification et la Suppression d'entités nécessite d'etre connecté.</p>
<p>Ajouter un utilisateur grace à la commande
```
mysql INSERT INTO utilisateur VALUES ('nomdelutilisateur',cryptMdp('motdepasse'))
```</p>
