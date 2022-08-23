<?php
include('test.php');
$propriete="age";
$element = new Utilisateur;
$element->__set($propriete,5);
$element->__set("user_name","bob");
$element->__get($propriete);
$element->__get($user_name);
var_dump($element);
$aKid= new Kid;
var_dump("exemple avec enfant");
var_dump($aKid);
$akid->age="fdgsfdqhs";
var_dump($akid);
echo $aKid->age;