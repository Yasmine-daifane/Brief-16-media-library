<?php
session_start();
include "../connect.php";

$type = "SELECT DISTINCT `type` FROM `ouvrage`";
$state = "SELECT DISTINCT `l_etat` FROM `ouvrage`";
$types = $conn->query($type);
$states = $conn->query($state);
$types = $types->fetchAll(PDO::FETCH_ASSOC);
$states = $states->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['search'])) {
    $search_param = array();
    if (!empty($_POST['type'])) {
        $search_param[] = "type = '{$_POST['type']}'";
    }
    if (!empty($_POST['State'])) {
        $search_param[] = "l_etat = '{$_POST['State']}'";
    }
    if (!empty($_POST['title'])) {
        $search_param[] = "titre LIKE '%{$_POST['title']}'";
    }

    // calculate the start index based on the current page number and the number of results per page
    $filter = "SELECT * FROM ouvrage";
    if (!empty($search_param)) {
        $filter .= " WHERE " . implode(" AND ", $search_param);
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

    $sql = ("SELECT * FROM `ouvrage` LIMIT 8 OFFSET $StartIndex");

    $page = 'SELECT * FROM ouvrage';

    $books_lentgh = $conn->query($page)->rowCount();

    $pagesNum = 0;

    if (($books_lentgh % 8) == 0) {

        $pagesNum = $books_lentgh / 8;
    } else {
        $pagesNum = ceil($books_lentgh / 8);
    }

    $books = $conn->query($sql);
    $books = $books->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($_GET['confirmation'])) {
    $id = $_GET['input'];
    // $id = 10;
    $id_member = $_SESSION['Id_adhérent'];
    // $check_reservation = "SELECT * FROM `reservation` loan WHERE id_member = '$id_member'";
    $check_member_reservation = "SELECT * FROM reservation WHERE reservation.Id_adhérent = '$id_member'";
    $check_member_loan = "SELECT * FROM l_emprunt WHERE l_emprunt.Id_adhérent = '$id_member'";

    $check_book_valability = "SELECT status FROM ouvrage WHERE ouvrage.Id_ouvrage = '$id'";

    $reservation = $conn->query($check_member_reservation);
    $loan = $conn->query($check_member_loan);
    $num_reservation = $reservation->rowCount();
    $num_loan = $loan->rowCount();
    $member_total = $num_reservation + $num_loan;
    $book_reservation = $conn->query($check_book_valability);
    $book_reservation = $book_reservation->fetch(PDO::FETCH_ASSOC);
    if ($member_total < 3 && $book_reservation['status'] == 'valable') {
        $sql = "INSERT INTO `reservation` (`Id_reservation`, `date_de_reservation`, `Id_ouvrage`, `Id_adhérent`) 
    VALUES (NULL, NOW(), '$id','$id_member')";
        $update = "UPDATE `ouvrage` SET `status` = 'not' WHERE `ouvrage`.`Id_ouvrage` = '$id'";
        $update = $conn->query($update);
        $stmt = $conn->query($sql);
        $success = "Thank you for your reservation request! We're happy to inform you that your booking has been tentatively reserved.  we kindly remind you that you have 24 hours to confirm this reservation before it expires.the next step is the loan process.";
        // header("Location: user.php");
    } elseif ($member_total >= 3) {
        $no_more = "Sorry but it's look like you have reache the maximume of books you can borrow and reserve";
        // header("Location: user.php");
    } elseif ($book_reservation['status'] != 'valable') {
        $book_is_reservred = "sorry but that book is alredy reserved";
        // header("Location: user.php");
    }
}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book lovers </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link rel="stylesheet" href="user.css">



</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div>

                <p style="font-size: 13;   font-family: 'Dancing Script', cursive;">BOOK lovers</p>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Tables.php">my reservation &emprunt</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-image d-flex align-items-center justify-content-center">
        <div class="container text-center">
            <p> Welcome to Book Lovers, where pages come to life!</p>
            <div class="col-md-9 d-flex justify-content-center justify-content-md-end">
                <form class="mt-3 mt-md-0 w-75">
                    <div class="input-group ">
                        <input type="search" class="form-control" placeholder=" you can Search by title,state,type" aria-label="Search">
                        <button class="btn " type="submit">Search </button>
                    </div>
                </form>
            </div>
        </div>
    </header>



    <?php
    if (isset($success)) {
    ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo $success ?>
        </div>
    <?php
    } elseif (isset($no_more)) {
    ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo $no_more ?>
        </div>
    <?php
    } elseif (isset($book_is_reservred)) {
    ?>
        <div class="alert alert-danger text-center" role="alert">
            <?php echo $book_is_reservred ?>
        </div>
    <?php
    }
    ?>
    <section class="px-5 mt-5">
        <div class="px-5">
            <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-3 border-dark">
              THE GALLERIE OF BOOKS 
            </div>
            <div class="d-flex flex-wrap" style="gap: 3em;">
                <?php
                foreach ($books as $book) {
                ?>
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="../<?php echo $book['l_mage_de_couverture'] ?>" alt="book-cover" style="width:310px;height:400px;">
                            </div>
                            <div class="flip-card-back">
                                <h2 class="mt-5 fs-4">
                                    <?php echo $book['titre'] ?>
                                </h2>
                                <p class="text-black">
                                    <?php echo $book['nom_de_l_auteur'] ?>
                                </p>
                                <p class="text-black">
                                    <?php echo $book['la_date_d_édition'] ?>
                                </p>
                                <p class="text-black">
                                    <?php echo $book['l_etat'] ?>
                                </p>

                                <p class="text-black">
                                    <?php echo $book['type'] ?>
                                </p>

                                <form id="reserve" method="post">
                                    <input type="hidden" name="id" value="<?php echo $book['Id_ouvrage'] ?>">
                                    <button type="submit" name="Reserve" class="reservation px-4 py-2" data-bookid="<?php echo $book['Id_ouvrage'] ?>">reserver</button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php
                }

                ?>
            </div>
        </div>
    </section>
    <?php if ($_SERVER["REQUEST_METHOD"] == "GET") { ?>
        <nav class="mt-5 mb-5 " aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $pagesNum; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="<?php echo "user.php?pageId=" . $i ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    <?php }
    ?>
    </main>
    <!-- modal reservations -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="reservation" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="" alt="book image" id="book-image" class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                                <form method="get">
                                    <p class="text-danger">NB* : every reservation last for 24H </p>
                                    <div class="card-body p-5">
                                       
                                    </div>
                                    <input type="hidden" id="input" name="input">
                                    <p class="text-warning"> if you're sure click to confirme the reservation u don't have the right to cancel it later !!</p>
                                    <button type="submit" name="confirmation" class="confirmation">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.reservation', function() {
            event.preventDefault();
            var bookid = $(this).data('bookid');
            $.ajax({
                url: 'process.php',
                type: 'POST',
                data: {
                    id: bookid
                },
                dataType: 'json',
                success: function(response) {
                    $('#modal .card-body').html(response.details);
                    $('#modal #book-image').attr('src', response.image);
                    $('#modal #input').val(response.input);
                    $('#modal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });
    </script>
</body>

</html>