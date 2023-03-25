

<?php
include "connect.php";


$json_file = file_get_contents('Books.json');
$books_array = json_decode($json_file, true);
foreach ($books_array as $book) {
    $title = $book['title'];
    $author = $book['auteur'];
    $image = $book['imageLink'];
    $state = $book['state'];
    $publishing_date = $book['year'];
    $pages = $book['pages'];
    $type = $book['type'];

    $sql = "INSERT INTO  `ouvrage` (`titre`, `nom_de_l_auteur`, `l_mage_de_couverture`, `l_etat`, `type`, `date_d_achat`, `la_date_d_édition`, `N_pages`) 
       VALUES ('$title', ' $author', '$image', '$state', '$type',NOW() , '$publishing_date','$pages')";

    $conn->exec($sql);}

$conn = null;


?>
