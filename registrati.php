<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Cybek - Registrati subito ed acquista prodotti informatici al miglior prezzo.</title>
    <meta name="description" content="Registrati subito per approfittare dei migliori prezzi del web per prodotti informatici "/>
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
            margin-top: 10px;
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
    <?php include('inc/header.php'); ?>
    <!-- Header End -->
    <!-- Breadcrumb Area start -->
    <section class="breadcrumb-area" style="background: url(assets/images/breadcrumb-bg/breadcrumb.jpg); background-position: center center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-hrading">Registrazione</h1>
                        <ul class="breadcrumb-links">
                            <li><a href="index.php">Home</a></li>
                            <li>Registrazione</li>
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
                        <h3>Registrati</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <p>
                                <strong>Perchè registrarti</strong><br> Registrandoti avrai un account gratuito che ti permetterà di gestire i tuoi ordini con modifiche o tracking di spedizione.
                                <br><br>

                                <strong>Acquisto rapido</strong><br> Se non vuoi registrarti, puoi anche procedere con l'acquisto rapido come ospite, dovrai solo procedere ad inserire i prodotti nel carrello e inserire i dati di spedizione. Non ti verrà creato un account e non potrai gestire i tuoi ordini.
                                <br><br>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <form action="registrati-do" method="post">
                        <div class="billing-info-wrap">

                            <h3>Inserisci i tuoi dati per creare un account gratuito</h3>

                            <?php if (@$_GET["insert"] == "true") { ?>
                                <p class="alert alert-success">Registrazione effettuata con successo, ti abbiamo inviato una mail di conferma.</p>
                                <br/>
                            <?php } elseif (@$_GET["insert"] == "false") { ?>
                                <p class="alert alert-danger">Si &egrave; verificato un errore, riprova.</p><br/>
                            <?php } elseif (@$_GET["exist"] == "true") { ?>
                                <p class="alert alert-danger">La tua email risulta gi&agrave; registrata, se non ricordi la password
                                    <a href="login?email=<?php echo $_GET["email"]; ?>"> clicca qui </a></p><br/>
                            <?php }; ?>

                            <br>

                            <div class="row">

                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Nome *</label> <input type="text" name="ut_nome" id="ut_nome" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Cognome *</label>
                                        <input type="text" name="ut_cognome" id="ut_cognome" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Telefono *</label>
                                        <input type="text" name="ut_telefono" id="ut_telefono" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Email *</label>
                                        <input type="email" name="ut_email" id="ut_email" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Password *</label>
                                        <input type="password" name="ut_password" id="ut_password" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Sigla della provincia (es: RM) *</label>
                                        <input type="text" name="ut_provincia" id="ut_provincia" maxlength="2" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Citt&agrave; *</label>
                                        <input type="text" name="ut_citta" id="ut_citta" required>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>CAP *</label> <input type="text" name="ut_cap" id="ut_cap" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Indirizzo *</label>
                                        <input type="text" name="ut_indirizzo" id="ut_indirizzo" required>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="row">

                                <div class="col-sm-12">


                                    <div class="login_submit">
                                        <label for="py_checkbox_privacy" style="text-align: left; width: 100%;">
                                            <input name="py_checkbox_privacy" type="checkbox" id="py_checkbox_privacy" class="checkbox" value="1" required style="display:inline;">
                                            &nbsp; Autorizzo il trattamento dei dati personali in base al
                                            <a style="float: none;" href="<?php echo "$rootBasePath_http/privacy-policy"; ?>" target="_blank">&nbsp;GDPR</a> (*)
                                        </label>
                                    </div>

                                    <div class="login_submit">
                                        <label for="py_checkbox_cessione" style="text-align: left; width: 100%;">
                                            <input type="checkbox" name="py_checkbox_cessione" id="py_checkbox_cessione" value="1" required style="display: inline">
                                            &nbsp; Accetto i termini e le condizioni di vendita del sito.
                                            <a style="float: none;" href="<?php echo "$rootBasePath_http/termini-condizioni"; ?>" target="_blank">Termini e condizioni</a> (*)
                                        </label>
                                    </div>

                                    <div class="login_submit">
                                        <label for="py_checkbox_marketing" style="text-align: left; width: 100%;">
                                            <input type="checkbox" name="py_checkbox_marketing" id="py_checkbox_marketing" value="1" style="display: inline">
                                            &nbsp; Autorizzo il trattamento per le finalit&agrave; di marketing.
                                            <a style="float: none;" href="<?php echo "$rootBasePath_http/privacy-policy"; ?>" target="_blank">Informativa privacy</a>
                                        </label>
                                    </div>

                                </div>

                                <div class="col-lg-12 mb-40">
                                    <div class="billing-info mb-20px">

                                        <?php
                                        $random['a'] = rand(1, 9);
                                        $random['b'] = rand(1, 9);
                                        $codice_nume = $random['a'] + $random['b'];
                                        ?>
                                        <label>Conferma di non essere un robot:
                                            <b><?php echo $random['a'] . " + " . $random['b']; ?></b>?</label>
                                        &nbsp;
                                        <input type="text" name="codice_num" id="codice_num" style="width: 50px; padding: 0 10px;" required autocomplete="off">
                                        <input type="hidden" name="codice_num_hidden" value="<?php echo $codice_nume; ?>">
                                    </div>
                                </div>

                            </div>


                            <!--<div class="additional-info-wrap">
                                <h4>Note</h4>
                                <div class="additional-info">
                                    <label>Order notes</label>
                                    <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="message"></textarea>
                                </div>
                            </div>

                            <div class="checkout-account">
                                <input class="checkout-toggle2" type="checkbox" id="check">
                                <label for="check">Create an account?</label>
                            </div>-->

                            <button class="btn-form" type="submit">Registrati</button>

                        </div>


                    </form>

                </div>

            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>
</div>

<?php include('inc/javascript.php'); ?>

</body>

</html>
