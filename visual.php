<?php
include('test.php');
include("models/Database.php");
$pdo = new Database;
$data=["status"=>false,"description"=>"fer de lance","date"=>"2022-08-02","location"=>"paris","firstname"=>"","lastname"=>"","email"=>""];

$element = new Found;
var_dump($data);
$element->status=false; 
$element->description="objet perdu";
$element->date="2022-08-22";
$element->location="Paris";
$element->firstname="tenor";
$element->lastname="aigu";
$element->email="bonjour@gmail.com";
//echo $element->title;

$req = "INSERT INTO foundlost (status,description,date,location,firstname,lastname,email) values (:status,:description,:date,:location,:firstname,:lastname,:email)";
$stmt = $pdo->getPDO()->prepare($req);
foreach ($data as $key=>$valeur){
    var_dump($key);
$stmt->bindValue(":$key", $element->$key, $element->getTypeToPDO($valeur));
}
var_dump($stmt);
var_dump($element);
$stmt->execute();
echo "<hr>";
