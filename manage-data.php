<?php
define("URL", str_replace("manage-data.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

function is_date_valid($date, $format = "Y-m-d"){
    $parsed_date = date_parse_from_format($format, $date);
    if(!$parsed_date['error_count'] && !$parsed_date['warning_count']){
        return true;
    }

    return false;
}
// TODO : Définir les paramètres de connexion à la base
require_once 'models/Database.php';

// TODO : Créer une instance de la classe PDO
$pdo= new Database;
$pdo->getPDO();
var_dump("Instance PDO crée");


// Récupérer le paramètre d’action de l’URL du client depuis $_GET[‘key’] 
// et nettoyer la valeur
$key = strip_tags($_GET['key']);
var_dump("key",$key);

// Récupérer les paramètres envoyés par le client vers l’API
$input = file_get_contents('php://input');

if (!empty($input)) {
    $data = json_decode($input, true);

    $description = strip_tags($data['description']);
    $status = strip_tags($data['status']);
    $date = strip_tags($data['date']);
    $location = strip_tags($data['location']);
    $firstname = strip_tags($data['firstname']);
    $lastname = strip_tags($data['lastname']);
    $email = strip_tags($data['email']);

     // En fonction du mode d’action requis
    switch ($key) {
        //Ajoute un nouvel enregistrement
    case "create":
        
        // TODO : Filtrer les valeurs entrantes
        if (!empty($description)){
            if (filter_var($status,FILTER_VALIDATE_BOOLEAN,FILTER_NULL_ON_FAILURE)!=null) {
                if (is_date_valid($date)) {
                    if (!empty($location)) {
                        if (!empty($firstname)) {
                            if (!empty($lastname)) {
                                if (!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)) {
                                    # code...
                                }
                            }else {
                                var_dump("Problème sur Date: ",$lastname);
                            }
                        } else {
                            var_dump("Problème sur firstname: ",$firstname);
                        }
                    }else{
                        var_dump("Problème sur Localisation: ",$location);
                    }
                } else{
                    var_dump("Problème sur Date: ",$date);
                }
                //DATE - format YYYY-MM-DDilter_var($date,FILTER_V))
            }else{
                var_dump("Problème sur Status: ",$status);
            }
        }else{
            var_dump("Problème sur Description: ",$description);}
        
        // TODO : Préparer la requête dans un try/catch
        break;

        // Mettre à jour un enregistrement existant
    case "update":
        // TODO : Nettoyer les valeurs en provenant de l’URL client
        // TODO : Préparer et exécuter la requête (dans un try/catch)
        break;

        // Supprimer un enregistrement existant
    case "delete":
        // TODO : Nettoyer les valeurs de l’URL client (id_task)
        // TODO : Préparer et exécuter la requête (dans un try/catch)
        break;
   } // fin switch
} // fin if