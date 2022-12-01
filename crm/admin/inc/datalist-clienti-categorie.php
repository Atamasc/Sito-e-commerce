<div class="col-xl-12 mb-10">
    <div class="card card-statistics h-100">
        <div class="card-body">

            <h5 class="card-title border-0 pb-0">Lista categorie</h5>

            <?php
            if (@$_GET['delete'] == 'true') {

                ?>
                <div class="alert alert-success" role="alert">
                    Eliminazione avvenuta con successo.
                </div>
                <?php

            }
            ?>

            <div class="table-responsive">

                <table class="table table-1 table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Nome</th>
                        <th style="text-align: center; width: 100px;">Stato</th>
                        <th style="text-align: center; width: 200px;">Gestione</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $querySql = "SELECT * FROM ct_categoria WHERE ct_id > 0 ORDER BY ct_id ";
                    $result = $dbConn->query($querySql);
                    $rows = $dbConn->affected_rows;

                    while (($row_data = $result->fetch_assoc()) !== NULL) {

                        $ct_id = $row_data['ct_id'];

                        echo "<tr>";
                        echo "<td>$ct_id</td>";
                        echo "<td>" . $row_data['ct_titolo'] . "</td>";

                        //Stato
                        $checked = $row_data['ct_stato'] > 0 ? "checked" : "";
                        ?>
                        <td align='center'>
                            <div class="checkbox checbox-switch switch-success">
                                <label> <input type="checkbox" class="stato"
                                            title="utenti-categorie-stato-do.php?ct_id=<?php echo $ct_id; ?>" <?php echo $checked; ?>><span></span>
                                </label>
                            </div>
                        </td>
                        <?php

                        //Gestione
                        echo "<td align='center'>";
                        echo "<a class='btn btn-success btn-sm' href='utenti-categorie-mod.php?ct_id=$ct_id' title='Modifica'>modifica</a>&nbsp;";
                        echo "<button class='btn btn-danger btn-sm elimina' data-href='utenti-categorie-del-do.php?ct_id=$ct_id'>elimina</button>";
                        echo "</td>";
                        echo "</tr>";

                        $i += 1;
                    };

                    if ($rows == 0) {
                        echo "<tr><td colspan='99' align='center'>Non ci sono categorie</td></tr>";
                    }

                    $result->close();
                    ?>

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>