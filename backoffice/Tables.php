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
    <div class="section">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-12 text-center align-self-center py-2">
                    <?php
                    if (isset($signed_up)) {
                        $element =
                            "<div class=\"alert alert-success\" role=\"alert\">
                                $signed_up
                            </div>";
                        echo $element;
                    }
                    ?>
                    <div class="section pb-5 pt-2 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Reservation</span><span>Borowwing</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <form method="post"
                                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                <div class="form-group">
                                                    <input type="text" name="nickname" class="form-style"
                                                        placeholder="Your nickname" id="nickname" autocomplete="off"
                                                        required="" pattern="[a-zA-Z]+"
                                                        title="Your own unique nickname">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="login_pass" class="form-style pass"
                                                        placeholder="Your Password" id="login_pass" autocomplete="off"
                                                        required="" title="Your own password">
                                                    <i class="togglePassword input-icon far fa-eye"
                                                        style="margin-left: 19rem; cursor: pointer;"></i>
                                                    <i class="input-icon uil uil-lock-alt"></i>
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
                                                <button name="login" type="submit" class="btn mt-4">submit</button>
                                                <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your
                                                        password?</a></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Sign Up</h4>
                                            <form id="signup_form"
                                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                                method="post">
                                                <div class="form-group">
                                                    <input type="text" name="signname" class="form-style" value="<?php if (isset($name)) {
                                                        echo $name;
                                                    } ?>" placeholder="Your Full Name" id="signname" autocomplete="off"
                                                        required="" pattern="^[a-zA-Z-' ]+$">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" class="form-style" value="<?php if (isset($mail)) {
                                                        echo $mail;
                                                    } ?>" placeholder="Your Email" id="email" autocomplete="off"
                                                        required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <?php
                                                if (isset($mail_error)) {
                                                    $element =
                                                        "<div class=\"alert alert-danger mt-2 d-flex align-items-center\" role=\"alert\">
                                                            <div>
                                                                $mail_error
                                                            </div>
                                                        </div>";
                                                    echo $element;
                                                }
                                                ?>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="address" class="form-style" value="<?php if (isset($address)) {
                                                        echo $address;
                                                    } ?>" placeholder="Your address" id="address" autocomplete="off"
                                                        required="" pattern="^[a-zA-Z-' -\d]+$">
                                                    <i class="input-icon uil uil-location-pin-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="tel" name="phone" class="form-style" value="<?php if (isset($phone)) {
                                                        echo $phone;
                                                    } ?>" placeholder="Your phone" id="phone" autocomplete="off"
                                                        required="" pattern="^(06|07|05)\d{8}">
                                                    <i class="input-icon uil uil-phone-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="cin" class="form-style" value="<?php if (isset($cin)) {
                                                        echo $cin;
                                                    } ?>" placeholder="Your C.I.N" id="cin" autocomplete="off"
                                                        required="" pattern="^[a-zA-Z-' -\d]+$">
                                                    <i class="input-icon uil uil-postcard"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="date" name="date" class="form-style" value="<?php if (isset($date)) {
                                                        echo $date;
                                                    } ?>" placeholder="Your birth date" id="date" autocomplete="off"
                                                        required="">
                                                    <i class="input-icon uil uil-calender"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="occupation" class="form-style" value="<?php if (isset($occupation)) {
                                                        echo $occupation;
                                                    } ?>" placeholder="Your occupation" id="occupation"
                                                        autocomplete="off" required=""
                                                        pattern="(Student|officials|housewife)"
                                                        title="Student/officials/housewife...">
                                                    <i class="input-icon uil uil-smile"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="nickname" class="form-style" value="<?php if (isset($nickname)) {
                                                        echo $nickname;
                                                    } ?>" placeholder="Enter nickname" id="nickname" autocomplete="off"
                                                        required="" pattern="[a-zA-Z]+">
                                                    <i class="input-icon uil uil-user-circle"></i>
                                                </div>
                                                <?php
                                                if (isset($nickname_error)) {
                                                    $element =
                                                        "<div class=\"alert alert-danger mt-2 d-flex align-items-center\" role=\"alert\">
                                                            <div>
                                                                $nickname_error
                                                            </div>
                                                        </div>";
                                                    echo $element;
                                                }
                                                ?>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style pass"
                                                        value="<?php if (isset($password)) {
                                                            echo $password;
                                                        } ?>" placeholder="your password" id="password"
                                                        autocomplete="off" required=""
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                        title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                                                    <i class="togglePassword input-icon far fa-eye"
                                                        style="margin-left: 19rem; cursor: pointer;"></i>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="cpassword" class="form-style pass"
                                                        value="<?php if (isset($cpassword)) {
                                                            echo $cpassword;
                                                        } ?>" placeholder="Conform password" id="cpassword"
                                                        autocomplete="off" required=""
                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                    <i class="togglePassword input-icon far fa-eye"
                                                        style="margin-left: 19rem; cursor: pointer;"></i>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <p id="pass_error"></p>
                                                <div class="form-group mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="agree"
                                                            id="flexCheckDefault" name="agree">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            By checking that you are agreeing to
                                                        </label><br>
                                                        <a class="text-decoration-underline text-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#term&conditions">Term &
                                                            condition of
                                                            user</a>
                                                    </div>
                                                    <p id="check_error"></p>
                                                </div>
                                                <button name="signup" type="submit" class="btn mt-4">submit</button>
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
</body>