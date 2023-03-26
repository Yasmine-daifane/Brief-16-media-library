<?php
require "../connect.php";
$id = $_POST['id'];
$delete = "DELETE FROM ouvrage WHERE Id_ouvrage = '$id'";
$stmt = $conn->query($delete);
header('Location: backoffice.php');
?>