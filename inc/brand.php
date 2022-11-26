<div class="brand-area">
    <div class="container">
        <div class="brand-slider owl-carousel owl-nav-style owl-nav-style-2">

            <?php

            $querySql = "SELECT * FROM mr_marchi WHERE mr_stato > 0 ORDER BY RAND(), mr_marchio LIMIT 0, 10";
            $result = $dbConn->query($querySql);

            while ($row_data = $result->fetch_assoc()) {

                $mr_marchio = $row_data['mr_marchio'];
                $mr_immagine = strlen($row_data['mr_immagine']) > 0 && is_file("upload/marchi/".$row_data['mr_immagine'])
                    ? "upload/marchi/".$row_data['mr_immagine']
                    : "assets/images/prodotto-dummy.jpg";

                $mr_link = generateMarchio2Link($row_data['mr_id']);
                ?>
                <div class="brand-slider-item">
                    <a href="<?php echo $mr_link; ?>"><img data-src="<?php echo $mr_immagine; ?>" alt="<?php echo "Vai ai prodotti $mr_marchio"; ?>" /></a>
                </div>
                <?php

            }
            $result->close();

            ?>
        </div>
    </div>
</div>