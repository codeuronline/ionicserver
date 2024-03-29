<?php
// TODO : Définir les paramètres de connexion
// accepte toute les requetes
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
require_once 'models/Database.php';
require_once 'tools/functions.php';
// TODO : Créer une instance de la classe PDO (connexion à la base)
$pdo = new Database;
extract($_GET);
$key = valid_data(@$key);
if (isset($key) && !empty($key)) {
    switch ($key) {
        // recuperation des éléments trouvés
        case 'found':
        try {
            //code...
            $req = "SELECT id_object,status,description,date,location,firstname,lastname,email,checkedpicture,filename,user_id FROM foundlost WHERE status=1 ORDER BY date DESC";
            $stmt = $pdo->getPDO()->prepare($req);
            $resultat = $stmt->execute();
            $resultatValue=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultatValue);
            $stmt->closeCursor();
            if($resultat > 0){ 
               $pdo->getPDO();
             }
        } catch (\Throwable $th) {
            echo "PROBLEME  DE RECUPERATION DE LA LISTE DES OBJETS TROUVES";
        }
        break;
        // recupération des éléments perdus
        case 'lost':
            try {
                $req = "SELECT id_object,status,description,date,location,firstname,lastname,email,checkedpicture,filename,user_id FROM foundlost WHERE status=0 ORDER BY date DESC";
                $stmt = $pdo->getPDO()->prepare($req);
                $resultat = $stmt->execute();
                $resultatValue=$stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($resultatValue);
                $stmt->closeCursor();
                if($resultat > 0){ 
                   $pdo->getPDO();
                 }
            } catch (\Throwable $th) {
                echo "PROBLEME DE RECUPERATION DE LA LISTE DES OBJETS PERDUS";
                //throw $th;
            }
            break;
        // recupère l'élément numéro en vérifiant que son numéro est bien un entier     
        case is_int(intVal($key)):
            //var_dump("ID DETECTE");
            try {
                $key = intval($key);      
                $req = "SELECT id_object,status,description,date,location,firstname,lastname,email,checkedpicture,filename,user_id FROM foundlost WHERE id_object=:id";
                $stmt = $pdo->getPDO()->prepare($req);
                $stmt->bindValue(":id",$key,PDO::PARAM_INT);
                $resultat = $stmt->execute();
                $resultatValue=$stmt->fetchALL(PDO::FETCH_ASSOC);
                echo json_encode($resultatValue);
                $stmt->closeCursor();
                if($resultat > 0){ 
                   $pdo->getPDO();
                 }
            } catch (\Throwable $th) {
                echo "ID NON DEFINI";
            }                 
            break;   
        default:
        echo "COMMANDE NON RECONNUE";
        break;
        }
    
}else{echo "ERREUR D'ACCES";}
// TODO : Prépare et exécute la requête de lecture de la table (try/catch)