<?php 
if ($_SERVER['REQUEST_METHOD']=='POST'){
extract($_POST);
var_dump($_POST);
var_dump("----------------");
var_dump($_FILES);
$fileTarget = file_get_contents('http://localhost/ionicserver/upload/update.php', false, $context);}
?>