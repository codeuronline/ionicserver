<?php
define("URL", str_replace("manage-data.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: Content-Type');

// s'assure qu'il n'y a pas d'injection sql
function valid_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// s'assure que la date est on bon format
function is_date_valid($date, $format = "Y-m-d")
{
    $parsed_date = date_parse_from_format($format, $date);
    if (!$parsed_date['error_count'] && !$parsed_date['warning_count']) {
        return true;
    }

    return false;
}
// TODO : Définir les paramètres de connexion à la base
require_once 'models/Database.php';

// TODO : Créer une instance de la classe PDO
$pdo = new Database;
$pdo->getPDO();
// var_dump("Instance PDO crée");
// Récupérer le paramètre d’action de l’URL du client depuis $_GET[‘key’] 
// et nettoyer la valeur
extract($_GET);
if (isset($key)) {
    $key = strip_tags($key);
}
if (isset($id_task)) {
    $id_task = strip_tags($id_task);
}
var_dump("key", $key);
// Récupérer les paramètres envoyés par le client vers l’API
$input = file_get_contents('php://input');;
// $input = '{"description":"voiture","status":0,"date":"2022-07-11","location":"Paris","firstname":"theodore","lastname":"Mozelle","email":"yugielf@gmail.com"}';
if (!empty($input) || ($key == 'delete')) {
    $data = json_decode($input, true);
    if ($key != 'delete') {
        if ($key == "connexion" || $key == "user") {
            $email_user = strip_tags(valid_data($data['email_user']));
            $password = strip_tags(valid_data($data['password']));
        } else {
            
            var_dump($data);
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
    }

    // En fonction du mode d’action requis
    switch ($key) {
            //Ajoute un nouvel enregistrement
        case "create":
            var_dump("CREATE DETECTE");
            // TODO : Filtrer les valeurs entrantes
            if (!empty($description)) {
                var_dump(filter_var($status, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE));
                if (filter_var($status, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) !== null) {
                    if (is_date_valid($date)) {
                        if (!empty($location)) {
                            if (!empty($firstname)) {
                                if (!empty($lastname)) {
                                    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        try {
                                            // TODO : Préparer la requête dans un try/catch
                                            $req = "INSERT INTO 
                                            foundlost (description,status,date,location,firstname,lastname,email) 
                                            values (:description,:status,:date,:location,:firstname,:lastname,:email)";
                                            $stmt = $pdo->getPDO()->prepare($req);
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
                                                var_dump("INSERTION PRODUCT IN BD");
                                                $pdo->getPDO();
                                            }
                                        } catch (\Throwable $th) {
                                            echo $th;
                                            //throw $th;
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
            var_dump("UPDATE DETECTE");
            if (isset(($_GET["id_task"]))) {
                $id_task = strip_tags($data['id_object']);
                $id_task = intval($id_task);
                if (!empty($description)) {
                    $status = boolval($status);
                    if (($status == 0) || ($status == 1) || ($status == false) || ($status = true)) {
                        var_dump('status', $status);
                        $status = ($status == true) ? 1 : 0;
                        if (is_date_valid($date)) {
                            if (!empty($location)) {
                                if (!empty($firstname)) {
                                    if (!empty($lastname)) {
                                        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                            // TODO : Préparer la requête dans un try/catch    //pb au changement de status
                                            var_dump('email', $email);
                                            if ($data['filename'] != null) {
                                                if (isset($data['checkedpicture'])) {
                                                    var_dump('FileName detected');
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
                                                                    var_dump("SUPPRESSION de l'image"); # code...
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
                                                            var_dump("MODIFICATION PRODUCT IN BD AVEC INSERTION D IMAGE");
                                                            $pdo->getPDO();
                                                        }
                                                    } catch (\Throwable $th) {
                                                        var_dump($th);
                                                        //throw $th;
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
                                                    var_dump($th);
                                                    //throw $th;
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
            var_dump("DELETE DETECTE");
            // TODO : Nettoyer les valeurs de l’URL client (id_task)
            if (isset(($_GET["id_task"]))) {
                var_dump($id_task);
                /**on vérifie s'il n'existe pas une trace d'un enregistrement précédent */
                $reqExistence = "SELECT filename FROM foundlost WHERE id_object=$id_task";
                $stmt = $pdo->getPDO()->prepare($reqExistence);
                //$stmt->bindValue(":id_task", $id_task, PDO::PARAM_INT);
                $resultat = $stmt->execute();
                $element = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                if ($element['filename'] != null) {
                    unlink("upload/" . $element['filename']);
                    var_dump("SUPPRESSION de l'image");
                }
                $pdo->getPDO();
                // TODO : Préparer la requête dans un try/catch
                $req = "DELETE FROM foundlost WHERE id_object=$id_task";
                $stmt = $pdo->getPDO()->prepare($req);
                //$stmt->bindValue(":id_task", $id_task, PDO::PARAM_INT);
                $resultat1 = $stmt->execute();    //code...
                $stmt->closeCursor();
                if ($resultat1 > 0) {
                    var_dump("SUPPRESSION PRODUCT IN BD");
                    $pdo->getPDO();
                }
            }
            // TODO : Préparer et exécuter la requête (dans un try/catch)
            break;
        case 'user':
            var_dump("CREATE USER detecté");
            // attention avant d'inserer on vérifie que le couple n'existe pas {1->login 1->password} {1->0}
            // donc on cherche seulement si login existe dejà
            if (!empty($email_user) && filter_var($email_user, FILTER_VALIDATE_EMAIL)) {
                try {
                    $reqExistence = "SELECT email_user FROM user WHERE email_user='$email_user'";
                    $stmt = $pdo->getPDO()->prepare($reqExistence);
                    $resultat = $stmt->execute();
                    $element = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ( $stmt->rowCount() > 0) {
                        echo json_encode($create = false);
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
                            $stmt->closeCursor();
                            echo json_encode($create = true);
                        } catch (\Throwable $th) {
                            echo "ERREUR d'INSERTION";
                        }
                    }
                } catch (\Throwable $th) {
                    echo "PROBLEME SUR LA REQUETE";
                }
            } else {
                echo "Probleme email";
            }

            break;
        case 'connexion':
            var_dump("CONNEXION USER detecté");
            try {
                $reqExistence = "SELECT email_user,password FROM user WHERE email_user='$email_user'";
                $stmt = $pdo->getPDO()->prepare($reqExistence);
                $resultat = $stmt->execute();
                $element = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($email_user == $element['email_user']) {
                    if (password_verify($password, $element['password'])) {
                        // les mots de pass coincide -> on renvoie la connexion à vrai
                        echo json_encode($connexion = true);
                    } else {
                        // erreur sur le mot de pass -> on renvoie la connexion à faux 
                        echo json_encode($connexion = false);
                    }
                } else {
                    //errreur le login n'existe pas-> nrenvoie la connexion à faux
                    echo json_encode($connexion = false);
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
    // fin switch
    // fin if