<div class="brand-area">
    <div class="container">
        <div class="brand-slider owl-carousel owl-nav-style owl-nav-style-2">

            <?php

            $querySql = "SELECT * FROM mr_marche WHERE mr_stato > 0 ORDER BY RAND(), mr_marche LIMIT 0, 10";
            $result = $dbConn->query($querySql);

            while ($row_data = $result->fetch_assoc()) {

                $mr_marche = $row_data['mr_marche'];
                $mr_immagine = strlen($row_data['mr_immagine']) > 0 && is_file("upload/marche/" . $row_data['mr_immagine'])
                    ? "upload/marche/" . $row_data['mr_immagine']
                    : "assets/images/prodotto-dummy.jpg";

                $mr_link = generateMarca2Link($row_data['mr_id']);
                ?>
                <div class="brand-slider-item">
                    <a href="<?php echo $mr_link; ?>"><img data-src="<?php echo $mr_immagine; ?>" alt="<?php echo "Vai ai prodotti $mr_marche"; ?>"/></a>
                </div>
                <?php

            }
            $result->close();

            ?>
        </div>
    </div>
</div>