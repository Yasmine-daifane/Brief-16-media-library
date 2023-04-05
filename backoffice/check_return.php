<?php
require "../connect.php";
$id_loan = $_POST['valid_loan'];
$id_member = $_POST['valid_member'];
// $id_member = 2;
// $id_loan = 1;
$return_loan = "UPDATE `l_emprunt` SET `la_date_du_retour` = NOW() WHERE `l_emprunt`.`Id_l_emprunt` = $id_loan";
$return_loan = $conn->query($return_loan);
$check_date = "SELECT * FROM l_emprunt WHERE `Id_l_emprunt` = $id_loan";
$check_date = $conn->query($check_date);
$check_date = $check_date->fetch(PDO::FETCH_ASSOC);
// echo "<pre>";
// var_dump($check_date);
// echo "</pre>";
$days = (strtotime($check_date['la_date_du_retour']) - strtotime($check_date['la_date_d_emprunt'])) / (60 * 60 * 24);
$interval = floor($days);
if ($interval > 15) {
    $penalty = "UPDATE `adhérent` SET `pénalité` = pénalité+1 WHERE `Id_adhérent` = $id_member";
    $penalty = $conn->query($penalty);
    $result = "SELECT pénalité FROM adhérent WHERE `Id_adhérent` = $id_member";
    $result = $conn->query($result);
    $result = $result->fetch(PDO::FETCH_ASSOC);
}
$Id_adhérent = $check_date['Id_adhérent'];
$Id_ouvrage = $check_date['Id_ouvrage'];
$Id_reservation = $check_date['Id_reservation'];
$archive = "INSERT INTO `archive`(`Id_archive`, `Id_reservation`, `Id_adhérent`, `Id_ouvrage`, `status`) VALUES ('','$Id_reservation','$Id_adhérent','$Id_ouvrage','archeved')";
$stmt = $conn->query($archive);
header('Location: Borrowing.php');
?>