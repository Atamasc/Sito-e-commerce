<?php include "inc/autoloader.php"; ?>
<?php
if ($session_cl_login == 0) header("Location: $rootBasePath_http");
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Cybek</title>
    <meta name="description" content=""/>
    <?php include('inc/head.php'); ?>

    <style>
        .single-my-account h3.panel-title a:hover {
            color: #0090f0;
        }

        .single-my-account .myaccount-info-wrapper .billing-back-btn .billing-btn button:hover {
            background-color: #0090f0;
        }

        .cart-table-content table {
            width: 100%;
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
    <section class="breadcrumb-area" style="background: url(assets/images/breadcrumb-bg/breadcrumb.jpg) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-hrading">Il mio Account</h1>
                        <ul class="breadcrumb-links">
                            <li><a href="<?php echo $rootBasePath_http; ?>">Home</a></li>
                            <li>Il mio Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->
    <!-- account area start -->
    <div class="checkout-area mtb-60px">
        <div class="container">
            <div class="row">
                <div class="ml-auto mr-auto col-lg-9">

                    <?php if (@$_GET["update"] == "true") { ?>
                        <div class="alert alert-success"><b>Modifica effettuata con successo.</b></div>
                    <?php }; ?>

                    <?php if (@$_GET["login"] == "true") { ?>
                        <div class="alert alert-success"><b>Bentornato sul nostro store!</b></div>
                    <?php }; ?>

                    <div class="checkout-wrapper">
                        <div id="faq" class="panel-group">
                            <div class="panel panel-default single-my-account">
                                <div class="panel-heading my-account-title">
                                    <h3 class="panel-title"><span>1 .</span>
                                        <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Modifica i tuoi dati personali </a>
                                    </h3>
                                </div>
                                <div id="my-account-1" class="panel-collapse collapse show">

                                    <?php
                                    $querySql = "SELECT * FROM ut_utenti WHERE ut_codice = '$session_cl_codice' ";
                                    $result = $dbConn->query($querySql);
                                    $row_data = $result->fetch_assoc();
                                    $result->close();
                                    ?>

                                    <div class="panel-body">
                                        <div class="myaccount-info-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>I tuoi Dati</h4>
                                            </div>
                                            <form action="account-do" method="post">

                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Nome *</label>
                                                            <input type="text" name="ut_nome" id="ut_nome" value="<?php echo $row_data['ut_nome']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Cognome *</label>
                                                            <input type="text" name="ut_cognome" id="ut_cognome" value="<?php echo $row_data['ut_cognome']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Telefono *</label>
                                                            <input type="text" name="ut_telefono" id="ut_telefono" value="<?php echo $row_data['ut_telefono']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Email *</label>
                                                            <input type="email" name="ut_email" id="ut_email" value="<?php echo $row_data['ut_email']; ?>" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Provincia *</label>
                                                            <input type="text" name="ut_provincia" id="ut_provincia" value="<?php echo $row_data['ut_provincia']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Citt&agrave; *</label>
                                                            <input type="text" name="ut_citta" id="ut_citta" value="<?php echo $row_data['ut_citta']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Indirizzo *</label>
                                                            <input type="text" name="ut_indirizzo" id="ut_indirizzo" value="<?php echo $row_data['ut_indirizzo']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>CAP *</label>
                                                            <input type="text" name="ut_cap" id="ut_cap" value="<?php echo $row_data['ut_cap']; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-btn">
                                                        <button type="submit">Salva modifiche</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default single-my-account">
                                <div class="panel-heading my-account-title">
                                    <h3 class="panel-title"><span>2 .</span>
                                        <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Cambia password </a>
                                    </h3>
                                </div>
                                <div id="my-account-2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="myaccount-info-wrapper">
                                            <form action="account-password-do" method="post">

                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Nuova password <span>*</span></label>
                                                            <input type="password" name="ut_password_old" id="ut_password_old" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Conferma password <span>*</span></label>
                                                            <input type="password" name="ut_password" id="ut_password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-btn">
                                                        <button type="submit">Modifica password</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default single-my-account">
                                <div class="panel-heading my-account-title">
                                    <h3 class="panel-title"><span>3 .</span>
                                        <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">I tuoi ordini </a>
                                    </h3>
                                </div>
                                <div id="my-account-3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="myaccount-info-wrapper">

                                            <div class="row" style="margin-bottom: 30px">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <form action="#">
                                                        <div class="table-content table-responsive cart-table-content">
                                                            <table>
                                                                <thead>
                                                                <tr>
                                                                    <th>Data</th>
                                                                    <th>Codice</th>
                                                                    <th>Azioni</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>


                                                                <?php
                                                                $querySql =
                                                                    "SELECT or_codice, MAX(or_timestamp) as or_timestamp FROM or_ordini " .
                                                                    "INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE ut_codice = '$session_cl_codice' " .
                                                                    "GROUP BY or_codice ORDER BY or_codice DESC ";
                                                                $result = $dbConn->query($querySql);
                                                                $rows = $dbConn->affected_rows;

                                                                while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                                    $or_codice = $row_data['or_codice'];
                                                                    $or_timestamp = $row_data['or_timestamp'];

                                                                    echo "<tr>";
                                                                    echo "<td>" . date('d/m/Y', $or_timestamp) . "</td>";
                                                                    echo "<td>$or_codice</td>";

                                                                    //Gestione
                                                                    echo "<td>";
                                                                    echo "<a href='$rootBasePath_http/dettaglio-ordine?or_codice=$or_codice' class='view'>dettaglio</a>";
                                                                    echo "</td>";
                                                                    echo "</tr>";

                                                                };

                                                                if ($rows == '0') echo "<tr><td colspan='99' align='center'>Non hai ancora effettuato un'ordine</td></tr>";

                                                                $result->close();
                                                                ?>


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!--                                            <div class="billing-back-btn">-->
                                            <!--                                                <div class="billing-btn">-->
                                            <!--                                                    <button type="submit">Continue</button>-->
                                            <!--                                                </div>-->
                                            <!--                                            </div>-->
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
    <!-- account area end -->

    <?php include('inc/footer.php'); ?>

</div>

<?php include('inc/javascript.php'); ?>

</body>
</html>
