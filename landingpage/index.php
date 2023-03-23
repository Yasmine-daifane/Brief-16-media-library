<?php

require "connect.php";
include "fonctions.php";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['signup'])) {
    $name = test_input($_POST['signname']);
    $mail = test_input($_POST['email']);
    $address = test_input($_POST['address']);
    $phone = test_input($_POST['phone']);
    $cin = test_input($_POST['cin']);
    $date = test_input($_POST['date']);
    $occupation = test_input($_POST['occupation']);
    $nickname = test_input($_POST['nickname']);
    $password = test_input($_POST['password']);
    $cpassword = test_input($_POST['confirm_password']);


    $signuser = new adéherent($nickname, $name, $cin, $mail, $date, $occupation, $phone, $address);


    $exNicname = "SELECT * FROM `adhérent` where `Nickname` = '$nickname'";
    echo $exNicname;
    $sql = $conn->query($exNicname);
    $exdNicname = $sql->fetch(PDO::FETCH_ASSOC);



    $exemail = "SELECT * FROM `adhérent`  where  email	='$mail'";
    $sql = $conn->query($exemail);
    $exdemail = $sql->fetch(PDO::FETCH_ASSOC);



    $excin = "SELECT * FROM `adhérent` where CIN = '$cin'";
    $sql = $conn->query($excin);
    $exdcin = $sql->fetch(PDO::FETCH_ASSOC);


    if (is_array($exdemail)) {

        $emailtaken = "this email is already taken ";
    } else if (is_array($exdcin)) {

        $cintaken = " this cin is already taken  ";

    } else if (is_array($exNicname)) {

        $Nicknametaken = " this email is already taken  ";

    } else {

        $hachage = $signuser->password($password);
        $who = $signuser->ROLE($nickname);

        $insertion = "INSERT INTO `adhérent` (`Id_adhérent`, `adresse`, `email`, `phone`, `CIN`, `birth_date`, `occupation`, `pénalité`, `compte_date`, `Nickname`, `password`, `full_name`, `role`) 
        VALUES (null, '$signuser->address','$signuser->email', '$signuser->phone', '$signuser->cin','$signuser->birthdate' , '$signuser->occupation','0', NOW(),'$signuser->Nicname', '$hachage','$signuser->fullname', '$who')";

        $sql = $conn->query($insertion);
    }

} elseif (isset($_POST['login'])) {
    $nickname = test_input($_POST['nickname']);
    $password = test_input($_POST['logpass']);
    $check_account = "SELECT * FROM adhérent WHERE Nickname = '$nickname'";
    $check_account = $conn->query($check_account);
    if ($check_account = $check_account->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($password, $check_account['password'])) {
            if ($check_account['Role'] == 0) {
                session_start();
                $_SESSION['full_name'] = $check_account['full_name'];
                $_SESSION['Nickname'] = $check_account['Nickname'];
                $_SESSION['password'] = $check_account['password'];
                $_SESSION['Id_adhérent'] = $check_account['Id_adhérent'];
                header("Location: ./user/user.php");
            } else {
                session_start();
                $_SESSION['full_name'] = $check_account['full_name'];
                $_SESSION['Nickname'] = $check_account['Nickname'];
                $_SESSION['password'] = $check_account['password'];
                $_SESSION['Id_adhérent'] = $check_account['Id_adhérent'];
                header("Location: ./Admin/admin.php");
            }
        } else {
            echo $check_account['password'];
            $login_error = "You can't use your account any more";
        }
    } else {
        $login_error = "This account not exist";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK HAVEN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200;400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
        

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="landingpage.css">
</head>

<body>
    <header class="section">
        <div class="container px_0">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="logo">
                            <img class=" logo " src="image_bckg/logo.png" alt="logo">
                            <p class="">BOOK lovers</p>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-6">
                            <div class="w-100">
                                <h1 class="m-lg-5 w-100">INSTEAD OF BUYING </h1>

                                <p class="m-lg-4 w-100">one ,why not rent a book and save ?</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="w-100">
                        <div class="row mx-0">
                            <div class="col-12 text-center p-0 ">
                                <div class="text-center">
                                    <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                                    <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                                    <label for="reg-log"></label>
                                    <div class="card-3d-wrap mx-auto">
                                        <div class="card-3d-wrapper">
                                            <div class="card-front h-100">
                                                <div class="center-wrap">
                                                    <div class="section text-center">
                                                        <h4 class="mb-4 pb-3">Log In</h4>
                                                        <form
                                                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>"
                                                            method="POST">
                                                            <div class="form-group">
                                                                <input type="text" name="nickname"
                                                                    class="form-style text-black"
                                                                    placeholder="Your nickname" id="nickname"
                                                                    autocomplete="off" required="" pattern="[a-zA-Z]+"
                                                                    title="Your own unique nickname">
                                                            </div>

                                                            <?php
                                                            if (isset($Nicknametaken)) {
                                                                $element =
                                                                    "<div class=\"alert alert-danger mt-2 d-flex align-items-center\" role=\"alert\">
                                                            <div>
                                                            $Nicknametaken
                                                            </div>
                                                        </div>";
                                                                echo $element;
                                                            }
                                                            ?>


                                                            <div class="form-floating mb-3 ">
                                                                <input type="password" name="logpass"
                                                                    class="form-style text-black"
                                                                    placeholder="Your Password" id="logpass"
                                                                    autocomplete="off" required=""
                                                                    title="Your own password">
                                                            </div>
                                                            <?php
                                                            if (isset($login_error)) {
                                                                $element =
                                                                    "<div class=\"alert alert-danger mt-2 d-flex align-items-center\" role=\"alert\">
                                                        <div>
                                                            $login_error
                                                        </div>
                                                    </div>";
                                                                echo $element;
                                                            }
                                                            ?>
                                                            <button name="login" type="submit"
                                                                class="btn mt-4">submit</button>
                                                            <p class="mb-0 mt-4 text-center"><a href="#0"
                                                                    class="link">Forgot your
                                                                    password?</a></p>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-back" style="height:115%;">
                                                <div class="center-wrap">
                                                    <div class="section text-center">
                                                        <h4 class="">Sign Up</h4>
                                                        <form
                                                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>"
                                                            method="post">
                                                            <div class="form-group text-black">
                                                                <input type="text" name="signname"
                                                                    class="form-style text-black"
                                                                    placeholder="Your Full Name" id="signname"
                                                                    autocomplete="off" required=""
                                                                    pattern="^[a-zA-Z-' ]+$">
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <input type="email" name="email"
                                                                    class="form-style text-black"
                                                                    placeholder="Your Email" id="email"
                                                                    autocomplete="off" required=""
                                                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                                            </div>



                                                            <?php
                                                            if (isset($emailtaken)) {
                                                                $element =
                                                                    "<div class=\"alert alert-danger mt-2 d-flex align-items-center\" role=\"alert\">
                                                            <div>
                                                            $emailtaken
                                                            </div>
                                                        </div>";
                                                                echo $element;
                                                            }
                                                            ?>


                                                            <div class="form-group mt-2">
                                                                <input type="text" name="address"
                                                                    class="form-style text-black"
                                                                    placeholder="Your address" id="address"
                                                                    autocomplete="off" required=""
                                                                    pattern="^[a-zA-Z-' -\d]+$">
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <input type="tel" name="phone"
                                                                    class="form-style text-black"
                                                                    placeholder="Your phone" id="phone"
                                                                    autocomplete="off" required=""
                                                                    pattern="^(06|07|05)\d{8}">
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <input type="text" name="cin"
                                                                    class="form-style text-black"
                                                                    placeholder="Your C.I.N" id="cin" autocomplete="off"
                                                                    required="" pattern="^[a-zA-Z0-9-' -]+$">
                                                            </div>


                                                            <?php
                                                            if (isset($cintaken)) {
                                                                $element =
                                                                    "<div class=\"alert alert-danger mt-2 d-flex align-items-center\" role=\"alert\">
                                                            <div>
                                                            $cintaken
                                                            </div>
                                                        </div>";
                                                                echo $element;
                                                            }
                                                            ?>
                                                            <div class="form-group mt-2">
                                                                <input type="date" name="date"
                                                                    class="form-style text-black"
                                                                    placeholder="Your birth date" id="date"
                                                                    autocomplete="off" required="" pattern="" max=""
                                                                    min="">
                                                                <p id="date-error" style="display:none; color:red;">
                                                                    Please enter your birthdate .</p>
                                                                <script>
                                                                    const currentDate = new Date();
                                                                    currentDate.setDate(currentDate.getDate() - 1);
                                                                    const maxDate = currentDate.toISOString().slice(0, 10);
                                                                    const minDate = "1900-01-01";
                                                                    const dateField = document.getElementById("date");
                                                                    const dateError = document.getElementById("date-error");
                                                                    dateField.setAttribute("max", maxDate);
                                                                    dateField.setAttribute("min", minDate);
                                                                    // Add an event listener to the date input field  
                                                                    dateField.addEventListener("input", function () {
                                                                        const selectedDate = new Date(this.value);
                                                                        if (selectedDate > currentDate) {
                                                                            // If the selected date is in the future, display an error message
                                                                            dateError.style.display = "block";
                                                                        } else {
                                                                            // Otherwise, hide the error message
                                                                            dateError.style.display = "none";
                                                                        }
                                                                    });
                                                                </script>
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <input type="text" name="occupation"
                                                                    class="form-style text-black"
                                                                    placeholder="Your occupation" id="occupation"
                                                                    autocomplete="off" required="">
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <input type="text" name="nickname"
                                                                    class="form-style text-black"
                                                                    placeholder="Enter nickname" id="nickname"
                                                                    autocomplete="off" required=""
                                                                    pattern="^[a-zA-Z0-9]{1,20}$">
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <input type="password" name="password"
                                                                    class="form-style text-black"
                                                                    placeholder="your password" id="password"
                                                                    autocomplete="off" required=""
                                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{10,}"
                                                                    title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <input type="password" name="confirm_password"
                                                                    class="form-style text-black"
                                                                    placeholder="Conform password" id="cpassword"
                                                                    autocomplete="off" required=""
                                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{10,}">
                                                            </div>
                                                            <div class="form-group mt-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        value="agree" id="flexCheckDefault"
                                                                        name="agree">
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault">
                                                                        checking that you are agreeing to
                                                                    </label><br>
                                                                    <a class="text-decoration-underline text-light"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#term&conditions">Term &
                                                                        condition of
                                                                        user</a>
                                                                </div>
                                                            </div>
                                                            <button name="signup" type="submit"
                                                                class="btn ">submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->
        </div>
        <!-- Modal -->
        <div class="modal fade" id="term&conditions" tabindex="-1" aria-labelledby="term&conditions" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <p class="modal-title fs-5" id="term&conditions">Terms & conditions</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="text-black fw-bold">
                            <li>A person cannot borrow or reserve more than three books at the same time.</li>
                            <li>A borrowing operation must be preceded by a reservation.</li>
                            <li>The validity of a reservation is limited to 24 hours.</li>
                            <li>The loan period must not exceed 15 days.</li>
                            <li>A person who submits a work beyond 15 days, receives a penalty.</li>
                            <li>A person who accumulates more than 3 penalties does not have the right to continue to
                                borrow
                                the books. And his account will be immediately locked.</li>
                            <li>No operation will be possible without authentication, even a simple consultation.</li>
                        </ul>
                    </div>
                </div>
            </div>
    </header>

    <main>

        <article>
            <h2 class="text-center pt-5 fw-bold">ABOUT US<h2>
                    <p class="text-center fs-3 mt-5 ">

                        We're a team of avid readers who are dedicated to sharing our love of books with others. Our
                        library booking website was created with the goal of providing an easy,
                        convenient way for fellow book lovers to access their favorite titles. We're committed to
                        promoting literacy and fostering a community of passionate readers.
                        Thank you for choosing our library booking website -
                        we can't wait to help you find your next great read
                    </p>
        </article>

        <section>

            <div class="content d-flex align-items-center justify-content-center">
                <div class="container rounded">
                    <h3 class="h1 fw-bold text-center mt-2 "> POPULAR BOOKS </h3>
                    <div class="h3 text-center pt-2"></div>
                    <div class="fs-5 text-center pb-3 mb-3"></div>
                    <div class="rollers position-relative overflow-hidden">
                        <div class="start-roller"></div>
                        <div class="wrapper">
                            <div class="items-container roll-LL">
                                <div class="item">
                                    <img src="images/hunger.jpg" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/ficciones.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/crime-and-punishment.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/beloved.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/confessions-of-zeno.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/voyage-au-bout-de-la-nuit.jpg" alt="" class="company">
                                </div>
                            </div>
                            <div class="items-container roll-RL">
                                <div class="item">
                                    <img src="images/zorba-the-greek.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/wuthering-heights.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/king-lear.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/war-and-peace.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/voyage-au-bout-de-la-nuit.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/ulysses.jpg" alt="" class="company">
                                </div>

                            </div>
                        </div>
                        <div class="wrapper">
                            <div class="items-container reverse-roll-LL">
                                <div class="item">
                                    <img src="images/to-the-lighthouse.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/the-trial.jpg  " alt="  " class="company">
                                </div>
                                <div class="item">
                                    <img src="images/the-tale-of-genji.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/the-possessed.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/faust.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/gargantua-and-pantagruel.jpg" alt="" class="company">
                                </div>

                            </div>
                            <div class="items-container reverse-roll-RL">
                                <div class="item">
                                    <img src="images/the-metamorphoses-of-ovid.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/a-la-recherche-du-temps-perdu.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/dead-souls.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/anna-karenina.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/beloved.jpg" alt="" class="company">
                                </div>
                                <div class="item">
                                    <img src="images/crime-and-punishment.jpg" alt="" class="company">
                                </div>
                            </div>

                        </div>
                        <div class="end-roller"></div>
                    </div>
                </div>
            </div>

            <section>




                <footer class="footer-container  ">


                    <div class="social-links d-flex align-items-center   " style="    padding: 2rem 10px;">
                        <div class="link " style="    padding: 2rem 10px;"><a href="#"><i
                                    class="fa fa-facebook"></i></a></div>
                        <div class="link" style="    padding: 2rem 10px;"><a href="#"><i
                                    class="fa fa-instagram"></i></a></div>
                        <div class="link" style="    padding: 2rem 10px; "><a href="#"><i class="fa fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="copyright">
                        <p>&copy; ©2023 BOOK Lovers | Privacy Policy</p>
                    </div>
                </footer>


    </main>







</body>

</html>