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
                    <td><strong>Id Customer</strong></td>
                    <td><strong>Address 1</strong></td>
                    <td><strong>Postcode</strong></td>
                    <td><strong>City</strong></td>
                    <td><strong>Phone</strong></td>
                    <td><strong>Phone Mobile</strong></td>
                    <td><strong>Lenght</strong></td>
                    <td><strong>Riga</strong></td>
                    <td><strong>Affected</strong></td>
                    <td><strong>Error</strong></td>
                </tr>
                <?php
                // path completo del file in remoto
                $clienti_csv = "../csv/clienti_dettagli.csv";

                // apriamo il file in modalit?ettura
                $handle = fopen($clienti_csv, "r");

                //Cancello i dati della tabella di riferimento
                //$querySql = "DELETE FROM ut_utenti WHERE ut_id > 0 ";
                //$result = $dbConn->query($querySql);
                //$rows = $dbConn->affected_rows;

                //Reset indici contatore mysql
                //$querySql = "ALTER TABLE ut_utenti AUTO_INCREMENT = 1";
                //$result = $dbConn->query($querySql);
                //$rows = $dbConn->affected_rows;

                // creo un ciclo che scorre tutto il file
                // indicando che i campi sono divisi tra loro da una virgola (,)
                // assegno le variabili per ogni campo del file ed infine stampo a video il risultato con un echo

                //TRACCIATO RECORD
                /*
                0  id_customer
                1  Company
                2  Address 1
                3  Address 2
                4  Postcode
                5  City
                6  Other
                7  Phone
                8  Phone mobile
                */

                $serialDate = time();

                $i = 1;
                while ($data = fgetcsv($handle, 10000, ",")) {
                    if ($i > 1) {

                        //$ut_codice_create = $serialDate + $i;

                        //$id_customer = $data[0];
                        $id_customer = ( isset($data[0]) ) ? $id_customer = $data[0] : $id_customer = '';

                        //$ut_company = $data[1];
                        $ut_company = ( isset($data[1]) ) ? $ut_company = $data[1] : $ut_company = '';

                        //$ut_address_1 = $data[2];
                        $ut_address_1 = ( isset($data[2]) ) ? $ut_address_1 = $data[2] : $ut_address_1 = '';

                        //$ut_address_2 = $data[3];
                        $ut_address_2 = ( isset($data[3]) ) ? $ut_address_2 = $data[3] : $ut_address_2 = '';

                        //$ut_postcode = $data[4];
                        $ut_postcode = ( isset($data[4]) ) ? $ut_postcode = $data[4] : $ut_postcode = '';

                        //$ut_city = $data[5];
                        $ut_city = ( isset($data[5]) ) ? $ut_city = $data[5] : $ut_city = '';

                        //$ut_other = $data[6];
                        $ut_other = ( isset($data[6]) ) ? $ut_other = $data[6] : $ut_other = '';

                        //$ut_phone = $data[7];
                        $ut_phone = ( isset($data[7]) ) ? $ut_phone = $data[7] : $ut_phone = '';

                        //$ut_phone_mobile = $data[8];
                        $ut_phone_mobile = ( isset($data[8]) ) ? $ut_phone_mobile = $data[8] : $ut_phone_mobile = '';

                        $id_customer = $data[0];
                        $ut_company = $data[1];
                        $ut_address_1 = $data[2];
                        $ut_address_2 = $data[3];
                        $ut_postcode = $data[4];
                        $ut_city = $data[5];
                        $ut_other = $data[6];
                        $ut_phone = $data[7];
                        $ut_phone_mobile = $data[8];

                        $id_customer = $dbConn->real_escape_string(trim(stripslashes($id_customer)));
                        $ut_company = $dbConn->real_escape_string(trim(stripslashes($ut_company)));
                        $ut_address_1 = $dbConn->real_escape_string(trim(stripslashes($ut_address_1)));
                        $ut_address_2 = $dbConn->real_escape_string(trim(stripslashes($ut_address_2)));
                        $ut_postcode = $dbConn->real_escape_string(trim(stripslashes($ut_postcode)));
                        $ut_city = $dbConn->real_escape_string(trim(stripslashes($ut_city)));
                        $ut_other = $dbConn->real_escape_string(trim(stripslashes($ut_other)));
                        $ut_phone = $dbConn->real_escape_string(trim(stripslashes($ut_phone)));
                        $ut_phone_mobile = $dbConn->real_escape_string(trim(stripslashes($ut_phone_mobile)));

                        $querySql =
                            "UPDATE ut_utenti SET ut_ragione_sociale = '$ut_company', ut_indirizzo = '$ut_address_1', ut_indirizzo_2 = '$ut_address_2', ".
                            "ut_cap = '$ut_postcode', ut_citta = '$ut_city', ".
                            "ut_telefono = '$ut_phone', ut_cell = '$ut_phone_mobile' WHERE ut_id_customer = $id_customer";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        $color_tr = '#000000';
                        if ($dbConn->affected_rows == '-1') {
                            $color_tr = '#ff0000';
                        };

                        //echo $querySql;
                        //echo $ut_codice_create;

                        echo "<tr style='color: ".$color_tr."'>";
                        //echo "<td class='labelTd'>".$ID."</td>";
                        echo "<td class='labelTd'>".$id_customer."</td>";
                        echo "<td class='labelTd'>".$ut_address_1."</td>";
                        echo "<td class='labelTd'>".$ut_postcode."</td>";
                        echo "<td class='labelTd'>".$ut_city."</td>";
                        echo "<td class='labelTd'>".$ut_phone."</td>";
                        echo "<td class='labelTd'>".$ut_phone_mobile."</td>";
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