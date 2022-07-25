# ionicserver

## API sur serveur PHP/Mysql liée à l'appli mobile [FoundLost](https://github.com/codeuronline/appli-ionic/tree/master/ionicfoundlost/foundlost)

## 3 éléments du serveurs :

### [appli manage-data.php](https://github.com/codeuronline/ionicserver/blob/main/manage-data.php)

Permet de gérer la BD foundlist(create/modification/suppression)

#### create
Créer un objet dans la BD provenant d'un objet JSON
#### update néccsite une seconde clé id_task pour définir l'objet à modifier
Met à jour un objet dans la BD
#### delete nécessite une second clé id_task pour définir l'objet à effacer
Supprime un objet dans la BD et efface le cas échéant l'image stockée sur le serveur

### [appli retrieve-data.php](https://github.com/codeuronline/ionicserver/blob/main/retrieve-data.php)

Permet de récupérer les informations de la BD selon la clé
 found -> Renvoie la liste des objets trouvés
 lost  -> Renvoie la liste des objets perdus
 un numéro -> Renvoie l'objet qui porte ce num&ro

### [appli image.php](https://github.com/codeuronline/ionicserver/blob/main/image.php)

Permet de réceptionner le fichier image pour l'appli [foundlost](https://github.com/codeuronline/appli-ionic/tree/master/ionicfoundlost/foundlost) dans le repertoire upload/
