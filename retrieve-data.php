<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
// TODO : Définir les paramètres de connexion
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
            $resultatValue=$stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($resultatValue);
            $stmt->closeCursor();
            if($resultat > 0){ 
               $pdo->getPDO();
             }
        } catch (\Throwable $th) {
            //throw $th;
        }
        # code...
            break;
        case 'lost':
            # code...
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
                $req = "SELECT * FROM foundlost WHERE id_object=$key";
                $stmt = $pdo->getPDO()->prepare($req);
                // $stmt->bindValue(":id",$key,PDO::PARAM_INT);
                $resultat = $stmt->execute();
                //$tab=[array("description"=>"bateau","date"=>"2022-11-25","location"=>"Paris")];
                $resultatValue=$stmt->fetchAll(PDO::FETCH_ASSOC);
                 echo json_encode($resultatValue);
                // echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
                $stmt->closeCursor();
                if($resultat > 0){ 
                   $pdo->getPDO();
                 }
            } catch (\Throwable $th) {
                //throw $th;
            }                 break;   
        default:
        var_dump("ERREUR D ACCES");
        break;
        }
    
}
// TODO : Prépare et exécute la requête de lecture de la table (try/catch)
?>