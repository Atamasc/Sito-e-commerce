<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../inc/config.php"); ?>
<?php include("../inc/db-conn.php"); ?>
<?php include("../bin/core.php"); ?>
<?php include("../bin/function.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<meta name="author" content="lucasweb.it" />
	<title>Pepino Profumerie / Procedure di importazione dati CSV</title>
</head>

<body>

<table width="955" height="500" border="1">
	<tr>
		<td widht="100%" align="center">
			<strong>IMPORTAZIONE FAMIGLIE</strong>		
		</td>
	</tr>
	<tr>
		<td height="450" valign="top">
			<table width="100%" border="0" border="1">
				<tr>
					<td><strong>Codice</strong></td>
					<td><strong>Descrizione</strong></td>
					<td><strong>Lenght</strong></td>
					<td><strong>Riga</strong></td>
					<td><strong>Affected</strong></td>
					<td><strong>Error</strong></td>
				</tr>
				<?php
					// path completo del file in locale
					//$clienti_xml = "C:/Inetpub/wwwroot/TESINFORMATICA/dellamonica/crm/import/xml/WGFamiglie.xml"; 
					$famiglie_xml = "../../ftp/xml/WGFamiglie.xml";
					
					// path completo del file in remoto
					//$clienti_csv = "/var/www/vhosts/myservercloud.it/httpdocs/trem/webapp/as400/csv/clienti.csv"; 
					
					// apriamo il file in modalità lettura
					$xml = simplexml_load_file($famiglie_xml);
					//print_r($xml);
					
					$famiglie_element_xml = $xml->Famiglie->Famiglia;
										
					//Cancello i dati della tabella di riferimento
					$querySql = "TRUNCATE TABLE fm_famiglie";
					$result = $dbConn->query($querySql);
					$rows = $dbConn->affected_rows;
					
					//Reset indici contatore mysql
					$querySql = "ALTER TABLE fm_famiglie AUTO_INCREMENT = 1";
					$result = $dbConn->query($querySql);
					$rows = $dbConn->affected_rows;
					
					// creo un ciclo che scorre tutto il file
					// indicando che i campi sono divisi tra loro da una virgola (,)
					// assegno le variabili per ogni campo del file ed infine stampo a video il risultato con un echo
					
					//TRACCIATO RECORD
					/*
					0  CodiceFamiglia 
					1  DescrizioneFamiglia
					*/
					
					$serialDate = time();
					
					$i = 1;
					foreach($famiglie_element_xml as $item) {
				   		echo "CodiceFamiglia:".$item->CodiceFamiglia."<br />";
						echo "DescrizioneFamiglia:".$item->DescrizioneFamiglia."<br />";
						echo "PosizioneFamiglia:".$item->PosizioneFamiglia."<br />";
						
						$CodiceFamiglia = purifyString($item->CodiceFamiglia);
						$DescrizioneFamiglia = purifyString($item->DescrizioneFamiglia);
						$PosizioneFamiglia = purifyString($item->PosizioneFamiglia);
						
						$DescrizioneFamiglia = $dbConn->real_escape_string(trim($DescrizioneFamiglia));
						
						$querySql = "INSERT INTO fm_famiglie (fm_codice, fm_descrizione, fm_posizione, fm_stato) ".
                            "VALUES ('$CodiceFamiglia', '$DescrizioneFamiglia', '$PosizioneFamiglia', 1)";
						$result = $dbConn->query($querySql);
						$rows = $dbConn->affected_rows;
						
						$i += 1;
				   	}
   				
					echo "i:".$i;

                $querySqlLog =
                    "INSERT INTO li_log_import (" .
                    "li_data, li_tipo, li_stato" .
                    ") VALUES (" .
                    "'$serialDate','Famiglie','1')";
                $result = $dbConn->query($querySqlLog);
                $rows = $dbConn->affected_rows;
					
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

<?php include("../inc/db-close.php"); ?>
</body>
</html>

