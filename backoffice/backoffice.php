<?php
session_start();
include "../connect.php";
// if (isset($_POST['title_search'])) {
//   $title = $_POST['title_search'];
//   $sql = "SELECT * FROM ouvrage WHERE titre LIKE";
// }
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

        <p style="font-size: 13; font-family: 'Dancing Script', cursive;">BOOK lovers</p>
      </div>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="backoffice.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Tables.php">Tables</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="archive.php">archive</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="d-flex justify-content-center mt-5">
    <form method="post" class="search">
      <div class="row g-3 align-items-center rounded pb-3 fs-5 px-3 fw-bold">
        <div class="col-auto">
          <label for="type" class="col-form-label">Type</label>
        </div>
        <div class="col-auto">
          <select type="select" id="type" class="form-select" name="type" aria-describedby="passwordHelpInline">
            <option value=""></option>

            <?php
            for ($i = 0; $i < count($types); $i++) {
              $type = $types[$i]['type'];
              echo "<option value='$type'>$type</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <label for="State" class="col-form-label">State</label>
        </div>
        <div class="col-auto">
          <select type="select" id="State" name="State" class="form-select" aria-describedby="passwordHelpInline">
            <option value=""></option>
            <?php
            for ($i = 0; $i < count($states); $i++) {
              $state = $states[$i]['l_etat'];
              echo "<option value='$state'>$state</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-auto">
          <label for="title" class="col-form-label">Title</label>
        </div>
        <div class="col-auto">
          <input type="select" id="title" name="title" class="form-control" aria-describedby="passwordHelpInline">
        </div>
        <div class="col-auto">
          <button type="submit" name="search" value="Search" class="btn btn-primary"
            aria-describedby="submit">Search</button>
        </div>
      </div>
    </form>
  </section>
  <main>
    <?php
    if (isset($_POST['search'])) {
      ?>
      <section class="px-5 mt-5">
        <div class="px-5">
          <div class="h3 fw-bold pb-2 mb-4 text-dark  border-dark">
            Your search result
          </div>
          <div class="d-flex flex-wrap" style="gap: 3em;">
            <?php
            foreach ($result as $book) {
              ?>
              <div class="flip-card">
                <div class="flip-card-inner">
                  <div class="flip-card-front">
                    <img src="../<?php echo $book['l_mage_de_couverture'] ?>" alt="book-cover"
                      style="width:310px;height:400px;">
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
                    <form id="reserve" method="post">
                      <input type="hidden" name="id" value="<?php echo $book['Id_ouvrage'] ?>">
                      <button type="submit" name="Reserve" class="reservation px-4 py-2"
                        data-bookid="<?php echo $book['Id_ouvrage'] ?>">Edite</button>
                    </form>
                    <form action="delete.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $book['Id_ouvrage'] ?>">
                      <button type="submit" class="btn btn-danger mt-2">Delete</button>
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
      <?php
    } else {

      ?>
      <section class="px-5 mt-5">
        <div class="px-5">
          <div class="h3 fw-bold pb-2 mb-4 text-dark border-bottom border-3 border-dark">
            Gallerie
          </div>
          <div class="d-flex flex-wrap" style="gap: 3em;">
            <?php
            foreach ($books as $book) {
              ?>
              <div class="flip-card">

                <div class="flip-card-inner">
                  <div class="flip-card-front">
                    <img src="../<?php echo $book['l_mage_de_couverture'] ?>" alt="book-cover"
                      style="width:310px;height:400px;">
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
                    <form id="reserve" method="post">
                      <input type="hidden" name="id" value="<?php echo $book['Id_ouvrage'] ?>">
                      <button type="submit" name="Reserve" class="reservation px-4 py-2"
                        data-bookid="<?php echo $book['Id_ouvrage'] ?>">Edite</button>
                    </form>
                    <form action="delete.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $book['Id_ouvrage'] ?>">
                      <button type="submit" class="btn btn-danger mt-2">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
              <?php
            }
    }
    ?>
        </div>
      </div>
    </section>
    <?php if ($_SERVER["REQUEST_METHOD"] == "GET") { ?>
      <nav class="mt-5 mb-5 " aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?php for ($i = 1; $i <= $pagesNum; $i++) { ?>
            <li class="page-item"><a class="page-link" href="<?php echo "backoffice.php?pageId=" . $i ?>"><?php echo $i; ?></a>
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
                <p class="text-danger">NB* : every reservation last for 24H </p>
              </div>
              <div class="col-md-8">
                <form action="edit.php" method="get">
                  <div class="card-body p-5">

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
  <script>
    $(document).on('click', '.reservation', function () {
      event.preventDefault();
      var bookid = $(this).data('bookid');
      $.ajax({
        url: 'process.php',
        type: 'POST',
        data: { id: bookid },
        dataType: 'json',
        success: function (response) {
          $('#modal .card-body').html(response.details);
          $('#modal #book-image').attr('src', response.image);
          $('#modal #input').val(response.input);
          $('#modal').modal('show');
        },
        error: function (xhr, status, error) {
          console.log('Error:', error);
        }
      });
    });
  </script>
</body>

</html>