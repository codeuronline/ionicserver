<?php 
session_start();
// if (!(isset($_SESSION['captcha']))){
    // on utilise la super  global car ionic ne permet pas d'utiliser la variable session
    // information la creation est possible dans la variable session 
    // mais dès qu'on l'appel elle est vide 
    $GLOBALS["captcha"]= random_int(10000,99999);
    error_log(print_r($GLOBALS, 1));
// }else {
//     $_SESSION["captcha"]= random_int(10000,99999);
//     error_log(print_r($_SESSION, 1));
//}
 //   $captcha=random_int(10000,99999);
    header("Content-type: image/jpeg");
    $image = @imagecreate(60, 25)
    or die("Impossible d'initialiser la bibliothèque GD");
    $black_color = imagecolorallocate($image, 0, 0, 0);
    $white_color = imagecolorallocate($image, 255, 255,255);
    //imagestring($image, 5, 10, 10,  $captcha, $white_color);
    imagestring($image, 5, 10, 10,  $GLOBALS["captcha"], $white_color);
    header('Content-type: image/jpeg');
    imagejpeg($image,null);
    ImageDestroy($image);