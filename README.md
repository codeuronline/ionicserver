# ionicserver

## API sur serveur PHP/Mysql liée à l'appli mobile [appli foundlost](https://github.com/codeuronline/appli-ionic/tree/master/ionicfoundlost/foundlost)

## 3 elements du serveurs :

### [appli manage-data.php](https://github.com/codeuronline/ionicserver/manage-data.php)

Permet de gerer la BD foundlist(en create/modification/suppression)

#### create
 create un objet dans la BD
#### update neccsite une second cle id_task pour definir l'objet à modifier
 update un objet dans la BD
#### delete necessite une second cl" id_task pour definir l'objet a effacer
 delete un objet dans la BD et efface le cas échéant la image sur le serveur

### [appli retrieve-data.php](https://github.com/codeuronline/ionicserver/retrieve-data.php)

Permet de récupérer les informations de la BD

### [appli image.php](https://github.com/codeuronline/ionicserver/image.php)

Permet de réceptionner le stockage d'une image pour [appli foundlost](https://github.com/codeuronline/appli-ionic/tree/master/ionicfoundlost/foundlost) dans le repertoire upload/
