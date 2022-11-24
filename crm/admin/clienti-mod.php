<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

    <script src="../ajax/regioni.js"></script>

</head>

<?php
$get_cl_id = isset($_GET['cl_id']) ? (int)$_GET['cl_id'] : 0;

$querySql = "SELECT * FROM cl_clienti WHERE cl_id = '$get_cl_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();
?>

<body>

<div class="wrapper">
    <!--================================= preloader -->
    <div id="pre-loader">
        <img src="../images/pre-loader/loader-01.svg" alt="">
    </div>
    <!--================================= preloader -->
    <!--================================= header start-->

    <?php include "inc/header.php"; ?>

    <!--================================= header End-->
    <!--================================= Main content -->

    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar -->
            <?php include "inc/sidebar.php"; ?>
            <!-- Left Sidebar End-->

            <!--================================= Main content -->
            <!--================================= wrapper -->
            <div class="content-wrapper">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="mb-0"> Modifica cliente</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="clienti-gst.php" class="default-color">Gestione clienti</a></li>
                                <li class="breadcrumb-item active">Modifica cliente</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">
                                <form method="post" action="clienti-mod-do.php">

                                    <?php
                                    if(@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Cliente modificato con successo.
                                        </div>
                                        <?php

                                    } else if(@$_GET['update'] == 'false') {

                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Si è verificato un errore, riprova.
                                        </div>
                                        <?php

                                    }
                                    ?>

                                    <h6 class="card-title">Dati anagrafici</h6>

                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_nome">Codice *</label>
                                            <input type="text" class="form-control" id="cl_codice" name="cl_codice" placeholder="Codice *"
                                                   value="<?php echo $row_data['cl_codice']; ?>" required>
                                            <span class="tooltips">Codice Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Cliente" data-content="Inserisci qui il codice del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_nome">Nome *</label>
                                            <input type="text" class="form-control" id="cl_nome" name="cl_nome" placeholder="Nome *"
                                                   value="<?php echo $row_data['cl_nome']; ?>" required>
                                            <span class="tooltips">Nome Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Nome Cliente" data-content="Inserisci qui il nome del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_cognome">Cognome *</label>
                                            <input type="text" class="form-control" id="cl_cognome" name="cl_cognome" placeholder="Cognome *"
                                                   value="<?php echo $row_data['cl_cognome']; ?>" required>
                                            <span class="tooltips">Cognome Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Cognome Cliente" data-content="Inserisci qui il cognome del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_codice_fiscale">Codice fiscale</label>
                                            <input type="text" class="form-control" id="cl_codice_fiscale" name="cl_codice_fiscale"
                                                   value="<?php echo $row_data['cl_codice_fiscale']; ?>" placeholder="Codice fiscale">
                                            <span class="tooltips">Codice Fiscale Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Fiscale Cliente" data-content="Inserisci qui il codice fiscale del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_provincia">Sigla della provincia</label>
                                            <input type="text" class="form-control" id="cl_provincia" name="cl_provincia" placeholder="Provincia" value="<?php echo $row_data['cl_provincia']; ?>" maxlength="2">
                                            <!--<select class="form-control" id="cl_provincia" name="cl_provincia" onchange="getCitta();">
                                                <option value="">Seleziona una provincia</option>
                                                <option value=""></option>
                                                <?php selectProvince($row_data['cl_provincia'], "", $dbConn); ?>
                                            </select>-->
                                            <span class="tooltips">Provincia Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Provincia Cliente" data-content="Inserisci qui la provincia del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_comune">Città</label>
                                            <input type="text" class="form-control" id="cl_comune" name="cl_comune" placeholder="Città"
                                                   value="<?php echo $row_data['cl_comune']; ?>">
                                            <!--<select class="form-control" id="cl_citta" name="cl_citta">
                                                <option value="">Seleziona una citta'</option>
                                                <option value=""></option>
                                                <?php selectComuni($row_data['cl_citta'], $row_data['cl_provincia'], $dbConn); ?>
                                            </select>-->
                                            <span class="tooltips">Citt&agrave; Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Citt&agrave; Cliente" data-content="Inserisci qui la citt&agrave; del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <!--
                                        <div class="col-md-2 mb-3">
                                            <label for="cl_citta_prestashop">Città Prestashop</label>
                                            <input type="text" class="form-control" id="cl_citta" name="cl_citta" placeholder="Città del DB Prestashop" value="<?php echo $row_data['cl_citta']; ?>" readonly>
                                            <span class="tooltips">Citt&agrave; Prestashop Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Citt&agrave; Prestashop Cliente" data-content="Qui viene mostrata la citt&agrave; dove si trova il database di prestashop del cliente che stai modificando">[aiuto]</a></span>
                                        </div>
                                        -->

                                        <div class="col-md-3 mb-3">
                                            <label for="cl_indirizzo">Indirizzo</label>
                                            <input type="text" class="form-control" id="cl_indirizzo" name="cl_indirizzo" placeholder="Indirizzo"
                                                   value="<?php echo $row_data['cl_indirizzo']; ?>">
                                            <span class="tooltips">Indirizzo Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Indirizzo Cliente" data-content="Inserisci qui l'indirizzo del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-1 mb-3">
                                            <label for="cl_cap">CAP</label>
                                            <input type="text" class="form-control" id="cl_cap" name="cl_cap" placeholder="CAP" autocomplete="off"
                                                   value="<?php echo $row_data['cl_cap']; ?>">
                                            <span class="tooltips">C.A.P. Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="C.A.P. Cliente" data-content="Inserisci qui il C.A.P. del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <h6 class="card-title mt-3">Campi Business</h6>
                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_ragione_sociale">Ragione Sociale</label>
                                            <input class="form-control" id="cl_ragione_sociale" name="cl_ragione_sociale"
                                                   value="<?php echo $row_data['cl_ragione_sociale']; ?>">
                                            <span class="tooltips">Ragione Sociale Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ragione Sociale Cliente" data-content="Inserisci qui la ragione sociale del cliente che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_partita_iva">Partita IVA</label>
                                            <input type="text" class="form-control" id="cl_partita_iva" name="cl_partita_iva" placeholder="Partita IVA"
                                                   value="<?php echo $row_data['cl_partita_iva']; ?>">
                                            <span class="tooltips">Partita Iva Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Partita Iva Cliente" data-content="Inserisci qui la Partita Iva del cliente che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_sdi">SDI</label>
                                            <input type="text" class="form-control" id="cl_sdi" name="cl_sdi"
                                                   value="<?php echo $row_data['cl_sdi']; ?>">
                                            <span class="tooltips">SDI Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="SDI Cliente" data-content="Inserisci qui il codice SDI del cliente che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_pec">Email PEC</label>
                                            <input type="text" class="form-control" id="cl_pec" name="cl_pec"
                                                   value="<?php echo $row_data['cl_pec']; ?>">
                                            <span class="tooltips">Email PEC Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Email PEC Cliente" data-content="Inserisci qui l'email PEC del cliente che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_provincia_fatturazione">Provincia fatturazione</label>
                                            <input type="text" class="form-control" id="cl_provincia_fatturazione" name="cl_provincia_fatturazione" placeholder="Provincia fatturazione"
                                                   value="<?php echo $row_data['cl_provincia_fatturazione']; ?>">
                                            <!--<select class="form-control" id="cl_provincia_fatturazione" name="cl_provincia_fatturazione" onchange="getCitta2();">
                                                <option value="">Seleziona una provincia</option>
                                                <option value=""></option>
                                                <?php selectProvince($row_data['cl_provincia_fatturazione'], "", $dbConn); ?>
                                            </select>-->
                                            <span class="tooltips">Provincia Fatturazione Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Provincia Fatturazione Cliente" data-content="Inserisci qui la provincia di fatturazione del cliente che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_comune_fatturazione">Città fatturazione</label>
                                            <input type="text" class="form-control" id="cl_comune_fatturazione" name="cl_comune_fatturazione" placeholder="Città fatturazione"
                                                   value="<?php echo $row_data['cl_comune_fatturazione']; ?>">
                                            <!--<select class="form-control" id="cl_citta_fatturazione" name="cl_citta_fatturazione">
                                                <option value="">Seleziona una citta'</option>
                                                <option value=""></option>
                                                <?php selectComuni($row_data['cl_comune_fatturazione'], $row_data['cl_provincia_fatturazione'], $dbConn); ?>
                                            </select>-->
                                            <span class="tooltips">Città Fatturazione Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Città Fatturazione Cliente" data-content="Inserisci qui la citt&agrave; di fatturazione del cliente che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="cl_indirizzo_fatturazione">Indirizzo fatturazione</label>
                                            <input type="text" class="form-control" id="cl_indirizzo_fatturazione" name="cl_indirizzo_fatturazione" placeholder="Indirizzo"
                                                   value="<?php echo $row_data['cl_indirizzo_fatturazione']; ?>">
                                            <span class="tooltips">Indirizzo Fatturazione Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Indirizzo Fatturazione Cliente" data-content="Inserisci qui l'indirizzo di fatturazione del cliente che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-1 mb-3">
                                            <label for="cl_cap_fatturazione">CAP fatturazione</label>
                                            <input type="text" class="form-control" id="cl_cap_fatturazione" name="cl_cap_fatturazione" placeholder="CAP" autocomplete="off"
                                                   value="<?php echo $row_data['cl_cap_fatturazione']; ?>">
                                            <span class="tooltips">C.A.P. Fatturazione Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="C.A.P. Fatturazione Cliente" data-content="Inserisci qui il C.A.P. di fatturazione del cliente che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <h6 class="card-title">Contatti e altro</h6>

                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_telefono">Telefono</label>
                                            <input type="text" class="form-control" id="cl_telefono" name="cl_telefono" placeholder="Telefono"
                                                   value="<?php echo $row_data['cl_telefono']; ?>">
                                            <span class="tooltips">Telefono Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Telefono Cliente" data-content="Inserisci qui il numero di telefono del cliente che stai modificando">[aiuto]</a></span>
                                        </div>


                                        <div class="col-md-2 mb-3">
                                            <label for="cl_fax">Fax</label>
                                            <input type="text" class="form-control" id="cl_fax" name="cl_fax" placeholder="Fax"
                                                   value="<?php echo $row_data['cl_fax']; ?>">
                                            <span class="tooltips">Fax Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Fax Cliente" data-content="Inserisci qui il numero di fax del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <!--<div class="col-md-2 mb-3">
                                            <label for="cl_tipo">Tipo *</label>
                                            <select class="form-control" id="cl_tipo" name="cl_tipo" required>
                                                <option value="">Seleziona un tipo</option>
                                                <option value=""></option>
                                                <option value="Rivenditore" <?php if($row_data['cl_tipo'] == 'Rivenditore') echo "selected"; ?>>Rivenditore</option>
                                                <option value="Cliente" <?php if($row_data['cl_tipo'] == 'Cliente') echo "selected"; ?>>Cliente</option>
                                            </select>
                                            <span class="tooltips">Tipologia Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Tipologia Cliente" data-content="Inserisci qui la tipologia del cliente che stai modificando">[aiuto]</a></span>
                                        </div>-->

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_email">Email *</label>
                                            <input type="email" class="form-control" id="cl_email" name="cl_email" placeholder="Email *"
                                                   value="<?php echo $row_data['cl_email']; ?>" required>
                                            <span class="tooltips">E-mail Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Indirizzo Cliente" data-content="Inserisci qui l'indirizzo e-mail di accesso al terminale del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="cl_password">Password</label>
                                            <input type="text" class="form-control" id="cl_password" name="cl_password" placeholder="Password"
                                                   value="<?php echo $row_data['cl_password']; ?>">
                                            <span class="tooltips">Indirizzo Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Indirizzo Cliente" data-content="Inserisci qui lapassword di accesso al terminale del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="cl_note">Note</label>
                                            <textarea class="form-control" id="cl_note" name="cl_note" placeholder="Note" rows="3"><?php echo $row_data['cl_note']; ?></textarea>
                                        </div>

                                    </div>

                                    <!--   <div class="form-group">

                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="cl_newsletter" name="cl_newsletter"
                                                    <?php if($row_data['cl_newsletter'] > 0) echo "checked"; ?>>
                                            <label class="custom-control-label" for="cl_newsletter">Newsletter</label>
                                        </div>

                                    </div>

                                   <h6 class="card-title">Tessera Ethos</h6>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="cl_codice_tessera">Codice tessera</label>
                                            <input type="text" class="form-control" id="cl_codice_tessera" name="cl_codice_tessera" placeholder="Codice tessera"
                                                   value="<?php echo $row_data['cl_codice_tessera']; ?>">
                                            <span class="tooltips">Codice Tessera Ethos Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Tessera Ethos Cliente" data-content="Inserisci qui il codice della tessera Ethos del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="cl_attivazione_tessera">Data attivazione tessera</label>
                                            <input type="text" class="form-control date-picker-default" id="cl_attivazione_tessera" name="cl_attivazione_tessera" placeholder="Data attivazione tessera"
                                                   value="<?php echo strlen($row_data['cl_attivazione_tessera']) > 0
                                                       ? date("d/m/Y", $row_data['cl_attivazione_tessera']) : ""; ?>">
                                            <span class="tooltips">Data Attivazione Tessera Ethos Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Data Attivazione Tessera Ethos Cliente" data-content="Inserisci qui la data di attivazione della tessera Ethos del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="cl_saldo_punti">Saldo punti</label>
                                            <input type="text" class="form-control pattern-number" id="cl_saldo_punti" name="cl_saldo_punti" placeholder="Saldo punti"
                                                   value="<?php echo $row_data['cl_saldo_punti']; ?>">
                                            <span class="tooltips">Saldo Punti Tessera Ethos Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Saldo Punti Tessera Ethos Cliente" data-content="Inserisci qui il saldo dei punti della tessera Ethos del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="cl_stato_tessera">Stato tessera</label>
                                            <select class="form-control" id="cl_stato_tessera" name="cl_stato_tessera">
                                                <option value="">Seleziona lo stato</option>
                                                <option value=""></option>
                                                <option value="1" <?php if($row_data['cl_stato_tessera'] == '1') echo "selected"; ?>>Attiva</option>
                                                <option value="0" <?php if($row_data['cl_stato_tessera'] == '0') echo "selected"; ?>>Non attiva</option>
                                            </select>
                                            <span class="tooltips">Stato Attivazione Tessera Ethos Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Attivazione Tessera Ethos Cliente" data-content="Inserisci qui lo stato di attivazione della tessera Ethos del cliente che stai modificando">[aiuto]</a></span>
                                        </div>

                                    </div>-->

                                    <input type="hidden" name="cl_id" value="<?php echo $get_cl_id; ?>">
                                    <button class="btn btn-success" type="submit">Modifica</button>

                                </form>
                            </div>
                        </div>

                    </div>

                </div>

                <!--================================= wrapper -->

                <!--================================= footer -->

                <?php include "inc/footer.php"; ?>

            </div><!-- main content wrapper end-->
        </div>
    </div>
</div>
<!--=================================
footer -->

<?php include "inc/javascript.php"; ?>

</body>

</html>
<?php include "../inc/db-close.php"; ?>