<?php
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<?php include("../inc/db-conn.php") ?>
<?php include("../bin/function.php") ?>
<?php
$cookie_login = $_COOKIE['login'];
$cookie_username = $_COOKIE['username'];
$cookie_password = $_COOKIE['password'];

$checkCookie = $cookie_login."|".$cookie_username."|".$cookie_password;

$checkCredentialCookie = get_access_credential_op($cookie_username, $cookie_password, $dbConn);
if ($checkCookie == $checkCredentialCookie) {
    header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="it">
<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<div class="wrapper">

    <!--=================================
     preloader -->

    <div id="pre-loader">
        <img src="../images/pre-loader/loader-01.svg" alt="">
    </div>

    <!--=================================
     preloader -->

    <!--=================================
    login-->

    <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url(../images/background.jpg);" >
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">
                <div class="col-lg-4 col-md-6 login-fancy-bg bg" style="background-color: rgba(0,0,0,.2);">
                    <div class="login-fancy">
                        <h3 class="text-white mb-20">MonCaff&egrave;.it</h3>
                        <p class="mb-20 text-white">Gestionale web</p>

                        <!--
                        <ul class="list-unstyled  pos-bot pb-30">
                            <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>
                            <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>
                        </ul>
                        -->
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 bg-white">

                    <form method="post" action="check-login.php">

                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30">Accesso Operatore</h3>

                            <?php
                            $login = @$_GET["login"];
                            if ($login == 'false') {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <b>Attenzione!</b> I dati di accesso sono errati, riprova.
                                </div>
                            <?php }; ?>

                            <div class="section-field mb-20">
                                <label class="mb-10" for="username">Codice * </label>
                                <input id="username" name="username" class="web form-control" type="text" placeholder="Codice" required>
                            </div>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="password">Password * </label>
                                <input id="password" name="password" class="Password form-control" type="password" placeholder="Password" required>
                            </div>
                            <div class="section-field">
                                <div class="remember-checkbox mb-30">
                                    <input type="checkbox" class="form-control" name="remember" id="remember" />
                                    <label for="remember"> Ricordami</label>
                                    <!--<a href="password-recovery.html" class="float-right">Forgot Password?</a>-->
                                </div>
                            </div>

                            <button type="submit" class="button" style="background-color: #dda047; border-color: #dda047;">
                                <span>Login &nbsp; </span><i class="fa fa-check"></i>
                            </button>

                            <!--<p class="mt-20 mb-0">Don't have an account? <a href="register.html"> Create one here</a></p>-->
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </section>

    <!--=================================
     login-->

</div>

<?php include "inc/javascript.php"; ?>

</body>
</html>