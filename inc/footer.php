<footer class="footer-area">
    <div class="footer-top">
        <div class="container" style="/* max-width: 1700px */">
            <div class="row" style="justify-content: space-between;">
                <!-- footer single wedget -->
                <div class="col-md-6 col-lg-4">
                    <!-- footer logo -->
                    <div class="footer-logo">
                        <a href="index"><img data-src="assets/images/logo/logo.png" alt="logo" style="max-width: 250px"/></a>
                    </div>
                    <!-- footer logo -->
                    <div class="about-footer">
                        <p class="text-info">
                            Il marketplace italiano per la vendita di caffè, macchine da caffè e prodotti collegati direttamente online.
                        </p>

                        <div class="need-help">
                            <p class="phone-info">
                                Bisogno di aiuto?
                                <a href="https://chatting.page/6t3qciy9d43q0pswmqjhu12poxh4gosb" target="_blank" style="color: #44ad2b;"><span style="color: #44ad2b;">Chatta con noi</span></a>
                            </p>
                        </div>

                        <div class="social-info">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/moncaffe.it"><i class="ion-social-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/moncaffe.it/"><i class="ion-social-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- footer single wedget -->
                <div class="col-md-6 col-lg-2 mt-res-sx-30px mt-res-md-30px" style="max-width: 140px">
                    <div class="single-wedge">
                        <h4 class="footer-herading">Men&ugrave;</h4>
                        <div class="footer-links">
                            <ul>
                                <li><a href="index">Home</a></li>
                                <li><a href="azienda">Azienda</a></li>
                                <li><a href="prodotti">Prodotti</a></li>
                                <li><a href="blog">Blog</a></li>
                                <li><a href="contatti">Contatti</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- footer single wedget -->
                <div class="col-md-6 col-lg-2 mt-res-md-50px mt-res-sx-30px mt-res-md-30px" <?php if (!isMobile()) { ?> style="max-width: 190px" <?php } ?> >
                    <div class="single-wedge">
                        <h4 class="footer-herading">Link Utili</h4>
                        <div class="footer-links">
                            <ul>
                                <li><a href="privacy-policy">Privacy Policy</a></li>
                                <li><a href="cookie-policy">Cookie Policy</a></li>
                                <li><a href="pagamenti">Pagamenti</a></li>
                                <li><a href="spedizioni">Spedizioni</a></li>
                                <li><a href="termini-condizioni">Termini & Condizioni</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-2 mt-res-sx-30px mt-res-md-30px" style="max-width: 140px">
                    <div class="single-wedge">
                        <h4 class="footer-herading">Account</h4>
                        <div class="footer-links">
                            <ul>
                                <?php
                                if ($session_cl_login == 0) {

                                    ?>
                                    <li><a href="login">Accedi</a></li>
                                    <li><a href="registrati">Registrati</a></li>
                                    <?php

                                } else {

                                    ?>
                                    <li><a href="my-account">Dashboard</a></li>
                                    <li><a href="carrello">Carrello</a></li>
                                    <li><a href="logout">Logout</a></li>
                                    <?php

                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- footer single wedget -->
                <div class="col-md-6 col-lg-4 mt-res-md-50px mt-res-sx-30px mt-res-md-30px">
                    <div class="single-wedge">
                        <h4 class="footer-herading">Newsletter</h4>
                        <div class="subscrib-text">
                            <p>Iscriviti e rimani aggiornato sulle ultime ed imperdibili offerte.</p>
                        </div>
                        <div id="mc_embed_signup" class="subscribe-form">
                            <form action="newsletter" method="get">
                                <div id="mc_embed_signup_scroll" class="mc-form">
                                    <input class="email" type="email" required="" placeholder="Inserisci la tua email..." name="email"/>
                                    <div class="clear">
                                        <input id="mc-embedded-subscribe" class="button" type="submit" value="Iscriviti"/>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- footer single wedget -->
            </div>
        </div>
    </div>
    <!--  Footer Bottom Area start -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <p class="copy-text">Copyright &copy; <?php echo date("Y"); ?> Smartex</p>
                    <p>Tutti i diritti riservati.</p>
                </div>
                <div class="col-md-6 col-lg-8">
                    <img class="payment-img" data-src="assets/images/icons/payment.png" alt=""/>
                </div>
            </div>
        </div>
    </div>
    <!--  Footer Bottom Area End-->
</footer>

<!-- BARRA COOKIE -->
<div class="div-cookie" style="background-color:rgba(38,55,69,.65); width: 100%; text-align: center; color: #fff; font-size: 10px; padding: 10px; position: fixed; bottom:0; z-index:99999999; display: none;">
    Questo sito utilizza cookie tecnici e di profilazione utente di terze parti. Per accettare la profilazione della navigazione e migliorare la tua esperienza utente leggi l'informativa.
    <a href="cookie-policy" style="display:inline-block; background-color:#3399ff; color:#fff; padding:0 10px; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" rel="nofollow">Cookie policy</a> &nbsp;
    <a class="btn-cookie" href="javascript:;" style=" display:inline-block; background-color:#009900; color:#fff; padding:0 10px; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px; ">Accetta i cookies</a>
</div>