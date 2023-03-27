<?php
session_start();
include "../connect.php";

// $reservation = "SELECT * FROM reservation WHERE reservation_date = NOW()";

if (isset($_POST['search'])) {
    $search_param = array();
    if (!empty($_POST['title'])) {
        $title = "titre = '{$_POST['title']}'";
        $book_title = "SELECT Id_ouvrage FROM ouvrage WHERE $title";
        $id_book = $conn->query($book_title);
        $id_book = $id_book->fetch(PDO::FETCH_ASSOC);
        $id_book = $id_book['Id_ouvrage'];
        $search_param[] = "Id_ouvrage = '$id_book'";
    }
    if (!empty($_POST['nikename'])) {
        $nickname = "nickname = '{$_POST['nikename']}'";
        $nickname = "SELECT Id_adhérent FROM adhérent WHERE $nickname";
        $id_member = $conn->query($nickname);
        $id_member = $id_member->fetch(PDO::FETCH_ASSOC);
        $id_member = $id_member['Id_adhérent'];
        $search_param[] = "Id_adhérent = '$id_member'";
    }



    $filter = "SELECT * FROM l_emprunt";
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

    $sql = ("SELECT * FROM `l_emprunt` LIMIT 8 OFFSET $StartIndex");

    $page = 'SELECT * FROM l_emprunt';

    $reservation_lentgh = $conn->query($page)->rowCount();

    $pagesNum = 0;

    if (($reservation_lentgh % 8) == 0) {

        $pagesNum = $reservation_lentgh / 8;
    } else {
        $pagesNum = ceil($reservation_lentgh / 8);
    }

    $borrowing = $conn->query($sql);
    $borrowing = $borrowing->fetchAll(PDO::FETCH_ASSOC);
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
                        <a class="nav-link" href="Tables.php">reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Borrowing.php">Borrowing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#add-modal">add book</a>
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
                    if (count($result) > 0) {
                        foreach ($result as $book) {
                            $id_book = $book['Id_ouvrage'];
                            $id_memebr = $book['Id_adhérent'];
                            $id_reservation = $book['Id_reservation'];
                            $id_loan = $book['Id_l_emprunt'];

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
                                        reserved by:
                                        <?php echo $nikename['nickname'] ?>
                                    </p>
                                    <form action="check_return.php" method="post">
                                        <input type="hidden" value="<?php echo $id_loan ?>" name="valid_loan">
                                        <input type="hidden" value="<?php echo $id_memebr ?>" name="valid_member">
                                        <button class="btn btn-success" type="submit" name="valid_reservation">Returned</button>
                                    </form>
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
                    Borrowing
                </div>
                <div>
                    <?php
                    if (count($borrowing) > 0) {
                        foreach ($borrowing as $book) {
                            $id_book = $book['Id_ouvrage'];
                            $id_memebr = $book['Id_adhérent'];
                            $id_reservation = $book['Id_reservation'];
                            $id_loan = $book['Id_l_emprunt'];

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
                                        reserved by:
                                        <?php echo $nikename['nickname'] ?>
                                    </p>
                                    <form action="check_return.php" method="post">
                                        <input type="hidden" value="<?php echo $id_loan ?>" name="valid_loan">
                                        <input type="hidden" value="<?php echo $id_memebr ?>" name="valid_member">
                                        <button class="btn btn-success" type="submit" name="valid_reservation">Returned</button>
                                    </form>
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
    <!-- modal reservations -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="reservation" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="" alt="book image" id="book-image" class="img-fluid rounded-start">
                                <!-- <p class="text-danger">NB* : every reservation last for 24H </p> -->
                            </div>
                            <div class="col-md-8">
                                <form action="edit.php" method="get">
                                    <div class="card-body p-5">
                                        loading...
                                    </div>
                                    <input type="hidden" id="input" name="input">
                                    <button type="submit" name="confirmation" class="confirmation">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content text-center">
                <div class="modal-header text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="information">
                        <form action="add.php" method="get">
                            <div class="d-flex">
                                <div class="w-100 p-5">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">title</label>
                                        <input type="text" name="title" class="form-control" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">author</label>
                                        <input type="text" name="author" class="form-control" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">image</label>
                                        <input type="file" class="form-control" name="image" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">state</label>
                                        <input type="text" class="form-control" name="state" required="">
                                    </div>
                                </div>
                                <div class="w-100 p-5">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">publishing date</label>
                                        <input type="date" class="form-control" name="publishing_date" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">pages</label>
                                        <input type="number" class="form-control" name="pages" required="">
                                    </div>
                                    <div class=" mb-3">
                                        <label for="exampleInputEmail1" class="form-label">type</label>
                                        <input type="text" class="form-control" name="type" required="">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info" type="submit" name="update_prof">add book</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>