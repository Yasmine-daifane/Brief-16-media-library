<?php
session_start();
require "../connect.php";
$id_member = $_SESSION['Id_adhérent'];

$reservation = "SELECT * FROM reservation WHERE Id_adhérent = '$id_member'";
$result_reservation = $conn->query($reservation);
$my_reservation = $result_reservation->fetchAll(PDO::FETCH_ASSOC);

$loan = "SELECT * FROM l_emprunt WHERE Id_adhérent = '$id_member'";
$result_l_emprunt = $conn->query($loan);
$my_emprunt = $result_l_emprunt->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEBLIOTECAIRE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="cards.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div>
                <p style="font-size: 13;">BOOK lovers</p>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Tables.php">my reservation &emprunt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="px-5 mt-5">
        <div class="px-5">
            <div class="h3 fw-bold pb-2 mb-4 text-dark  border-dark">
                My current reservation
            </div>
            <div class="d-flex flex-wrap" style="gap: 3em;">
                <?php
                if (count($my_reservation) > 0) {
                    foreach ($my_reservation as $book) {
                        $id_book = $book['Id_ouvrage'];
                        $id_memebr = $book['Id_adhérent'];
                        $date = $book['date_de_reservation'];
                        $id_reservation = $book['Id_reservation'];


                        $user_nikename = "SELECT nickname FROM adhérent WHERE Id_adhérent = '$id_memebr'";
                        $nikename = $conn->query($user_nikename);
                        $nikename = $nikename->Fetch(PDO::FETCH_ASSOC);

                        $book = "SELECT * FROM ouvrage WHERE Id_ouvrage = '$id_book'";
                        $book = $conn->query($book);
                        $resulte = $book->Fetch(PDO::FETCH_ASSOC);

                ?>
                        <div class="card" style="width: 18rem;">
                            <img src="../<?php echo $resulte['l_mage_de_couverture'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $resulte['titre'] ?>
                                </h5>
                                <p class="card-text">
                                    reserved in:
                                    <?php echo $date ?>
                                </p>
                                <p class="text-center text-danger">
                                    <?php
                                    $date = strtotime("+24 hours"); // set the loan expiry time to 24 hours from now
                                    $current_time = time(); // get the current time
                                    $time_left_seconds = $date - $current_time; // calculate the time left in seconds

                                    if ($time_left_seconds <= 0) { 
                                        echo "Your loan application has expired."; // if the time has already expired, display an error message
                                    } else {
                                        $hours_left = floor($time_left_seconds / 3600); // calculate the number of hours left
                                        $minutes_left = floor(($time_left_seconds % 3600) / 60); // calculate the number of minutes left
                                        $seconds_left = $time_left_seconds % 60; // calculate the number of seconds left

                                        echo "You have " . $hours_left . " hours, " . $minutes_left . " minutes, and " . $seconds_left . " seconds left to complete your emprunt application."; // display the remaining time
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
    </section>
    <section class="px-5 mt-5 mb-5">
        <div class="px-5">
            <div class="h3 fw-bold pb-2 mb-4 text-dark  border-dark">
                My current emprunt
            </div>
            <div class="d-flex flex-wrap" style="gap: 3em;">
                <?php
                if (count($my_emprunt) > 0) {
                    foreach ($my_emprunt as $book) {
                        $id_book = $book['Id_ouvrage'];
                        $id_memebr = $book['Id_adhérent'];
                        $id_reservation = $book['Id_reservation'];


                        $user_nikename = "SELECT nickname FROM adhérent WHERE Id_adhérent = '$id_memebr'";
                        $nikename = $conn->query($user_nikename);
                        $nikename = $nikename->Fetch(PDO::FETCH_ASSOC);

                        $book = "SELECT * FROM ouvrage WHERE Id_ouvrage = '$id_book'";
                        $book = $conn->query($book);
                        $resulte = $book->Fetch(PDO::FETCH_ASSOC);

                ?>
                        <div class="card" style="width: 18rem;">
                            <img src="../<?php echo $resulte['l_mage_de_couverture'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $resulte['titre'] ?>
                                </h5>
                               
                                <p class="card-text">
                                    emprunt in:
                                </p>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
    </section>

</body>

</html>