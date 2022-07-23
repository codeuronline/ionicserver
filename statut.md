# statut des differents éléments

## fichier manage-data.php: (finished)

vous pouvez échanger avec la si la requête contient le mot clé (create,delete,update)

sous la forme http//:`<adresse du ionicserver>`/manage-data.php?key=`<cle>`


### mot clé : create(finished)

il doit etre associé à un objet json avec un certain nombre de champs


### mot clé: update(finished)

    il doit être  associé au meme objet json et une seconde clé id_task

http//:`<adresse du ionicserver>`/manage-data.php?key=update&id_task=

### mot clé : delete(finished*)

    il doit être  associé  à une seconde clé id_task

http//:`<adresse du ionicserver>`/manage-data.php?key=delete&id_task=

--> ne prend pas en compte le delete physique des images

## fichier retrieve-data.php

vous pouvez échanger avec la BD si la requête contient le mot clé

sous la forme http//:`<adresse du ionicserver>`/manage-retrieve.php?key=`<cle>`

la clé peut prendre 3 états

### found

retourne tous les objets dont le status est **found**

### lost

retourne tous les objets dont le status est **lost**

### un numero (integer)

retourne l'objet dont  id est le **numéro**
