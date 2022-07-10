<?php
header('Access-Control-Allow-Origin: *');

// TODO : Définir les paramètres de connexion
require_once 'models/Database.php';
// TODO : Créer une instance de la classe PDO (connexion à la base)
$pdo = new Database;
extract($_GET);
if (isset($object)&&($object==true)) {

    try {
        //code...
        $req = "SELECT * FROM foundlost ";
        $stmt = $pdo->getPDO()->prepare($req);
        $resultat = $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        $stmt->closeCursor();
        if($resultat > 0){ 
           $pdo->getPDO();
         }
    } catch (\Throwable $th) {
        //throw $th;
    }    # code..
}else {
    var_dump("parametre non autorisé");
}
// TODO : Prépare et exécute la requête de lecture de la table (try/catch)

?>