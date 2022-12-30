<?php
pageGetVarianti($pr_capofila);
function pageGetVarianti($pr_capofila)
{

    global $dbConn, $get_pr_id;

    $querySql = "SELECT * FROM pr_prodotti WHERE pr_stato > 0 AND pr_capofila = '$pr_capofila' AND pr_id != '$get_pr_id' ";
    $querySql .= " ORDER BY CAST(pr_prezzo AS DECIMAL(10,2)) ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    if ($rows > 0) {

        ?>
        <hr>
        <h5>Altri modelli </h5>
        <div class="product-details-table table-responsive pro-details-quality" style="padding-top: 10px;">
            <table class="table">
                <tbody>

                <?php
                while (($row_data = $result->fetch_assoc()) !== NULL) {

                    $pr_id = $row_data['pr_id'];
                    $pr_codice = $row_data['pr_codice'];

                    $pr_prezzo = @$row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);
                    $pr_link = generateProductLink($pr_id);

                    $mr_marche = @getMarca($row_data['pr_mr_id']);
                    ?>

                    <tr>
                        <td>
                            <a href="<?php echo $pr_link; ?>"><?php echo $row_data['pr_titolo']; ?></a>
                        </td>
                        <td>
                            <?php if ($row_data['pr_prezzo_scontato'] > 0) { ?>
                                <?php if ($row_data['pr_prezzo_scontato'] == $row_data['pr_prezzo']) { ?>
                                    <span class="current-price" style="font-size: 14px!important;">&euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></span>
                                <?php } else { ?>
                                    <span class="old-price" style="font-size: 14px!important;">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></span>
                                    <span class="current-price" style="font-size: 14px!important;">&euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></span>
                                <?php } ?>
                            <?php } else { ?>
                                <span class="current-price" style="font-size: 14px!important;">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></span>
                            <?php } ?>
                            <!--<span class="amount">?165.00</span>-->
                        </td>
                        <td style="width: 70px;">
                            <!--
                            <div class="quantity d-flex">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                </div>
                            </div>
                            -->

                            <div class="pro-details-cart btn-hover" style="display: flex; justify-content: center;">

                                <?php if ($row_data['pr_giacenza'] > 5) { ?>

                                    <?php if (strlen($row_data['pr_prezzo']) < 1 && strlen($row_data['pr_prezzo_scontato']) < 1) { ?>
                                        <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                    <?php } else { ?>
                                        <a href="javascript:;" class="button carrello-add" data-codice="<?php echo $pr_codice; ?>" style="padding: 0 20px; color: #fff; max-width: 60px;">
                                            <i class="fa fa-cart-plus"></i> </a>
                                    <?php }; ?>

                                <?php } else if ($row_data['pr_giacenza'] > 1) { ?>
                                    <span style="color: #FF7D27; font-weight: bold;">In esaurimento</span>
                                <?php } else { ?>
                                    <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                <?php } ?>

                            </div>
                        </td>
                    </tr>

                    <?php

                }

                $result->close();
                ?>

                </tbody>
            </table>
        </div>
        <?php


    }

}

?>