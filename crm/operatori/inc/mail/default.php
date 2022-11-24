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
								<tr>
									<td class='tabble' valign='top' align='center'>
										<p>
											Visita il nostro sito web <a href='$rootBasePath_http'>$rootBasePath_http</a> per tutte le informazioni <br>
											Per ogni tua esigenza inviaci una mail a <a href='mailto:$rootBaseEmail' title='invia una email'>$rootBaseEmail</a>.
										</p>
										<!--
										<p>
											<a href='https://www.facebook.com/lucasweb.it' title='Seguici su Facebook'><img src='".$rootBasePath_http."/cms/images/social-logo-facebook.png' width='64'></a> 
											&nbsp;
											<a href='https://plus.google.com/+LucaswebIt?hl=it' title='Seguici su GooglePlus'><img src='".$rootBasePath_http."/cms/images/social-logo-googleplus.png' width='64'></a> 
											&nbsp;
											<a href='https://twitter.com/lucaswebagency' title='Seguici su Twitter'><img src='".$rootBasePath_http."/cms/images/social-logo-twitter.png' width='64'></a> 
											&nbsp;
											<a href='mailto:info@lucasweb.it' title='invia una email'><img src='".$rootBasePath_http."/cms/images/social-logo-email.png' width='64'></a> 
										</p>
										-->
									</td>
								</tr>
								
								<tr>
                                    <td class='little-tony' align='center'>
                                    Le email sono raccolte e inviate in base a quanto stabilito nel Decreto Legislativo n°196 del 30 giugno 2003.<br> 
                                    Se non desideri più ricevere comunicazioni via email da lucasweb.it puoi inoltrare questo messaggio a info@lucasweb.it dalla mail che desideri rimuovere con scritto nell'oggetto o nel corpo 'rimozione email newsletter' o cliccare sul link in basso.<br>
                                    </td>
                                </tr>
                                </tr>
                                    <td align='center'>
                                    <a href='$rootBasePath_http/crm/newsletter-conferma-del-email.php?ne_id=$ne_id&ne_email=$ne_email'>Cancellami dalla newsletter</a>
                                    </td>
                                </tr>
                                
                                </tr>
                                    <td align='center'>
                                    QUESTA EMAIL TI ARRIVA NELLO SPAM ?<br>
                                    Se la mail ti finisce nella cartella 'spam' del tuo provider per errore, ti chiediamo la gentilezza di spostarla nella \"posta in arrivo\", in questo modo ci aiuterai a migliorare l'invio ed eviterai di perdere notizie utili.<br>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td align='center' class='copyleft'>
                                        Email inviata con il servizio <br>
                                        <a href='http://www.nuvolamail.it'>NUVOLAMAIL</a>
                                    </td>
                                </tr>
								
							</table>
						</center>
					</body> 
				</html> 
				";
?>