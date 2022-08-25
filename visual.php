<?php
include('class.php');
var_dump("exemple avec utilisateur");
echo "<hr>";
echo "<hr>";

$propriete="age";
$element = new Utilisateur;

var_dump("assignation directe de la propriete age avec la valeur 50");
$element->age=50;
$element->addresse="ffdfdifhdihufdshfjdskjsdfhjfksd";
// affichage de l'objet
var_dump($element);

echo "<hr>";
var_dump("assignation directe de la propriété firstname avec la valeur bob");
$element->firstname="bob";
echo $element->firstname;
echo "<hr>";
var_dump($element)
;var_dump("modification directe de la propriété age avec la valeur 15");
$element->age=15;
// affichage de l'objet
var_dump($element);
var_dump("recuperation d'une propriete");
echo $element->lastname;
echo "<hr>";
echo "<hr>";
// autre exemple objet kid
$aKid= new Kid;
var_dump("exemple avec kid");
echo "<hr>";
var_dump("affichage d'objet kid ");
var_dump($aKid);
echo "<hr>";
$aKid->age="12";
var_dump("acces à la propriété age directement ");
echo $aKid->age;
var_dump($aKid);
echo "<hr>";
$aKid2=new Kid;
$aKid2->sexe="male";
var_dump($aKid2);
echo "<hr>";
$aKid2->__set("sexe","female");
$aKid2->__set("size",55);
$aKid2->age=55;
echo "<hr>";
var_dump($aKid2);
echo "<hr>";
var_dump("acces avec les methodes magiques");
echo $aKid2->__get("sexe")."//".$aKid2->__get("size")."<br>";
var_dump("acces directement a la prorpiete bien mais stocké dans un tableau private");
echo $aKid2->sexe."//".$aKid2->size."//".$aKid2->age."<br><hr>";

var_dump("autre exemple objet propertyTest");
echo "<pre>\n";

$obj = new PropertyTest;

$obj->a = 1;
echo $obj->a . "\n\n";

var_dump(isset($obj->a));
unset($obj->a);
var_dump(isset($obj->a));
echo "\n";

echo $obj->declared . "\n\n";

echo "Manipulons maintenant la propriété privée nommée 'hidden' :\n";
echo "'hidden' est visible depuis la classe, donc __get() n'est pas utilisée...\n";
echo $obj->getHidden() . "\n";
echo "'hidden' n'est pas visible en dehors de la classe, donc __get() est utilisée...\n";
echo $obj->hidden . "\n";