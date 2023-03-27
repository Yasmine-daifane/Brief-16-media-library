<?php
session_start();
require "../connect.php";
$id_member = $_SESSION['Id_adhérent'];
$member = "SELECT * FROM adhérent WHERE Id_adhérent = '$id_member'";
$stmt = $conn->query($member);
$member = $stmt->Fetch(PDO::FETCH_ASSOC);
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEBLIOTECAIRE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <style>
        #information {
            font-weight: 300;
            font-size: 15px;
            line-height: 1.7;
            font-weight: bold;
            background-color: #9E8365;
            overflow-x: hidden;
        }

        .btn_log {
            border-radius: 4px;
            height: 44px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
            padding: 0 30px;
            letter-spacing: 1px;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-align-items: center;
            -moz-align-items: center;
            -ms-align-items: center;
            align-items: center;
            -webkit-justify-content: center;
            -moz-justify-content: center;
            -ms-justify-content: center;
            justify-content: center;
            -ms-flex-pack: center;
            text-align: center;
            border: none;
            background-color: #ff0000;
            color: #ffffff;
            box-shadow: 0 8px 24px 0 rgba(252, 95, 95, 0.2);
        }

        .btn_log:active,
        .btn_log:focus {
            background-color: #bd5757;
            color: #ffeba7;
            box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
        }

        .btn_log:hover {
            background-color: #b34949;
            color: #ffeba7;
            box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
        }
    </style>
    <header>
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
                            <a class="nav-link" href="Tables.php">Tables</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="text-center">
        <h4 class="fs-1 mt-5 mb-5">Personal information</h4>
        <section class="px-5 mx-5">
            <div class="px-5">
                <div id="information">
                    <form action="update.php" method="get">
                        <div class="d-flex">
                            <div class="w-100 p-5">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Full name</label>
                                    <input type="text" name="full_name" class="form-control" value="<?php echo $member['full_name'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $member['email'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">birth date</label>
                                    <input type="text" class="form-control" name="date" value="<?php echo $member['birth_date'] ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phone number</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo $member['phone'] ?>">
                                </div>
                            </div>
                            <div class="w-100 p-5">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nickname</label>
                                    <input type="text" class="form-control" name="nickname" value="<?php echo $member['Nickname'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $member['adresse'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">C.I.N</label>
                                    <input type="text" class="form-control" name="cin" value="<?php echo $member['CIN'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Occopation</label>
                                    <input type="text" class="form-control" name="occupation" value="<?php echo $member['occupation'] ?>">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger mb-3" type="submit" name="update_prof">update profile</button>
                    </form>
                </div>
            </div>
            </div>
            <div class="d-flex justify-content-center gap-5 mt-5">
                <form action="logout.php" method="get">
                    <button type="submit" class="btn_log">
                        Log out
                    </button>
                </form>
            </div>
        </section>
    </main>
    <!-- Password  Modal -->
    <div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change your Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="update.php" method="get">
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <input type="password" name="old_pass" class="form-style pass" placeholder="Your current Password" id="old_pass" autocomplete="off" required="" title="Your own password">
                            <i class="togglePassword input-icon far fa-eye" style="margin-left: 25rem; cursor: pointer;"></i>
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="password" name="new_pass" class="form-style pass" placeholder="New Password" id="new_pass" autocomplete="off" required="" title="Your own password">
                            <i class="togglePassword input-icon far fa-eye" style="margin-left: 25rem; cursor: pointer;"></i>
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="password" name="c_new_pass" class="form-style pass" placeholder="Confirm new Password" id="c_new_pass" autocomplete="off" required="" title="Your own password">
                            <i class="togglePassword input-icon far fa-eye" style="margin-left: 25rem; cursor: pointer;"></i>
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div id="warning">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_pass" class="btn_log">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelectorAll(".togglePassword");
        // const password = document.querySelectorAll(".pass");
        for (let i = 0; i < togglePassword.length; i++) {
            togglePassword[i].addEventListener("click", function(e) {
                // toggle the type attribute
                let input = togglePassword[i].closest("div").firstElementChild;
                const type =
                    input.getAttribute("type") === "password" ? "text" : "password";
                input.setAttribute("type", type);
                // toggle the eye slash icon
                this.classList.toggle("fa-eye-slash");
            });
        }
        let new_pass = document.getElementById('new_pass');
        let c_new_pass = document.getElementById('c_new_pass');
        let warning = document.getElementById('warning');
        c_new_pass.addEventListener('input', function() {
            if (c_new_pass.value != new_pass.value) {
                let msg = ` <div class="alert alert-warning" role="alert">
                                please enter the same password as abouve
                            </div>`
                warning.innerHTML = msg;
            } else {
                warning.innerHTML = ''
            }
        })
    </script>
</body>

</html>