<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Cybek</title>
    <meta name="description" content=""/>
    <?php include('inc/head.php'); ?>

    <style>
        .btn-form {

            border: none;
            background-color: #0090f0;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1;
            padding: 15px 52px;
            margin-top: 33px;
            outline: none;
            -webkit-transition: all .3s ease 0s;
            -o-transition: all .3s ease 0s;
            transition: all .3s ease 0s;
            border-radius: 30px;

        }

    </style>
</head>
<body class="home-5 home-6 home-8 home-9 home-electronic">
<!-- main layout start from here -->
<!--====== PRELOADER PART START ======-->

<!-- <div id="preloader">
<div class="preloader">
    <span></span>
    <span></span>
</div>
</div> -->

<!--====== PRELOADER PART ENDS ======-->
<div id="main">
    <!-- Header Start -->
    <?php include('inc/header-2.php'); ?>
    <!-- Header End -->
    <!-- Breadcrumb Area start -->
    <section class="breadcrumb-area" style="background: url(assets/images/breadcrumb-bg/breadcrumb.jpg) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-hrading">Login</h1>
                        <ul class="breadcrumb-links">
                            <li><a href="index.php">Home</a></li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->
    <!-- checkout area start -->
    <div class="checkout-area mt-60px mb-40px">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 dashboard-menu-container">
                    <div class="your-order-area">
                        <h3>Accedi</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <p>
                                Se sei già registrato accedi alla tua area riservata. Se hai smarrito la password chiedi il recupero, ti arriverà una mail con in dati di accesso sulla casella utilizzata come account.
                            </p>
                            <p><img style="width: 230px; margin: 10px 0;" src="assets/images/assistenza.jpg"></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <form action="login-do" method="post">

                        <div class="billing-info-wrap">
                            <h3>Login</h3>

                            <p>Inserisci le credenziali per accedere alla tua area clienti, potrai visionare i tuoi dati, i tuoi ordini e i dettagli delle spedizioni.</p>
                            <br>

                            <?php if (@$_GET['login'] == "true") { ?>

                                <div class="alert alert-success">
                                    <b>Hai effettuato l'accesso con successo!</b>
                                </div>

                            <?php } else if (@$_GET['login'] == "false") { ?>

                                <div class="alert alert-danger">
                                    <b>Attenzione!</b> Combinazione email / password errata o account non attivo.
                                </div>

                            <?php } ?>

                            <?php
                            if (@$_GET["conferma"] == "true") { ?>
                                <p class="alert alert-success">Registrazione confermata, ora puoi accedere.</p><br/>
                            <?php } elseif (@$_GET["conferma"] == "false") { ?>
                                <p class="alert alert-danger">Si &egrave; verificato un errore, riprova.</p><br>
                            <?php }; ?>

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info mb-20px">
                                        <label>Email</label>
                                        <input type="email" placeholder="Inserisci la tua email" name="ut_email" required>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info mb-20px">
                                        <label>Password</label>
                                        <input type="password" placeholder="Inserisci la password" name="ut_password" required>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-account">
                                <input class="checkout-toggle2" type="checkbox" id="check">
                                <label for="check">Ricordami</label>
                            </div>

                            <button class="btn-form">Accedi</button>

                        </div>
                    </form>
                </div>

                <div class="col-lg-1">&nbsp;</div>

                <div class="col-lg-4">
                    <form action="recupero-password-do" method="post">

                        <div class="billing-info-wrap">
                            <h3>Recupero password</h3>

                            <p>Se hai perso la tua password, inserisci qui la mail con cui ti sei registrato, riceverai una mail con le istruzioni.</p>
                            <br>

                            <?php if (@$_GET['recover'] == "true") { ?>

                                <div class="alert alert-success" role="alert">
                                    Ti abbiamo inviato una mail con le credenziali di accesso.
                                </div>

                            <?php } else if (@$_GET['recover'] == "false") { ?>

                                <div class="alert alert-danger" role="alert">
                                    <b>Attenzione!</b> L'email non risulta esistente o si è verificato un'errore.
                                </div>

                            <?php } ?>

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="billing-info mb-20px">
                                        <label>Email</label>
                                        <input type="email" placeholder="Inserisci la tua email" name="ut_email" required value="<?php echo @$_GET["email"]; ?>">
                                    </div>
                                </div>

                            </div>

                            <button class="btn-form">Recupera password</button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <!-- checkout area end -->
    <!-- Footer Area start -->
    <?php include('inc/footer.php'); ?>
    <!--  Footer Area End -->
</div>

<!-- Scripts to be loaded  -->
<!-- JS -->
<?php include('inc/javascript.php'); ?>
</body>
</html>
