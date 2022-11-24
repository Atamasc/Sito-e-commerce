<?php include "inc/autoloader.php"; ?>

<?php
$get_pr_id = (int)$_GET['pr_id'];

$querySql = "SELECT * FROM pr_prodotti WHERE pr_id = $get_pr_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();

$pr_um = $row_data['pr_um'];
?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Lotti in giacenza per il prodotto "<?php echo $row_data['pr_descrizione']; ?>"</h6>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">

    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-1 table-bordered table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Codice lotto</th>
                                <th>Data lotto</th>
                                <th>Codice Carico</th>
                                <th>Allegato Carico</th>
                                <th>Fornitore</th>
                                <th>Giacenza</th>
                                <!--<th style="text-align: center; width: 150px;">Gestione</th>-->
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $querySql  = "SELECT * FROM gi_giacenze ";
                            $querySql .= "INNER JOIN lt_lotti ON gi_giacenze.gi_lt_id = lt_lotti.lt_id ";
                            $querySql .= "INNER JOIN cr_carichi ON lt_lotti.lt_cr_id = cr_carichi.cr_id ";
                            $querySql .= "INNER JOIN fr_fornitori ON cr_carichi.cr_fr_id = fr_fornitori.fr_id ";
                            $querySql .= "WHERE gi_pr_id = '$get_pr_id' ";
                            $querySql .= "ORDER BY lt_timestamp DESC ";

                            $result = $dbConn->query($querySql);
                            $rows = $dbConn->affected_rows;

                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                $pr_id = $row_data['pr_id'];

                                echo "<tr>";
                                echo "<td>".$row_data['lt_codice']."</td>";
                                echo "<td>".date("d/m/Y", $row_data['lt_timestamp'])."</td>";
                                echo "<td>".$row_data['cr_codice']."</td>";
                                echo "<td><a href=".$upload_path_dir_carichi/$row_data['cr_allegato'].">vedi allegato</a></td>";
                                echo "<td>".$row_data['fr_ragione_sociale']."</td>";
                                echo "<td>".$row_data['gi_quantita']." $pr_um</td>";


                                //Gestione
                                //echo "<td align='center'>";
                                //echo "<a class='btn btn-primary btn-sm' href='#' title='Produzione'>produzione</a>&nbsp;";
                                //echo "</td>";
                                echo "</tr>";

                            }

                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono lotti</td></tr>";

                            $result->close();
                            ?>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>

    </div>

</div>