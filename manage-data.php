<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

// TODO : Définir les paramètres de connexion à la base

// TODO : Créer une instance de la classe PDO

// Récupérer le paramètre d’action de l’URL du client depuis $_GET[‘key’] 
// et nettoyer la valeur
$key = strip_tags($_GET['key']);

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