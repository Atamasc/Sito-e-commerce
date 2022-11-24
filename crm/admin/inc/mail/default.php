<?php
$body_mail = " 
				<html> 
					<head> 
						<title>$nl_mittente - Newsletter</title>  
						<style type='text/css'> 
							.boddy {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal; color:#000000;}
							.tabble {background-color:#fff; border: 0px solid #fff; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;	color:#000; }
							.little-tony {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#666; }
							.copyleft {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color:#999; }
						</style> 
					</head> 
				
					<body class='boddy'> 
						<center>
							<table width='600'>
								<tr>
									<td class='tabble' valign='top' align='center'>
										$corpo_newsletter
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<td class='tabble' valign='top' align='center'>
										<p>
											Visita il nostro sito web <a href='$rootBasePath_http'>$rootBasePath_http</a> per tutte le informazioni <br>
											Per ogni tua esigenza inviaci una mail a <a href='mailto:$rootBaseEmail' title='invia una email'>$rootBaseEmail</a>.
										</p>
										<p>
											<a href='https://www.facebook.com/pepino.shop.official/' title='Seguici su Facebook'><img src='".$rootBasePath_http."/assets/img/facebook.png' width='48'></a>
											&nbsp;
											<a href='https://www.instagram.com/profumeriepepino/' title='Seguici su Instagram'><img src='".$rootBasePath_http."/assets/img/instagram.png' width='48'></a>
										</p>
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
                                    <td class='little-tony' align='center'>
                                        Le email sono raccolte e inviate in base a quanto stabilito nel Decreto Legislativo n°196 del 30 giugno 2003 e ai sensi del GDPR - Regolamento (UE) 2016/679 DEL PARLAMENTO EUROPEO E DEL CONSIGLIO del 27 aprile 2016.<br>
                                        Le informazioni contenute nella presente comunicazione e le email sono destinate esclusivamente alle persone o alla Società sopraindicati. <br>
                                        La diffusione, distribuzione e/o copia del documento trasmesso da parte di qualsiasi soggetto diverso dal destinatario è proibita.<br>
                                        Se avete ricevuto questo messaggio per errore, vi preghiamo di distruggerlo e di informarci immediatamente per telefono ai recapiti indicati nella firma o inviando un messaggio all'indirizzo del mittente. <br><br>
                                        
                                        Se non desideri più ricevere comunicazioni via email da pepinoshop.com puoi inoltrare questo messaggio a info@pepinoshop.com dalla mail che desideri rimuovere con scritto nell'oggetto o
                                        nel corpo 'rimozione email newsletter' o cliccare sul link in basso.<br>
                                    </td>
                                </tr>
                                </tr>
                                    <td class='little-tony' align='center'>
                                        <a href='$rootBasePath_http/crm/newsletter-conferma-del-email.php?ne_id=$ne_id&ne_email=$ne_email'>Cancellami dalla newsletter</a>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                </tr>
                                    <td class='little-tony' align='center'>
                                        <strong><b>QUESTA EMAIL TI ARRIVA NELLO SPAM ?</b></strong><br>
                                        Se la mail ti finisce nella cartella 'spam' del tuo provider per errore, ti chiediamo la gentilezza di spostarla nella \"posta in arrivo\", in questo modo ci aiuterai
                                        a migliorare l'invio ed eviterai di perdere notizie utili.
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td align='center' class='copyleft'>
                                        Email inviata dal sito web <br>
                                        <a href='https://www.pepinoshop.com'>PEPINOSHOP.COM</a>
                                    </td>
                                </tr>
								
							</table>
						</center>
					</body> 
				</html> 
				";
?>