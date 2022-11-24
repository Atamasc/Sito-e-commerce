<div class="col-xl-12 mb-10">
    <div class="card card-statistics h-100">
        <div class="card-body">

            <h5 class="card-title border-0 pb-0">Prodotto Capofila</h5>

            <div class="table-responsive h-100">

                <table class="table table-1 table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <th width="90">Immagine</th>
                        <th>
                            Codice <br>
                            Titolo
                        </th>

                        <th width="200">
                            Categoria <br>
                            Sottocategoria
                        </th>

                        <th width="180">
                            Prezzo <br>
                            Prezzo scontato (%)
                        </th>

                        <th width="130">
                            Marchio <br>
                            Sistema
                        </th>

                        <th width="130">
                            Peso KG.<br>
                            Giacenza Qta.
                        </th>

                        <th style="text-align: center; width: 200px;">Gestione</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    dataviewGetProdotto($get_pr_id);
                    function dataviewGetProdotto($pr_id) {

                        global $dbConn, $upload_path_dir_prodotti;

                        $querySql = "SELECT * FROM pr_prodotti WHERE pr_id = '$pr_id' ";
                        $result = $dbConn->query($querySql);

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $pr_id = $row_data['pr_id'];
                            $pr_ct_id = $row_data['pr_ct_id'];
                            $pr_st_id = $row_data['pr_st_id'];
                            $pr_codice = $row_data['pr_codice'];
                            $pr_capofila = $row_data['pr_capofila'];
                            $pr_titolo = $row_data['pr_titolo'];
                            $pr_giacenza = $row_data['pr_giacenza'];
                            $pr_peso = $row_data['pr_peso'];

                            $mr_marchio = getMarchio($row_data['pr_mr_id']);
                            $si_sistema = getSistema($row_data['pr_si_id']);

                            $pr_prezzo = $row_data['pr_prezzo'];
                            $pr_sconto = $row_data['pr_sconto'];
                            $pr_prezzo_scontato = $row_data['pr_prezzo_scontato'];

                            $categoria = getCategoria($pr_ct_id, $dbConn); //TODO cambiare con logica pr_
                            $sottocategoria = getSottocategoria($pr_st_id, $dbConn); //TODO cambiare con logica pr_

                            if ((strlen($row_data['pr_immagine']) > 0) && is_file("../../upload/prodotti/".$row_data['pr_immagine'])) {
                                $pr_immagine = $row_data['pr_immagine'];
                                $pr_immagine_src = $upload_path_dir_prodotti."/".$pr_immagine;
                            } else {
                                $pr_immagine_src = "../../assets/img/prodotto-dummy.jpg";
                            }

                            echo "<tr>";
                            echo "<td><a class='modale-img' href='$pr_immagine_src'><img src=".$pr_immagine_src." width='80px'></a></td>";

                            echo "<td>";
                            echo "<span style='font-style: italic'>".$pr_codice."</span><br>";
                            echo "<span>".$pr_titolo."</span>";
                            echo "</td>";

                            echo "<td>";
                            echo "<span style='font-style: italic'>".$categoria."</span><br>";
                            echo "<span>".$sottocategoria."</span>";
                            echo "</td>";

                            echo "<td>";
                            echo "<span style='font-style: italic'>&euro; ".$pr_prezzo."</span><br>";
                            echo "<span>&euro; ".$pr_prezzo_scontato." (".$pr_sconto." %)</span>";
                            echo "</td>";

                            echo "<td>";
                            echo "<span style='font-style: italic'>$mr_marchio</span><br>";
                            echo "<span style='font-style: italic'>$si_sistema</span>";
                            echo "</td>";

                            echo "<td>";
                            echo "<span style='font-style: italic'>Kg. ".$pr_peso."</span><br>";
                            echo "<span>Qt&agrave;:. ".$pr_giacenza."</span>";
                            echo "</td>";

                            //Gestione
                            echo "<td align='center'>"; ?>
                            <?php
                            echo "<a class='btn btn-sm btn-success' href='prodotti-mod.php?pr_id=$pr_id' title='Modifica prodotto'>modifica</a>&nbsp;";
                            echo "</td>";
                            echo "</tr>";

                        }

                        $result->close();

                    }
                    ?>

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>