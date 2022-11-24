<?php include "../../../inc/db-conn.php"; ?>
<?php include "../../../inc/config.php"; ?>
<?php include "../../../bin/function.php"; ?>

    <!DOCTYPE html>
    <html lang="it" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta charset="ISO-8859-1"> <!-- utf-8 works for most cases -->
        <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
        <meta name="x-apple-disable-message-reformatting">	<!-- Disable auto-scale in iOS 10 Mail entirely -->
        <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

        <!-- Web Font / @font-face : BEGIN -->
        <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

        <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
        <!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
        <![endif]-->

        <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
        <!--[if !mso]><!-->
        <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
        <!--<![endif]-->

        <!-- Web Font / @font-face : END -->

        <!-- CSS Reset -->
        <style>


            /* What it does: Remove spaces around the email design added by some email clients. */
            /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
            html,
            body {
                margin: 0 auto !important;
                padding: 0 !important;
                height: 100% !important;
                width: 100% !important;
            }

            /* What it does: Stops email clients resizing small text. */
            * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            /* What it does: Centers email on Android 4.4 */
            div[style*="margin: 16px 0"] {
                margin:0 !important;
            }

            /* What it does: Stops Outlook from adding extra spacing to tables. */
            table,
            td {
                mso-table-lspace: 0pt !important;
                mso-table-rspace: 0pt !important;
            }

            /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
            table {
                border-spacing: 0 !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                margin: 0 auto !important;
            }
            table table table {
                table-layout: auto;
            }

            /* What it does: Uses a better rendering method when resizing images in IE. */
            img {
                -ms-interpolation-mode:bicubic;
            }

            /* What it does: A work-around for email clients meddling in triggered links. */
            *[x-apple-data-detectors],	/* iOS */
            .x-gmail-data-detectors, 	/* Gmail */
            .x-gmail-data-detectors *,
            .aBn {
                border-bottom: 0 !important;
                cursor: default !important;
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
            .a6S {
                display: none !important;
                opacity: 0.01 !important;
            }
            /* If the above doesn't work, add a .g-img class to any image in question. */
            img.g-img + div {
                display:none !important;
            }

            /* What it does: Prevents underlining the button text in Windows 10 */
            .button-link {
                text-decoration: none !important;
            }

            /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
            /* Create one of these media queries for each additional viewport size you'd like to fix */
            /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */
            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
                .email-container {
                    min-width: 375px !important;
                }
            }

        </style>

        <!-- Progressive Enhancements -->
        <style>

            /* What it does: Hover styles for buttons */
            .button-td,
            .button-a {
                transition: all 100ms ease-in;
            }
            .button-td:hover,
            .button-a:hover {
                background: #555555 !important;
                border-color: #555555 !important;
            }

            /* Media Queries */
            @media screen and (max-width: 600px) {

                .email-container {
                    width: 100% !important;
                    margin: auto !important;
                }

                /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
                .fluid {
                    max-width: 100% !important;
                    height: auto !important;
                    margin-left: auto !important;
                    margin-right: auto !important;
                }

                /* What it does: Forces table cells into full-width rows. */
                .stack-column,
                .stack-column-center {
                    display: block !important;
                    width: 100% !important;
                    max-width: 100% !important;
                    direction: ltr !important;
                }
                /* And center justify these ones. */
                .stack-column-center {
                    text-align: center !important;
                }

                /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
                .center-on-narrow {
                    text-align: center !important;
                    display: block !important;
                    margin-left: auto !important;
                    margin-right: auto !important;
                    float: none !important;
                }
                table.center-on-narrow {
                    display: inline-block !important;
                }

                /* What it does: Adjust typography on small screens to improve readability */
                .email-container p {
                    font-size: 17px !important;
                    line-height: 22px !important;
                }

            }

        </style>

        <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
        <!--[if gte mso 9]>
        <xml>
            <o:OfficeDocumentSettings>
                <o:AllowPNG/>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->

    </head>
    <body width="100%" bgcolor="#ffffff" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%;  text-align: left;">

        <!-- Visually Hidden Preheader Text : BEGIN -->



        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            Una selezionde dei migliori post del blog Lucasweb
        </div>

        <!-- Visually Hidden Preheader Text : END -->

        <!-- Email Header : BEGIN -->
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container custom-background">
            <tr>
                <td style="padding: 20px 0; text-align: center">
                    <img src="<?php echo $rootBasePath_http; ?>/crm/images/logo.png" width="270" height="121" alt="alt_text" border="0" style="height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                </td>
            </tr>
        </table>
        <!-- Email Header : END -->

        <!-- Email Body : BEGIN -->
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container  custom-background">

            <!-- Hero Image, Flush : BEGIN -->
            <tr>
                <td bgcolor="#eeeeee">
                    <img src="<?php echo $rootBasePath_http; ?>/email/hero.png" width="600" height="" alt="alt_text" border="0" align="center" style="width: 100%; max-width: 600px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;" class="g-img">
                </td>
            </tr>
            <!-- Hero Image, Flush : END -->

            <!-- 1 Column Text + Button : BEGIN -->
            <tr>
                <td bgcolor="#eeeeee" style="padding: 40px 40px 20px; text-align: center;">
                    <h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #333333; font-weight: normal;">Il blog di Lucasweb &egrave; tornato!</h1>
                </td>
            </tr>
            <tr>
                <td bgcolor="#eeeeee" style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: center;">
                    <p style="margin: 0;">
                        Tantissimi nuovi articoli e guide sul mondo del web. <br /> Ecco una selezione degli ultimi post che potrebbero interessarti:
                    </p>
                </td>
            </tr>
            <!--
            <tr>
                <td bgcolor="#ffffff" style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                        <tr>
                            <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                                <a href="http://www.google.com" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff;">A Button</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                </a>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
            -->
            <!-- 1 Column Text + Button : END -->

            <?php
            $get_nb_id = isset($_GET['nb_id']) ? (int)$_GET['nb_id'] : 0;

            $querySql = "SELECT * FROM nb_newsletter_blog WHERE nb_id = $get_nb_id ";
            $result = $dbConn->query($querySql);
            $row_data = $result->fetch_assoc();

            $nb_bl_prim = $row_data["nb_bl_prim"];
            $nb_bl_sec = explode("|", $row_data["nb_bl_sec"]);

            $result->close();

            $count = count($nb_bl_sec);
            $nb_bl_sec = join("','", $nb_bl_sec);

            for($i = 0; $i < $count; $i += 2) {
                ?>
                <!-- 2 Even Columns : BEGIN -->
                <tr>
                    <td bgcolor="#eeeeee" align="center" valign="top" style="padding: 10px;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>

                                <?php

                                $limit = $i + 2;
                                $querySql_bl = "SELECT * FROM bl_blog INNER WHERE bl_id IN ('$nb_bl_sec') LIMIT $i, $limit ";
                                $result_bl = $dbConn->query($querySql_bl);
                                while ($row_data_bl = $result_bl->fetch_assoc()) {

                                    $bl_id = $row_data_bl['bl_id'];
                                    $bl_titolo = $row_data_bl['bl_titolo'];
                                    $bl_url = generateURLRewrite($bl_titolo);

                                    //$google_param = "?utm_source=newsletter&utm_medium=blog&utm_campaign=lista&utm_term=$bc_titolo&utm_content=".$row_data_bl['bl_url'];
                                    $link_bl = "$rootBasePath_http/blog/$bl_url-$bl_id";

                                    $link_bl = base64_encode($link_bl);
                                    ?>
                                    <!-- Column : BEGIN -->
                                    <td class="stack-column-center">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="padding: 10px; text-align: center">
                                                    <img src="<?php echo $rootBasePath_http; ?>/upload/blog/<?php echo $row_data_bl['bl_immagine']; ?>" width="270" height="205" alt="<?php echo $bl_titolo; ?>" border="0" class="fluid" style="height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0 10px 10px; text-align: left;" class="center-on-narrow">
                                                    <a href="<?php echo $link_bl; ?>" style="text-decoration:none;"><h4 style="margin-top:0; margin-bottom:5px; color:#d02a3e;"><?php echo $bl_titolo; ?></h4></a>
                                                    <p style="margin: 0;"><?php echo $row_data_bl['bl_abstract']; ?></p>
                                                    <a href="<?php echo $link_bl; ?>">Leggi l'articolo completo &raquo;</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <!-- Column : END -->
                                    <?php

                                }
                                $result_bl->close();

                                ?>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- 2 Even Columns : END -->

            <?php } ?>


            <!-- Clear Spacer : BEGIN -->
            <tr>
                <td aria-hidden="true" height="40" style="font-size: 0; line-height: 0;">
                    &nbsp;
                </td>
            </tr>
            <!-- Clear Spacer : END -->

        </table>
        <!-- Email Body : END -->

        <?php include "footer.php"; ?>

    </center>
    </body>
    </html>

<?php include "../../../inc/db-close.php"; ?>