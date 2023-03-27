<?php
require "../connect.php";
$id_reservation = $_POST['valid_reseravtion'];
$id_member = $_POST['valid_member'];
$id_book = $_POST['valid_book'];
// $delete_reservation = "DELETE FROM reservation WHERE Id_reservation = '$id_reservation'";
// $deleted = $conn->query($delete_reservation);
$add_loan = "INSERT INTO `l_emprunt` (`Id_l_emprunt`, `la_date_d_emprunt`, `la_date_du_retour`, `Id_adhérent`, `Id_reservation`, `Id_ouvrage`) VALUES (NULL, NOW(), NULL, '$id_member', '$id_reservation', '$id_book')";
$loaned = $conn->query($add_loan);
header('Location: Tables.php');
?>