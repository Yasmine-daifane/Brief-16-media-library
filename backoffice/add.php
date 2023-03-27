<?php
include "../connect.php";
$title = $_GET['title'];
$author = $_GET['author'];
$image = $_GET['image'];
$state = $_GET['state'];
$publishing_date = $_GET['publishing_date'];
$date_of_purchase = 'NOW()';
$pages = $_GET['pages'];
$type = $_GET['type'];

$sql = "INSERT INTO `ouvrage` (`titre`, `nom_de_l_auteur`, `l_mage_de_couverture`, `l_etat`, `type`, `date_d_achat`, `la_date_d_édition`, `N_pages`) 
VALUES ('$title','$author', 'images/$image', '$state', '$type', '$publishing_date', $date_of_purchase, '$pages')";

$conn->exec($sql);
header('Location: Borrowing.php');
?>