<?php
define("URL", str_replace("manage-data.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: Content-Type');

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
var_dump("Instance PDO crée");


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
$input = file_get_contents('php://input');
// $input = '{"description":"voiture","status":0,"date":"2022-07-11","location":"Paris","firstname":"theodore","lastname":"Mozelle","email":"yugielf@gmail.com"}';
if (!empty($input) || ($key == 'delete')) {
    if (($key) != 'delete') {
        $data = json_decode($input, true);
        $id_object =  strip_tags($data['id_object']);
        $description = strip_tags($data['description']);
        $status = strip_tags($data['status']);
        $date = strip_tags($data['date']);
        $location = strip_tags($data['location']);
        $firstname = strip_tags($data['firstname']);
        $lastname = strip_tags($data['lastname']);
        $email = strip_tags($data['email']);
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
                    if (($status == 0) || ($status == 1)) {
                        if (is_date_valid($date)) {
                            if (!empty($location)) {
                                if (!empty($firstname)) {
                                    if (!empty($lastname)) {
                                        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
                                            // TODO : Préparer la requête dans un try/catch    
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
                    //DATE - format YYYY-MM-DDilter_var($date,FILTER_V))
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
                // TODO : Préparer la requête dans un try/catch
                $req = "DELETE FROM foundlost WHERE id_object=$id_task";
                $stmt = $pdo->getPDO()->prepare($req);
                $stmt->bindValue(":id_task", $id_task, PDO::PARAM_INT);
                $resultat = $stmt->execute();    //code...
                $stmt->closeCursor();
                if($resultat>0){
                    var_dump("SUPPRESSION PRODUCT IN BD");
                    $pdo->getPDO();
                }
            }
            // TODO : Préparer et exécuter la requête (dans un try/catch)
            break;
        default:
            var_dump('ERREUR DE CLE');
            break;
    }
    // fin switch
    // fin if
}