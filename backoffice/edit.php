<?php

require "../connect.php";
// Get the item ID from the POST data
$item_id = $_GET['input'];
$value = $_GET['condition'];
$stmt = $conn->query("UPDATE `ouvrage` SET `l_etat` = '$value' WHERE `Id_ouvrage` = $item_id");
$stmt->execute();
header('Location: backoffice.php');
?>