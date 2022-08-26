<?php
// TODO : Définir les paramètres de connexion
// accepte toute les requetes
header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: Content-Type');
require_once 'models/Database.php';
// TODO : Créer une instance de la classe PDO (connexion à la base)
$pdo = new Database;
extract($_GET);
$key = strip_tags($key);
if (isset($key) && !empty($key)) {
    switch ($key) {
        case 'found':
        try {
            //code...
            $req = "SELECT * FROM foundlost WHERE status=1 ORDER BY date DESC";
            $stmt = $pdo->getPDO()->prepare($req);
            $resultat = $stmt->execute();
            $resultatValue=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultatValue);
            $stmt->closeCursor();
            if($resultat > 0){ 
               $pdo->getPDO();
             }
        } catch (\Throwable $th) {
            //throw $th;
        }
        break;
        case 'lost':
                    try {
                // code...
                $req = "SELECT * FROM foundlost WHERE status=0 ORDER BY date DESC";
                $stmt = $pdo->getPDO()->prepare($req);
                $resultat = $stmt->execute();
                $resultatValue=$stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($resultatValue);
                $stmt->closeCursor();
                if($resultat > 0){ 
                   $pdo->getPDO();
                 }
            } catch (\Throwable $th) {
                //throw $th;
            }
            break;
         case is_int(intVal($key)):
            //var_dump("ID DETECTE");
            try {
                $key = intval($key);      
                $req = "SELECT * FROM foundlost WHERE id_object=:id";
                $stmt = $pdo->getPDO()->prepare($req);
                $stmt->bindValue(":id",$key,PDO::PARAM_INT);
                $resultat = $stmt->execute();
                $resultatValue=$stmt->fetchAll(PDO::FETCH_ASSOC);
                 echo json_encode($resultatValue);
                $stmt->closeCursor();
                if($resultat > 0){ 
                   $pdo->getPDO();
                 }
            } catch (\Throwable $th) {
                echo "ID non défini";
            }                 break;   
        default:
        var_dump("ERREUR D ACCES");
        break;
        }
    
}
// TODO : Prépare et exécute la requête de lecture de la table (try/catch)