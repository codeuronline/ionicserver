<?php 
// s'assure que le code est propre"
function valid_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// s'assure que la date est au bon format
function is_date_valid($date, $format = "Y-m-d")
{
    $parsed_date = date_parse_from_format($format, $date);
    if (!$parsed_date['error_count'] && !$parsed_date['warning_count']) {
        return true;
    }

    return false;
}
//teste si 2 element sont identique 
function valid_identical_element($valeur_reference, $valeur_compare)
{
    return ($valeur_reference == $valeur_compare) ? true : false;
}
?>