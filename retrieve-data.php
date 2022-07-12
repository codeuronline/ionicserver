<?php
header('Access-Control-Allow-Origin: *');
// TODO : Définir les paramètres de connexion
require_once 'models/Database.php';
// TODO : Créer une instance de la classe PDO (connexion à la base)
$pdo = new Database;
$extract($_GET);
$key = strip_tags($key);
if (isset($key) && !empty($key)) {
    switch ($key) {
        case 'found':
        try {
            //code...
            $req = "SELECT * FROM foundlost WHERE status=1 ORDER date BY DESC";
            $stmt = $pdo->getPDO()->prepare($req);
            $resultat = $stmt->execute();
            var_dump(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
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
                $req = "SELECT * FROM foundlost WHERE status=0 ORDER BY DESC";
                $stmt = $pdo->getPDO()->prepare($req);
                $resultat = $stmt->execute();
                var_dump(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
                $stmt->closeCursor();
                if($resultat > 0){ 
                   $pdo->getPDO();
                 }
            } catch (\Throwable $th) {
                //throw $th;
            }
            break;
        default:
            var_dump("Mot clé invalide");
            break;
    }
        # code...
}
// TODO : Prépare et exécute la requête de lecture de la table (try/catch)
?>