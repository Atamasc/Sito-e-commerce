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

<table width="1800" height="500" border="1">
	<tr>
		<td widht="100%" align="center">
			<strong>IMPORTAZIONE ARTICOLI</strong>		
		</td>
	</tr>
	<tr>
		<td height="450" valign="top">
			<table width="100%" border="0" border="1">
				<tr>
					<td><strong>Codice</strong></td>
					<td><strong>Descrizione Breve</strong></td>
					<td><strong>Famiglia</strong></td>
                    <td><strong>Marchio</strong></td>
                    <td><strong>Linea</strong></td>
					<td><strong>Prezzo</strong></td>
                    <td><strong>Prezzo scontato</strong></td>
                    <td><strong>Immagine</strong></td>
					<td><strong>Lenght</strong></td>
					<td><strong>Riga</strong></td>
					<td><strong>Affected</strong></td>
					<td><strong>Error</strong></td>
				</tr>
				<?php
					// path completo del file in locale
					//$clienti_xml = "C:/Inetpub/wwwroot/TESINFORMATICA/dellamonica/crm/import/xml/WGArticoli.xml"; 
					$articoli_xml = "../../ftp/xml/WGArticoli.xml";
					
					// path completo del file in remoto
					//$clienti_csv = "/var/www/vhosts/myservercloud.it/httpdocs/trem/webapp/as400/csv/clienti.csv"; 
					
					// apriamo il file in modalit� lettura
                    $content = utf8_encode(file_get_contents($articoli_xml));
                    $xml = simplexml_load_string($content);
                    //$content = html_entity_decode($articoli_xml, ENT_QUOTES, "utf-8");
					//$xml = simplexml_load_file($content);
					
					$articoli_element_xml = $xml->Articoli->Articolo;

					//Cancello i dati della tabella di riferimento
					$querySql = "TRUNCATE TABLE pr_prodotti";
					$result = $dbConn->query($querySql);
					$rows = $dbConn->affected_rows;

					//Reset indici contatore mysql
					$querySql = "ALTER TABLE pr_prodotti AUTO_INCREMENT = 1";
					$result = $dbConn->query($querySql);
					$rows = $dbConn->affected_rows;
					
					/*
					//Cancello i dati della tabella di riferimento
					$querySql = "DELETE FROM mr_marchi";
					$result = $dbConn->query($querySql);
					$rows = $dbConn->affected_rows;
					
					//Reset indici contatore mysql
					$querySql = "ALTER TABLE mr_marchi AUTO_INCREMENT = 1";
					$result = $dbConn->query($querySql);
					$rows = $dbConn->affected_rows;
					*/
					
					// creo un ciclo che scorre tutto il file
					// indicando che i campi sono divisi tra loro da una virgola (,)
					// assegno le variabili per ogni campo del file ed infine stampo a video il risultato con un echo
					
					//TRACCIATO RECORD
					/*
					0  CustomerID 
					1  Customer GUID
					2  Email    
					3  Username 
					4  PasswordHash 
					5  SaltKey  
					*/
					
					$serialDate = time();
					
					$i = 1;
					foreach($articoli_element_xml as $item) {

					    /*
					    echo "CodiceArticolo:".$item->CodiceArticolo."<br />";
                        echo "Posizione:".$item->Posizione."<br />";
						echo "CodiceEAN:".$item->CodiceEAN."<br />";
						echo "DescrizioneBreve:".$item->DescrizioneBreve."<br />";
						echo "DescrizioneEstesa:".$item->DescrizioneEstesa."<br />";
						echo "Formato:".$item->Formato."<br />";
						echo "CodiceFamiglia:".$item->CodiceFamiglia."<br />";
						echo "DescrizioneFamiglia:".$item->DescrizioneFamiglia."<br />";
						echo "CodiceMarchio:".$item->CodiceMarchio."<br />";
						echo "DescrizioneMarchio:".$item->DescrizioneMarchio."<br />";
						echo "CodiceLinea:".$item->CodiceLinea."<br />";
						echo "DescrizioneLinea:".$item->DescrizioneLinea."<br />";
						echo "CodiceMerceologia:".$item->CodiceMerceologia."<br />";
						echo "DescrizioneMerceologia:".$item->DescrizioneMerceologia."<br />";
						echo "CodiceReparto:".$item->CodiceReparto."<br />";
						echo "DescrizioneReparto:".$item->DescrizioneReparto."<br />";
						echo "CodiceIVA:".$item->CodiceIVA."<br />";
						echo "Prezzo:".$item->Prezzo."<br />";
						echo "Sconto:".$item->Sconto."<br />";
						echo "PrezzoScontato:".$item->PrezzoScontato."<br />";
						echo "FlagVetrina:".$item->FlagVetrina."<br />";
						echo "FlagNovita:".$item->FlagNovita."<br />";
						echo "FlagPromo:".$item->FlagPromo."<br />";
						echo "Esistenza:".$item->Esistenza."<br />";
						echo "Ordinato:".$item->Ordinato."<br />";
						echo "ImageFileName:".$item->ImageFileName."<br />";
                        echo "ImageFileName2:".$item->ImageFileName2."<br />";
                        echo "ImageFileName3:".$item->ImageFileName3."<br />";
                        echo "ImageFileNameS:".$item->ImageFileNameS."<br />";
                        echo "CodiceAlternativo:".$item->CodiceAlternativo."<br /><br />";
					    */
						
						$pr_ct_id = '0';
						$pr_st_id = '0';
						$pr_mr_id = '0';
						$CodiceArticolo = trim($item->CodiceArticolo);
                        $Posizione = trim($item->Posizione);
						//$CodiceArticolo = str_replace(" ", "", $CodiceArticolo);
						
						$CodiceEAN = trim($item->CodiceEAN);
						$DescrizioneBreve = trim($item->DescrizioneBreve);
						$DescrizioneEstesa = trim($item->DescrizioneEstesa);
						$Formato = trim($item->Formato);
						$CodiceFamiglia = trim($item->CodiceFamiglia);
						$DescrizioneFamiglia = trim($item->DescrizioneFamiglia);
						$CodiceMarchio = trim($item->CodiceMarchio);
						$DescrizioneMarchio = trim($item->DescrizioneMarchio);
						$CodiceLinea = trim($item->CodiceLinea);
						$DescrizioneLinea = trim($item->DescrizioneLinea);
						$CodiceMerceologia = trim($item->CodiceMerceologia);
						$DescrizioneMerceologia = trim($item->DescrizioneMerceologia);
						$CodiceReparto = trim($item->CodiceReparto);
						$DescrizioneReparto = trim($item->DescrizioneReparto);
						$CodiceIVA = trim($item->CodiceIVA);
						$Prezzo = trim($item->Prezzo);
						$Sconto = trim($item->Sconto);
						$PrezzoScontato = trim($item->PrezzoScontato);
						$FlagVetrina = trim($item->FlagVetrina);
						$FlagNovita = trim($item->FlagNovita);
						$FlagPromo = trim($item->FlagPromo);
						$Esistenza = trim($item->Esistenza);
						$Ordinato = trim($item->Ordinato);
						$ImageFileName = strtolower(trim($item->ImageFileName));
                        $ImageFileName2 = strtolower(trim($item->ImageFileName2));
                        $ImageFileName3 = strtolower(trim($item->ImageFileName3));
                        $ImageFileNameS = strtolower(trim($item->ImageFileNameS));
                        $CodiceAlternativo = trim($item->CodiceAlternativo);

						$DescrizioneBreve = $dbConn->real_escape_string(trim($DescrizioneBreve));
						$DescrizioneEstesa = $dbConn->real_escape_string(trim($DescrizioneEstesa));
						$DescrizioneFamiglia = $dbConn->real_escape_string(trim($DescrizioneFamiglia));
						$DescrizioneMarchio = $dbConn->real_escape_string(trim($DescrizioneMarchio));
						$DescrizioneLinea = $dbConn->real_escape_string(trim($DescrizioneLinea));
						$DescrizioneMerceologia = $dbConn->real_escape_string(trim($DescrizioneMerceologia));
						$DescrizioneReparto = $dbConn->real_escape_string(trim($DescrizioneReparto));

                        /*
						$DescrizioneEstesa = str_replace(array('\r', '\n'), array("\r", "\n"), $DescrizioneEstesa);
                        $DescrizioneBreve = str_replace("�", "", $DescrizioneBreve);
                        $DescrizioneBreve = str_replace("�", "a", $DescrizioneBreve);
                        $DescrizioneBreve = str_replace("&#224;", "&agrave;", $DescrizioneBreve);
                        $DescrizioneBreve = str_replace("&#133;", "", $DescrizioneBreve);
                        $CodiceArticolo = str_replace(" ", "-", $CodiceArticolo);
                        */
                        $DescrizioneEstesa = str_replace("&#3;", " ", $DescrizioneEstesa);

                        $DescrizioneMerceologia = utf8_decode($DescrizioneMerceologia);
                        $DescrizioneLinea = utf8_decode($DescrizioneLinea);
                        $DescrizioneMarchio = utf8_decode($DescrizioneMarchio);
                        $DescrizioneFamiglia = utf8_decode($DescrizioneFamiglia);
                        $DescrizioneEstesa = utf8_decode($DescrizioneEstesa);
                        $DescrizioneBreve = utf8_decode($DescrizioneBreve);

                        $CodiceArticolo = str_replace(" ", "", $CodiceArticolo);
                        $CodiceAlternativo = str_replace(" ", "", $CodiceAlternativo);

                        if ($CodiceAlternativo == '') {
                            $CodiceAlternativo = $CodiceArticolo;
                        }

                        $querySql =
                            "INSERT INTO pr_prodotti (" .
                            "pr_ct_id, pr_st_id, pr_mr_id, pr_codice, pr_posizione, pr_codice_ean, pr_descrizione_breve, pr_descrizione_estesa, " .
                            "pr_formato, pr_fm_codice, pr_fm_descrizione, pr_codice_marchio, pr_descrizione_marchio, pr_codice_linea, " .
                            "pr_descrizione_linea, pr_codice_merceologia, pr_descrizione_merceologia, pr_codice_reparto, pr_descrizione_reparto, " .
                            "pr_codice_iva, pr_prezzo, pr_sconto, pr_prezzo_scontato, pr_vetrina, pr_novita, pr_promo, pr_esistenza, " .
                            "pr_ordinato, pr_immagine, pr_immagine_2, pr_immagine_3, pr_immagine_mini, pr_codice_alternativo, pr_stato, pr_timestamp" .
                            ") VALUES (" .
                            "$pr_ct_id,$pr_st_id,$pr_mr_id,'$CodiceArticolo','$Posizione','$CodiceEAN','$DescrizioneBreve','$DescrizioneEstesa'," .
                            "'$Formato','$CodiceFamiglia','$DescrizioneFamiglia','$CodiceMarchio','$DescrizioneMarchio','$CodiceLinea'," .
                            "'$DescrizioneLinea','$CodiceMerceologia','$DescrizioneMerceologia','$CodiceReparto','$DescrizioneReparto'," .
                            "'$CodiceIVA','$Prezzo','$Sconto','$PrezzoScontato','$FlagVetrina','$FlagNovita','$FlagPromo','$Esistenza'," .
                            "'$Ordinato','$ImageFileName','$ImageFileName2','$ImageFileName3','$ImageFileNameS','$CodiceAlternativo','1','$serialDate')";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        echo "<tr>";
                        //echo "<td class='labelTd'>".$ID."</td>";
                        echo "<td class='labelTd'>".$CodiceArticolo."</td>";
                        echo "<td class='labelTd'>".$DescrizioneBreve."</td>";
                        echo "<td class='labelTd'>".$CodiceFamiglia." / ".$DescrizioneFamiglia."</td>";
                        echo "<td class='labelTd'>".$CodiceMarchio." / ".$DescrizioneMarchio."</td>";
                        echo "<td class='labelTd'>".$CodiceLinea." / ".$DescrizioneLinea."</td>";
                        echo "<td class='labelTd'>".$Prezzo."</td>";
                        echo "<td class='labelTd'>".$PrezzoScontato."</td>";
                        echo "<td class='labelTd'>".$ImageFileName."</td>";
                        echo "<td class='labelTd'>".$i."</td>";
                        echo "<td class='labelTd'>".$dbConn->affected_rows."</td>";
                        echo "<td class='labelTd'>".$dbConn->error."</td>";
                        echo "</tr>";

                        $i += 1;
					};

                $querySqlLog =
                    "INSERT INTO li_log_import (" .
                    "li_data, li_tipo, li_stato" .
                    ") VALUES (" .
                    "'$serialDate','Articoli_full','1')";
                $result = $dbConn->query($querySqlLog);
                $rows = $dbConn->affected_rows;

					//echo"<br>sql:".$querySql;
					
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

