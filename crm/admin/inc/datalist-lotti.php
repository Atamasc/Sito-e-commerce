<div class="col-xl-12 mb-10">
    <div class="card card-statistics h-100">
        <div class="card-body">

            <h5 class="card-title border-0 pb-0">Lista lotti collegati</h5>

            <div class="table-responsive">

                <table class="table table-1 table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Codice lotto</th>
                        <th>Prodotto</th>
                        <th>Quantità</th>
                        <th style="width: 150px;">Data inserimento</th>
                        <th style="text-align: center; width: 100px;">Stato</th>
                        <th style="text-align: center; width: 100px;">Gestione</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $querySql =
                        "SELECT * FROM lt_lotti INNER JOIN pr_prodotti ON pr_id = lt_pr_id ".
                        "WHERE lt_cr_id = '$lt_cr_id' ".
                        "ORDER BY lt_timestamp ";
                    $result = $dbConn->query($querySql);
                    $rows = $dbConn->affected_rows;

                    while (($row_data = $result->fetch_assoc()) !== NULL) {

                        $lt_id = $row_data['lt_id'];

                        echo "<tr>";
                        echo "<td>".$row_data['lt_codice']."</td>";
                        echo "<td>".$row_data['pr_descrizione']."</td>";
                        echo "<td>".$row_data['lt_quantita']." ".$row_data['pr_um']."</td>";
                        echo "<td>".date("d/m/Y", $row_data['lt_timestamp'])."</td>";

                        //Stato
                        $checked = $row_data['lt_stato'] > 0 ? "checked" : "";
                        ?>
                        <td align='center'>
                            <div class="checkbox checbox-switch switch-success">
                                <label>
                                    <input type="checkbox" class="stato"
                                           title="lotti-stato-do.php?lt_id=<?php echo $lt_id; ?>" <?php echo $checked;?>><span></span>
                                </label>
                            </div>
                        </td>
                        <?php

                        //Gestione
                        echo "<td align='center'>";
                        //echo "<button class='btn btn-primary btn-sm modale' data-href='clienti-scheda-modale.php?cl_id=$cl_id' title='Visualizza scheda'>scheda cliente</button>&nbsp;";
                        echo "<a class='btn btn-success btn-sm' href='lotti-mod.php?lt_id=$lt_id' title='Modifica'>modifica</a>&nbsp;";
                        //echo "<button class='btn btn-danger btn-sm elimina' data-href='lotti-del-do.php?lt_id=$lt_id'><i class='far fa-trash-alt'></i></button>";
                        echo "</td>";
                        echo "</tr>";

                    }

                    if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono lotti collegati</td></tr>";

                    $result->close();
                    ?>

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>