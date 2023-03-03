<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "media_library";

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$json_file = file_get_contents('Books.json');
$books_array = json_decode($json_file, true);
foreach ($books_array as $book) {
    $title = $book['title'];
    $author = $book['author'];
    $image = $book['imageLink'];
    $state = $book['state'];
    $publishing_date = $book['year'];
    $date_of_purchase = 'NOW()';
    $pages = $book['pages'];
    $type = $book['type'];

    $sql = "INSERT INTO `ouvrage` ( `titre`, `nom_de_l_auteur`, `l_mage_de_couverture`, `l_etat`, `type`, `date_d_achat`, `la_date_d_édition`, `N_pages`)
            VALUES ('$title', '$author', '$image', '$state', '$type',$date_of_purchase , '$publishing_date','$pages')";

    $conn->exec($sql);
}
$conn = null;
