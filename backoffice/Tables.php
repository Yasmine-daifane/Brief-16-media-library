<?php
session_start();
include "../connect.php";

// $reservation = "SELECT * FROM reservation WHERE reservation_date = NOW()";

if (isset($_POST['search'])) {
    $search_param = array();
    if (!empty($_POST['title'])) {
        $title = "title = '{$_POST['title']}'";
        $book_title = "SELECT Id_book FROM books WHERE $title";
        $id_book = $conn->query($book_title);
        $id_book = $id_book->fetch(PDO::FETCH_ASSOC);
        $id_book = $id_book['Id_book'];
        $search_param[] = "Id_book = '$id_book'";
    }
    if (!empty($_POST['nikename'])) {
        $nickname = "nickname = '{$_POST['nikename']}'";
        $nickname = "SELECT id_member FROM members WHERE $nickname";
        $id_member = $conn->query($nickname);
        $id_member = $id_member->fetch(PDO::FETCH_ASSOC);
        $id_member = $id_member['id_member'];
        $search_param[] = "id_member = '$id_member'";
    }



    $filter = "SELECT * FROM reservation";
    if (!empty($search_param)) {
        if (count($search_param) == 1) {
            $filter .= " WHERE " . implode($search_param);
        } else {
            $filter .= " WHERE " . implode(" AND ", $search_param);
        }
    }
    $filter = $conn->query($filter);
    $result = $filter->fetchAll(PDO::FETCH_ASSOC);
} else {
    $pageId;

    if (isset($_GET['pageId'])) {
        $pageId = $_GET['pageId'];
    } else {
        $pageId = 1;
    }

    $endIndex = $pageId * 8;
    $StartIndex = $endIndex - 8;

    $sql = ("SELECT * FROM `reservation` LIMIT 8 OFFSET $StartIndex");

    $page = 'SELECT * FROM reservation';

    $reservation_lentgh = $conn->query($page)->rowCount();

    $pagesNum = 0;

    if (($reservation_lentgh % 8) == 0) {

        $pagesNum = $reservation_lentgh / 8;
    } else {
        $pagesNum = ceil($reservation_lentgh / 8);
    }

    $result_reservation = $conn->query($sql);
    $reservation = $result_reservation->fetchAll(PDO::FETCH_ASSOC);
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEBLIOTECAIRE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="backoffic.css">
    <link rel="stylesheet" href="cards.css">
    <link rel="stylesheet" href="style.css">
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div>
                <p style="font-size: 13;">BOOK lovers</p>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="backoffice.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Tables.php">Tables</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="d-flex justify-content-center mt-5">
        <form method="post" class="search">
            <div class="row g-3 align-items-center border border-secondary border-1 rounded pb-3 fs-5 px-3 fw-bold">

                <div class="col-auto">
                    <label for="title" class="col-form-label">Title</label>
                </div>
                <div class="col-auto">
                    <input id="title" name="title" class="form-control">
                </div>
                <div class="col-auto">
                    <label for="nickname" class="col-form-label">User Nickname</label>
                </div>
                <div class="col-auto">
                    <input id="nickname" name="nickname" class="form-control">
                </div>
                <div class="col-auto">
                    <button type="submit" name="search" value="Search" class="btn btn-primary"
                        aria-describedby="submit">Search</button>
                </div>
            </div>
        </form>
    </section>
    <?php
    if (isset($_POST['search'])) {
        ?>
        <section class="px-5 mt-5">
            <div class="px-5">
                <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-3 border-dark">
                    Search result
                </div>
                <div>
                    <?php
                    if (count($reservation) > 0) {
                        foreach ($reservation as $book) {
                            $id_book = $book['Id_ouvrage'];
                            $id_memebr = $book['Id_adhérent'];
                            $date = $book['reservation_date'];
                            $id_reservation = $book['Id_reservation'];

                            $user_nikename = "SELECT nickname FROM adhérent WHERE Id_adhérent = '$id_memebr'";
                            $nikename = $conn->query($user_nikename);
                            $nikename = $nikename->Fetch(PDO::FETCH_ASSOC);

                            $book = "SELECT * FROM ouvrage WHERE Id_ouvrage = '$id_book'";
                            $book = $conn->query($book);
                            $resulte = $book->Fetch(PDO::FETCH_ASSOC);

                            ?>

                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                        the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                </section>
                <?php
                        }
                    }
    } else {
        ?>
        <section class="px-5 mt-5">
            <div class="px-5">
                <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-3 border-dark">
                    Today reservation
                </div>
                <div>
                    <?php
                    if (count($reservation) > 0) {
                        foreach ($reservation as $book) {
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
                                    <h5 class="card-title"><?php echo $resulte['titre'] ?></h5>
                                    <p class="card-text">
                                        reserved by: 
                                        <?php echo $nikename['nickname'] ?>
                                    </p>
                                    <a href="#" class="btn btn-succecs">Valide</a>
                                </div>
                            </div>
                        </div>
                </section>
                <?php
                        }
                    }
    } ?>
    <?php if ($_SERVER["REQUEST_METHOD"] == "GET") { ?>
        <nav class="mt-5 mb-5 " aria-label="Page navigation example">
            <ul class=" flex-wrap pagination justify-content-center">
                <?php for ($i = 1; $i <= $pagesNum; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="<?php echo "admin.php?pageId=" . $i ?>"><?php echo $i; ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    <?php }
    ?>
</body>