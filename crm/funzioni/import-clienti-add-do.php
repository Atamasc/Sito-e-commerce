<?php include('../inc/config.php'); ?>
<?php include('../inc/db-conn.php'); ?>
<?php include('../bin/core.php'); ?>
<?php include('../bin/function.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta name="author" content="lucasweb.it" />
    <title>Pepinoshop / Procedure di importazione dati CSV</title>
</head>

<body>

<table width="955" height="500" border="1">
    <tr>
        <td widht="100%" align="center">
            <strong>IMPORTAZIONE CLIENTI</strong>
        </td>
    </tr>
    <tr>
        <td height="450" valign="top">
            <table width="100%" border="0" border="1">
                <tr>
                    <td><strong>Cliente</strong></td>
                    <td><strong>E-mail</strong></td>
                    <td><strong>Password</strong></td>
                    <td><strong>Data Nascita</strong></td>
                    <td><strong>Newsletter</strong></td>
                    <td><strong>Note</strong></td>
                    <td><strong>Lenght</strong></td>
                    <td><strong>Riga</strong></td>
                    <td><strong>Affected</strong></td>
                    <td><strong>Error</strong></td>
                </tr>
                <?php
                function dateToTimestampImport($date) {

                    list($year, $month, $day) = explode("-", $date);
                    return mktime(0, 0, 0, $month, $day, $year);

                }

                // path completo del file in remoto
                $clienti_csv = "../csv/clienti.csv";

                // apriamo il file in modalit?ettura
                $handle = fopen($clienti_csv, "r");

                //Cancello i dati della tabella di riferimento
                //$querySql = "DELETE FROM cl_clienti WHERE cl_id > 0 ";
                //$result = $dbConn->query($querySql);
                //$rows = $dbConn->affected_rows;

                //Reset indici contatore mysql
                //$querySql = "ALTER TABLE cl_clienti AUTO_INCREMENT = 1";
                //$result = $dbConn->query($querySql);
                //$rows = $dbConn->affected_rows;

                // creo un ciclo che scorre tutto il file
                // indicando che i campi sono divisi tra loro da una virgola (,)
                // assegno le variabili per ogni campo del file ed infine stampo a video il risultato con un echo

                //TRACCIATO RECORD
                /*
                0  id_customer
                1  Codice
                2  Nome
                3  Cognome
                4  Email
                5  Password
                6  Data nascita
                7  Newsletter
                8  Data
                */

                $serialDate = time();

                $i = 1;
                while ($data = fgetcsv($handle, 10000, ",")) {
                    if ($i > 1) {

                        $cl_codice_create = $serialDate + $i;

                        //$id_customer = $data[0];
                        $id_customer = ( isset($data[0]) ) ? $id_customer = $data[0] : $id_customer = '';

                        //$cl_nome = $data[1];
                        $cl_nome = ( isset($data[1]) ) ? $cl_nome = $data[1] : $cl_nome = '';

                        //$cl_cognome = $data[2];
                        $cl_cognome = ( isset($data[2]) ) ? $cl_cognome = $data[2] : $cl_cognome = '';

                        //$cl_email = $data[3];
                        $cl_email = ( isset($data[3]) ) ? $cl_email = $data[3] : $cl_email = '';

                        //$cl_password = $data[4];
                        $cl_password = ( isset($data[4]) ) ? $cl_password = $data[4] : $cl_password = '';

                        //$cl_data_nascita = $data[5];
                        $cl_data_nascita = ( isset($data[5]) ) ? $cl_data_nascita = $data[5] : $cl_data_nascita = '';

                        //$cl_newsletter = $data[6];
                        $cl_newsletter = ( isset($data[6]) ) ? $cl_newsletter = $data[6] : $cl_newsletter = '';

                        //$cl_data = $data[7];
                        $cl_data = ( isset($data[7]) ) ? $cl_data = $data[7] : $cl_data = '';

                        $id_customer = $data[0];
                        $cl_nome = $data[1];
                        $cl_cognome = $data[2];
                        $cl_email = $data[3];
                        $cl_password = $data[4];
                        $cl_data_nascita = $data[5];
                        $cl_newsletter = $data[6];
                        $cl_data = $data[7];

                        $id_customer = $dbConn->real_escape_string(trim(stripslashes($id_customer)));
                        $cl_nome = $dbConn->real_escape_string(trim(stripslashes($cl_nome)));
                        $cl_cognome = $dbConn->real_escape_string(trim(stripslashes($cl_cognome)));
                        $cl_email = $dbConn->real_escape_string(trim(stripslashes($cl_email)));
                        $cl_password = $dbConn->real_escape_string(trim(stripslashes($cl_password)));
                        $cl_data_nascita = dateToTimestampImport($dbConn->real_escape_string(trim(stripslashes($cl_data_nascita))));
                        $cl_newsletter = $dbConn->real_escape_string(trim(stripslashes($cl_newsletter)));
                        $cl_data = dateToTimestampImport($dbConn->real_escape_string(trim(stripslashes($cl_data))));

                            $querySql = "INSERT INTO cl_clienti (";

                            $querySql .= "cl_id_customer, cl_codice, cl_nome, cl_cognome, cl_email, cl_password, ";
                            $querySql .= "cl_data_nascita, cl_newsletter, cl_data, cl_stato ";

                            $querySql .= ") VALUES (";

                            $querySql .= "'".$id_customer."','".$cl_codice_create."','".$cl_nome."','".$cl_cognome."','".$cl_email."',";
                            $querySql .= "'".$cl_password."','".$cl_data_nascita."','".$cl_newsletter."','".$cl_data."','1'";

                            $querySql .= ")";

                            $result = $dbConn->query($querySql);

                        $color_tr = '#000000';
                        if ($dbConn->affected_rows == '-1') {
                            $color_tr = '#ff0000';
                        };

                        //echo $querySql;
                        //echo $cl_codice_create;

                        echo "<tr style='color: ".$color_tr."'>";
                        //echo "<td class='labelTd'>".$ID."</td>";
                        echo "<td class='labelTd'>".$cl_nome." ".$cl_cognome."</td>";
                        echo "<td class='labelTd'>".$cl_email."</td>";
                        echo "<td class='labelTd'>".$cl_password."</td>";
                        echo "<td class='labelTd'>".$cl_data_nascita."</td>";
                        echo "<td class='labelTd'>".$cl_newsletter."</td>";
                        echo "<td class='labelTd'>".$cl_note."</td>";
                        echo "<td class='labelTd'>".$i."</td>";
                        echo "<td class='labelTd'>".$dbConn->affected_rows."</td>";
                        echo "<td class='labelTd'>".$dbConn->error."</td>";
                        echo "</tr>";

                        $i += 1;
                        $rows = $dbConn->affected_rows;
                    };

                    $i += 1;
                };

                fclose($handle);
                // infine chiudo il riferimento al file
                ?>
            </table>
            <!-- FINE TABELLA -->
        </td>
    </tr>
    <tr>
        <td widht="100%" align="right">
            <a href="../admin/strumenti-importazioni-dati.php">torna alla lista file csv</a>
        </td>
    </tr>
</table>

<?php include("../inc/copy-inner.php"); ?>
<?php include("../inc/db-close.php"); ?>
</body>
</html>
