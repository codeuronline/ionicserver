<?php
//define("URL", str_replace("manage-data.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
header('Access-Control-Allow-Origin: *');
//header('Access-Control-Methods:GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: Content-type");

// TODO : Définir les paramètres de connexion à la base
require_once 'models/Database.php';
require_once 'tools/functions.php';
require_once 'tools/const.php';
// TODO : Créer une instance de la classe PDO
$pdo = new Database;
// var_dump("Instance PDO crée");
// Récupérer le paramètre d’action de l’URL du client depuis $_GET[‘key’] 
// et nettoyer la valeur
extract($_GET);
if (isset($key)) {
    $key = strip_tags(valid_data($key));
}
if (isset($id_task)) {
    $id_task = strip_tags(valid_data($id_task));
}
//var_dump("key", $key);

// Récupérer les paramètres envoyés par le client vers l’API
$input = file_get_contents('php://input');
if (!empty($input) || (@$key == 'delete')) {
    $data = json_decode($input, true);
    //extract($data);
    if ($key != 'delete') {
        // cas de a creation d'un user ->pas  user_id on doit on cree 1
        // cas  de connexion  et recover ->on doit le recuperer 
        if ($key == "connexion" || $key == "user" || $key == "recover") {
            $email_user = strip_tags(valid_data($data['email_user']));
            $password = strip_tags(valid_data($data['password']));
            if ($key == "recover") {
                $captcha = strip_tags(valid_data($data['captcha']));
                $passwordVerify = strip_tags(valid_data($data['passwordVerify']));
            }
        } else {
            //dernier nettoyage des elements
            $user_id = intVal(strip_tags($data['user_id']));
            $id_object =  strip_tags($data['id_object']);
            $description = strip_tags(valid_data($data['description']));
            $status = strip_tags($data['status']);
            $date = strip_tags($data['date']);
            $location = strip_tags(valid_data($data['location']));
            $firstname = strip_tags(valid_data($data['firstname']));
            $lastname = strip_tags(valid_data($data['lastname']));
            $email = strip_tags(valid_data($data['email']));
            if (isset($data['checkedpicture'])) {
                $checkedpicture = strip_tags($data['checkedpicture']);
                $filename = strip_tags(valid_data($data['filename']));
            }
            if (isset($data['email_user'])) {
                $email_user = strip_tags(valid_data($data['email_user']));
                $password = strip_tags(valid_data($data['password']));
            }
        }
    } else {
        $user_id=intVal(strip_tags($_GET['user_id']));
    }

    // En fonction du mode d’action requis
    switch ($key) {
            //Ajoute un nouvel enregistrement
        case "create":
            var_dump("CREATE DETECTE");
            // TODO : Filtrer les valeurs entrantes
            if (!empty($description) && (strlen($description) > MIN_DESCRIPTION_SIZE) && strlen($description) <= MAX_DESCRIPTION_SIZE) {
                //var_dump(filter_var($status, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE));
                if (filter_var($status, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null) {
                    if (is_date_valid($date)) {
                        if (!empty($location) && (strlen($location) > MIN_LOCATION_SIZE) && (strlen($location) <= MAX_LOCATION_SIZE)) {
                            if (!empty($firstname) && (strlen($firstname) > MIN_FIRSTNAME_SIZE) && (strlen($firstname) <= MAX_FIRSTNAME_SIZE)) {
                                if (!empty($lastname) && (strlen($lastname) > MIN_LASTNAME_SIZE) && (strlen($lastname) <= MAX_LASTNAME_SIZE)) {
                                    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && (strlen($email) > MIN_EMAIL_SIZE) && (strlen($email) <= MAX_EMAIL_SIZE)) {
                                        if (!empty($user_id)&&  filter_var($user_id,FILTER_VALIDATE_INT)) {
                                        //debut
                                        try {
                                            // TODO : Préparer la requête dans un try/catch
                                            $req = "INSERT INTO 
                                            foundlost (description,status,date,location,firstname,lastname,email,user_id) 
                                            values (:description,:status,:date,:location,:firstname,:lastname,:email,:user_id)";
                                            $stmt = $pdo->getPDO()->prepare($req);
                                            $stmt->bindValue(":description", $description, PDO::PARAM_STR);
                                            $stmt->bindValue(":status", $status, PDO::PARAM_BOOL);
                                            $stmt->bindValue(":date", $date, PDO::PARAM_STR);
                                            $stmt->bindValue(":location", $location, PDO::PARAM_STR);
                                            $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
                                            $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
                                            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
                                            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
                                            $resultat = $stmt->execute();
                                            $stmt->closeCursor();
                                            if ($resultat > 0) {
                                                var_dump("INSERTION PRODUCT IN BD");
                                                $pdo->getPDO();
                                            }
                                        } catch (\Throwable $th) {
                                            echo $th;
                                            //throw $th;
                                        }
                                        //fin
                                        }else{
                                            var_dump("Problème Insertion sur user_id", $user_id);
                                        }
                                        
                                    } else {
                                        var_dump("Problème Insertion sur Email", $email);
                                    }
                                } else {
                                    var_dump("Problème Insertion  sur Date: ", $lastname);
                                }
                            } else {
                                var_dump("Problème Insertion sur firstname: ", $firstname);
                            }
                        } else {
                            var_dump("Problème Insertion sur Localisation: ", $location);
                        }
                    } else {
                        var_dump("Problème Insertion sur Date: ", $date);
                    }
                    //DATE - format YYYY-MM-DDilter_var($date,FILTER_V))
                } else {
                    var_dump("Problème Insertion sur Status: ", $status);
                }
            } else {
                var_dump("Problème Insertion sur Description: ", $description);
            }
            break;
            // Mettre à jour un enregistrement existant
        case "update":
            // TODO : Nettoyer les valeurs en provenant de l’URL client
            echo "UPDATE DETECTE";
            if (isset(($_GET["id_task"]))) {
                $id_task = strip_tags($data['id_object']);
                $id_task = intval($id_task);
                if (!empty($description) && (strlen($description) > MIN_DESCRIPTION_SIZE) && strlen($description) <= MAX_DESCRIPTION_SIZE) {
                    $status = boolval($status);
                    if (($status == 0) || ($status == 1) || ($status == false) || ($status = true)) {
                        var_dump('status', $status);
                        $status = ($status == true) ? 1 : 0;
                        if (is_date_valid($date)) {
                            if (!empty($location) && (strlen($location) > MIN_LOCATION_SIZE) && (strlen($location) <= MAX_LOCATION_SIZE)) {
                                if (!empty($firstname) && (strlen($firstname) > MIN_FIRSTNAME_SIZE) && (strlen($firstname) <= MAX_FIRSTNAME_SIZE)) {
                                    if (!empty($lastname) && (strlen($lastname) > MIN_LASTNAME_SIZE) && (strlen($lastname) <= MAX_LASTNAME_SIZE)) {
                                        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && (strlen($email) > MIN_EMAIL_SIZE) && (strlen($email) <= MAX_EMAIL_SIZE)) {
                                            // TODO : Préparer la requête dans un try/catch    //pb au changement de status
                                            //var_dump('email', $email);
                                            if ($data['filename'] != null) {
                                                if (isset($data['checkedpicture'])) {
                                                    //var_dump('FileName detected');
                                                    try {
                                                        /**necessite de verifier l'existence d'une image avant d'effacer de update l'obejet avec une nouvelle image*/
                                                        $reqExistence = "SELECT filename FROM foundlost WHERE id_object=$id_task";
                                                        $stmt = $pdo->getPDO()->prepare($reqExistence);
                                                        $stmt->bindValue(":id_task", $id_task, PDO::PARAM_INT);
                                                        $resultatExistence = $stmt->execute();
                                                        $element = $stmt->fetch(PDO::FETCH_ASSOC);
                                                        $stmt->closeCursor();
                                                        if ($resultatExistence > 0) {
                                                            if ($element['filename'] != null) {
                                                                if ($data['filename'] != $element['filename']) {
                                                                    unlink("upload/" . $element['filename']);
                                                                    echo "SUPPRESSION de l'image"; # code...
                                                                }
                                                            }
                                                        }
                                                        $pdo->getPDO();
                                                        $checkedpicture = boolval($checkedpicture);
                                                        $req = "UPDATE foundlost SET 
                                                                id_object=:id_object,
                                                                description=:description,
                                                                status=:status,
                                                                date=:date,
                                                                location=:location,
                                                                firstname=:firstname,
                                                                lastname=:lastname,
                                                                email=:email,
                                                                checkedpicture=:checkedpicture,
                                                                filename=:filename 
                                                                WHERE id_object = :id_object";
                                                        $stmt = $pdo->getPDO()->prepare($req);
                                                        $stmt->bindValue(":id_object", $id_task, PDO::PARAM_INT);
                                                        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
                                                        $stmt->bindValue(":status", $status, PDO::PARAM_BOOL);
                                                        $stmt->bindValue(":date", $date, PDO::PARAM_STR);
                                                        $stmt->bindValue(":location", $location, PDO::PARAM_STR);
                                                        $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
                                                        $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
                                                        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
                                                        $stmt->bindValue(":checkedpicture", $checkedpicture, PDO::PARAM_BOOL);
                                                        $stmt->bindValue(":filename", $filename, PDO::PARAM_STR);
                                                        $resultat = $stmt->execute();
                                                        $stmt->closeCursor();
                                                        $stmt->closeCursor();
                                                        if ($resultat > 0) {
                                                            echo "MODIFICATION PRODUCT IN BD AVEC INSERTION D IMAGE";
                                                            $pdo->getPDO();
                                                        }
                                                    } catch (\Throwable $th) {
                                                        var_dump($th);
                                                        echo "ERREUR DE MODIFICATION";
                                                    }
                                                }
                                            } else {
                                                var_dump('no ');
                                                try {
                                                    $req = "UPDATE foundlost SET 
                                                    id_object=:id_object,
                                                    description=:description,
                                                    status=:status,
                                                    date=:date,
                                                    location=:location,
                                                    firstname=:firstname,
                                                    lastname=:lastname,
                                                    email=:email
                                                    WHERE id_object = :id_object";
                                                    $stmt = $pdo->getPDO()->prepare($req);
                                                    $stmt->bindValue(":id_object", $id_task, PDO::PARAM_INT);
                                                    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
                                                    $stmt->bindValue(":status", $status, PDO::PARAM_BOOL);
                                                    $stmt->bindValue(":date", $date, PDO::PARAM_STR);
                                                    $stmt->bindValue(":location", $location, PDO::PARAM_STR);
                                                    $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
                                                    $stmt->bindValue(":lastname", $lastname, PDO::PARAM_STR);
                                                    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
                                                    $resultat = $stmt->execute();
                                                    $stmt->closeCursor();
                                                    if ($resultat > 0) {
                                                        var_dump("MODIFICATION PRODUCT IN BD");
                                                        $pdo->getPDO();
                                                    }
                                                } catch (\Throwable $th) {
                                                    echo "ERREUR DE MODIFICATION";
                                                }
                                            }
                                        }
                                    } else {
                                        var_dump("Problème Modification sur Email", $email);
                                    }
                                } else {
                                    var_dump("Problème Modification sur Date: ", $lastname);
                                }
                            } else {
                                var_dump("Problème Modification sur firstname: ", $firstname);
                            }
                        } else {
                            var_dump("Problème Modification sur Localisation: ", $location);
                        }
                    } else {
                        var_dump("Problème Modification sur Date: ", $date);
                    }
                    //DATE - format YYYY-MM-DDiflter_var($date,FILTER_V))
                } else {
                    var_dump("Problème Modification sur Status: ", $status);
                }
            } else {
                var_dump("Problème Modification sur Description: ", $description);
            }
            // TODO : Préparer et exécuter la requête (dans un try/catch)
            break;
            // Supprimer un enregistrement existant
        case 'delete':
            echo " DELETE DETECTE";
            // TODO : Nettoyer les valeurs de l’URL client (id_task)
            if (isset(($_GET["id_task"]))) {
                var_dump($id_task);
                try {
                    //code...
                /**on vérifie s'il n'existe pas une trace d'un enregistrement précédent */
                $reqExistence = "SELECT filename FROM foundlost WHERE id_object=:id_task";
                $stmt = $pdo->getPDO()->prepare($reqExistence);
                $stmt->bindValue(":id_task", $id_task, PDO::PARAM_INT);
                //$stmt->bindValue(":id_task", $id_task, PDO::PARAM_INT);
                $resultat = $stmt->execute();
                $element = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                //if ($element['filename'] != null) {
                if (isset($element['filename']) && !empty($element['filename'])) {
                    unlink("upload/" . $element['filename']);
                    var_dump("SUPPRESSION de l'image");
                }
                $pdo->getPDO();
                // TODO : Préparer la requête dans un try/catch
                $req = "DELETE FROM foundlost WHERE id_object=:id_task";
                $stmt = $pdo->getPDO()->prepare($req);
                $stmt->bindValue(":id_task", $id_task, PDO::PARAM_INT);
                $resultat1 = $stmt->execute();   
                $stmt->closeCursor();
                if ($resultat1 > 0) {
                    var_dump("SUPPRESSION PRODUCT IN BD");
                    $pdo->getPDO();
                }
            } catch (\Throwable $th) {
                "ERREUR DE SUPRESSION IN BD";
            }
        }
            // TODO : Préparer et exécuter la requête (dans un try/catch)
            break;
        case 'recover':
            //  echo "RECOVER DETECTE";
            // trois elements a comparer avant d'inserer  le nouvel element
            // le mail est valide et existe dans la base de donnée
            // le captcha generer par le fichier image.php correspond au captcha saisie dans le formulaire
            // les 2 passwords correspondent
            if (!empty($email_user) && filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
                try {
                    $reqExistence = "SELECT email_user,id FROM user WHERE email_user=:email_user";
                    $stmt = $pdo->getPDO()->prepare($reqExistence);
                    $stmt->bindValue(":email_user", $email_user, PDO::PARAM_STR);
                    $resultat = $stmt->execute();
                    $element = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($stmt->rowCount() > 0) {
                        $stmt->closeCursor();
                        if (valid_identical_element($password, $passwordVerify)) {
                            //if (valid_identical_element(intval($captcha), $_SESSION["captcha"])) {
                            if (valid_identical_element(intval($captcha), $GLOBALS["captcha"])) {
                                // tout est bon -> on inserse le nouveau password
                                try {
                                    // on supprime la variable captcha;
                                    // unset($_SESSION["captcha"]);
                                    unset($GLOBALS["captcha"]);
                                    // on crypte le password;
                                    $password = password_hash($password, PASSWORD_DEFAULT);
                                    $reqUpdate = "UPDATE user SET password=:password WHERE email_user = :email_user";
                                    $stmt = $pdo->getPDO()->prepare($reqUpdate);
                                    $stmt->bindValue(":email_user", $email_user, PDO::PARAM_STR);
                                    $stmt->bindValue(":password", $password, PDO::PARAM_STR);
                                    $resultat = $stmt->execute();
                                    $stmt->closeCursor();
                                    echo json_encode($recover = $element['id']);
                                } catch (\Throwable $th) {
                                    echo "ERREUR D'UPDATE DANS LA BD";
                                }
                            } else {
                                echo "ERREUR DE CAPTCHA";
                            }
                        } else {
                            echo "ERREUR : LES PASSWORDS NE SONT PAS IDENTIQUES";
                        }
                    } else {
                        $stmt->closeCursor();
                    }
                } catch (\Throwable $th) {
                    echo "ERREUR EMAIL NON REFERENCE";
                }
            } else {
                echo "probleme d'email";
            }
            break;
        case 'user':
            //var_dump("CREATE USER detecté");
            // attention avant d'inserer on vérifie que le couple n'existe pas {1->login 1->password} {1->0}
            // donc on cherche seulement si login existe dejà
            if (!empty($email_user) && filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
                try {
                    $reqExistence = "SELECT email_user FROM user WHERE email_user=:email_user";
                    $stmt = $pdo->getPDO()->prepare($reqExistence);
                    $stmt->bindValue(":email_user", $email_user, PDO::PARAM_STR);
                    $resultat = $stmt->execute();
                    $element = $stmt->fetch(PDO::FETCH_ASSOC);
                    //var_dump($stmt->rowCount());
                    if ($stmt->rowCount() > 0) {
                        // on a resultat dans la bd donc 
                        // on renvoie le message d'erreur false au front
                        echo json_encode($connexion=false);
                        $stmt->closeCursor();
                    } else {
                        $stmt->closeCursor();
                        //on prepare les variables
                        try {
                            $reqInsert = "INSERT INTO user (email_user,password) VALUES(:email_user,:password)";
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $stmt = $pdo->getPDO()->prepare($reqInsert);
                            $stmt->bindValue(":email_user", $email_user, PDO::PARAM_STR);
                            $stmt->bindValue(":password", $password, PDO::PARAM_STR);
                            $resultat = $stmt->execute();
                            $user_id= $resultat->lastInsertId();
                            if ($stmt->rowcount()>0) {
                                echo json_encode($connexion=$user_id);
                            }else{
                                echo json_encode($connexion=false);
                            }
                            $stmt->closeCursor();
                            
                        } catch (\Throwable $th) {
                            echo "ERREUR D'INSERTION";
                        }
                    }
                } catch (\Throwable $th) {
                    echo "PROBLEME DANS LA CREATION EN BD";
                }
            } else {
                echo "PROBLEME D'EMAIL";
            }
            break;
        case 'connexion':
            //var_dump("CONNEXION USER detecté");
            try {
                $reqExistence = "SELECT id,email_user,password FROM user WHERE email_user=:email_user";
                $stmt = $pdo->getPDO()->prepare($reqExistence);
                $stmt->bindValue(":email_user", $email_user, PDO::PARAM_STR);
                $resultat = $stmt->execute();
                $element = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($stmt->rowCount() > 0) {
                    // on compare les elements
                    if ($email_user == $element['email_user']) {
                        if (password_verify($password, $element['password'])) {
                            // les mots de pass coincide -> on renvoie la connexion à vrai
                            echo json_encode($connexion = $element['id']);
                        } else {
                            // erreur sur le mot de pass -> on renvoie la connexion à faux 
                            echo json_encode($connexion = "defaumdp");
                        }
                    } else {
                        //erreur le login n'existe pas-> on renvoie la connexion à faux
                        echo json_encode($connexion = "defautlogin");
                    }
                } else {
                    // element non trouve-> en renvoie la connexion à false
                    echo json_encode($connexion = "defaut inexistant");
                }
            } catch (\Throwable $th) {
                echo "ERREUR DE CONNEXION";
            }
            break;
        default:
            var_dump('ERREUR DE CLE');
            break;
    }
}