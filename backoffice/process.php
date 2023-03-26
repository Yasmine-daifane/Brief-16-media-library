<?php
require "../connect.php";
// Get the item ID from the POST data
$item_id = $_POST['id'];
$stmt = $conn->prepare('SELECT * FROM `ouvrage` WHERE `Id_ouvrage` = :item_id');
$stmt->bindParam(':item_id', $item_id);
$stmt->execute();
// Retrieve the item details as an associative array
$reserve = $stmt->fetch(PDO::FETCH_ASSOC);
// Close the database connection
$conn = null;

// Check if the item was found in the database
if (!$reserve) {
    echo '<p>Item not found.</p>';
} else {

    $response = array(
        "details" => '<h5 class="card-title text-black">Book title : ' . $reserve['titre'] . '</h5>'
        . '<input class="card-text text-black" name="condition" value="' . $reserve['l_etat'] . '">'
        . '<p class="card-text text-black">Published in : ' . $reserve['la_date_d_édition'] . '</p>'
        . '<p class="card-text text-black">Number of pages : ' . $reserve['N_pages'] . '</p>'
        . '<p class="card-text text-black">Type : ' . $reserve['type'] . '</p>',
        "image" => '../' . $reserve['l_mage_de_couverture'],
        "input" => $reserve['Id_ouvrage']
    );

    // Encode the response as JSON and output it
    echo json_encode($response);
}
?>