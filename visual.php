<?php
include('test.php');
var_dump("exemple avec utlisateur");
echo "<hr>";
$propriete="age";
$element = new Utilisateur;

var_dump("assignation avec la methode magique");
$element->__set($propriete,55);
echo "<hr>";

var_dump("assignation directe");
$element->age="52";
echo "<hr>";

var_dump("assignation avec la methode magique d'une propriete private");
$element->__set("user_name","bob");
echo "<hr>";
var_dump("recuperation d'une proporiete non définie par la methode magique");
$element->__get($propriete);
echo "<hr>";

var_dump("recuperation d'une propriete defini par la methode magique");
$element->__get("user_name");
echo "<hr>";
var_dump("affichage de l'objet");
var_dump($element);
echo "<hr>";

$aKid= new Kid;
var_dump("exemple avec kid");
echo "<hr>";
var_dump("affichage d'objet kid ");
var_dump($aKid);
echo "<hr>";
$aKid->age="12";
var_dump("acces à la variable directement");
echo $aKid->age;
var_dump($aKid);
echo "<hr>";
$aKid2=new Kid;
$aKid2->sexe="male";
var_dump($aKid2);
echo "<hr>";
$aKid2->__set("sexe","female");
$aKid2->__set("size",55);
echo "<hr>";
var_dump($aKid2);
echo "<hr>";
echo $aKid2->__get("sexe")."//".$aKid2->__get("size");