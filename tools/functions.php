<?php 
// s'assure que le code est propre"
function valid_data($data): string
{
    $data = trim($data);            // Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
    $data = stripslashes($data);    // Supprime les antislashs d'une chaîne
    $data = htmlspecialchars($data);// Convertit les caractères spéciaux en entités HTML
    $data = strip_tags($data);      // Supprime les balises HTML et PHP d'une chaîne
    return $data;
}
// s'assure que la date est au bon format
function is_date_valid($date, $format = "Y-m-d")
{//renvoie un tableau contenant l'état d'application du format à date
    $parsed_date = date_parse_from_format($format, $date);
    // si error_count ou warning_count ne sont définis on renvoie true
    if (!$parsed_date['error_count'] && !$parsed_date['warning_count']) {
        return true;
    }

    return false;
}
//teste si 2 elements sont identiques 
function valid_identical_element($valeur_reference, $valeur_compare)
{
    return ($valeur_reference == $valeur_compare) ? true : false;
}
?>