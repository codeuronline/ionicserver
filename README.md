# ionicserver

## API sur serveur PHP/Mysql liée à l'appli mobile [FoundLost](https://github.com/codeuronline/appli-ionic/tree/master/ionicfoundlost/foundlost)

## 3 éléments du serveurs :

### [appli manage-data.php](https://github.com/codeuronline/ionicserver/blob/main/manage-data.php)

Permet de gérer la BD foundlist(create/modification/suppression)

#### Create
syntaxe:
http//:`<adresse du ionicserver>`/manage-data.php?key=create

Il doit être associé à un objet json avec un certain nombre de champs

* description(string)
* status(boolean)
* date(YY-MM-DD)
* localisation(string)
* nom (string)
* prénom (string)
* email(valide)
* checkedpicture(boolean) ** champ optionnel
* filename(string) ** champ optionnel 

#### Update 
Met à jour un objet dans la BD
Néccsite une seconde clé id_task pour définir l'objet à modifier

Syntaxe:
http//:`<adresse du ionicserver>`/manage-data.php?key=update&id_task=

#### delete nécessite une second clé id_task pour définir l'objet à effacer
Supprime un objet dans la BD et efface le cas échéant l'image stockée sur le serveur
Syntaxe:  
http//:`<adresse du ionicserver>`/manage-data.php?key=delete&id_task=



#### un numero (integer)
Retourne l'objet dont la key est le **numéro**

Syntaxe:
http//:`<adresse du ionicserver>`/manage-data.php?key=

### [appli retrieve-data.php](https://github.com/codeuronline/ionicserver/blob/main/retrieve-data.php)


Syntaxe:
http//:`<adresse du ionicserver>`/manage-data.php?key=found
found -> Renvoie la liste des objets trouvés

http//:`<adresse du ionicserver>`/manage-data.php?key=lost
 lost  -> Renvoie la liste des objets perdus
 
http//:`<adresse du ionicserver>`/manage-data.php?key=integer
 un numéro -> Renvoie l'objet qui porte ce numéro



### [appli image.php](https://github.com/codeuronline/ionicserver/blob/main/image.php)

Permet de réceptionner le fichier image pour l'appli [foundlost](https://github.com/codeuronline/appli-ionic/tree/master/ionicfoundlost/foundlost) dans le repertoire upload/
### Mise à jour du 28/07/2022
#### -> déplacement de la condition sur le status qui était mis au mauvais endroit et par conséquent ne traitait pas le changement de statuts
#### -> correction d'un bug si l'image était déja insérée en BD 
### Mise à jour du 01/08/2022
#### -> correction d'un bug qui effaçait systématiquement l'ancienne image stockée sur le serveur en mode update
