<?php
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template"/>
    <meta name="author" content="potenzaglobalsolutions.com"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>Cybek.it / Software CRM</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.png"/>

    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

    <style>
        .login-fancy {
            text-align: center;
            background-color: rgba(0, 0, 0, .2) !important;
        }
    </style>

</head>

<body>

<div class="wrapper">

    <!--=================================
     preloader -->

    <div id="pre-loader">
        <img src="images/pre-loader/loader-01.svg" alt="">
    </div>

    <!--=================================
     preloader -->

    <!--=================================
    login-->

    <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url(images/background.jpg); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">
                <div class="col-lg-8 col-md-8 login-fancy-bg bg">
                    <div class="login-fancy">
                        <h3 class="text-white mb-20">Benvenuto nel CRM di Cybek.it</h3>
                        <p class="mb-20 text-white">Seleziona il tipo di accesso che desideri eseguire cliccando sul relativo link.</p>

                        <a style=" margin: 10px auto; width:250px; text-align: center; background-color: #dda047!important;" class="btn text-white" href="admin">Accesso Admin</a><br>
                        <!--<a style=" margin: 10px auto; width:250px; text-align: center; background-color: #dda047!important;" class="btn text-white" href="operatori">Accesso Operatori</a>-->
                        <!--
                        <br>
                        <a style=" margin: 10px auto; width:250px; text-align: center; background-color: dodgerblue!important;" class="btn text-white" href="operatore">Accesso Operatore</a>
                        <br>
                        <a style=" margin: 10px auto; width:250px; text-align: center; background-color: orange!important;" class="btn text-white" href="business">Accesso Business</a>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--=================================
     login-->

</div>


<!--=================================
 jquery -->

<!-- jquery -->
<script src="js/jquery-3.3.1.min.js"></script>

<!-- plugins-jquery -->
<script src="js/plugins-jquery.js"></script>

<!-- plugin_path -->
<script>var plugin_path = 'js/';</script>

<!-- chart -->
<script src="js/chart-init.js"></script>

<!-- calendar -->
<script src="js/calendar.init.js"></script>

<!-- charts sparkline -->
<script src="js/sparkline.init.js"></script>

<!-- charts morris -->
<script src="js/morris.init.js"></script>

<!-- datepicker -->
<script src="js/datepicker.js"></script>

<!-- sweetalert2 -->
<script src="js/sweetalert2.js"></script>

<!-- toastr -->
<script src="js/toastr.js"></script>

<!-- validation -->
<script src="js/validation.js"></script>

<!-- lobilist -->
<script src="js/lobilist.js"></script>

<!-- custom -->
<script src="js/custom.js"></script>

</body>
</html>