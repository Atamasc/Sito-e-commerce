<section class="categorie-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title mt-res-sx-30px mt-res-md-30px">
                    <h2>Sistemi</h2>
                    <p>I migliori sistemi</p>
                </div>
                <!-- Section Title -->
            </div>
        </div>
        <!-- Category Slider Start -->
        <div class="category-slider owl-carousel owl-nav-style">

                <?php
                $querySql = "SELECT * FROM si_sistemi WHERE si_stato > 0 ORDER BY si_id ";
                $result = $dbConn->query($querySql);
                $rows = $dbConn->affected_rows;
                $c=0;

                while($row_data = $result->fetch_assoc()) {

                $si_id = $row_data['si_id'];
                $si_sistema = $row_data['si_sistema'];
                $si_link = generateSistemaLink($si_id);

                $si_banner = strlen($row_data['si_banner']) > 0 && is_file("upload/sistemi/".$row_data['si_banner'])
                    ? "upload/sistemi/".$row_data['si_banner']
                    : "assets/images/product-image/organic/thumb-1.jpg";

                ?>

                    <?php if(($c%2)==0 || $c==0) echo "<div class='category-item'>"; ?>

                <div class="category-list mb-30px">
                    <div class="category-thumb">
                        <a href="<?php echo $si_link; ?>">
                            <img src="<?php echo $si_banner; ?>" alt="" />
                        </a>
                    </div>
                    <div class="desc-listcategoreis">
                        <div class="name_categories">
                            <h4><?php echo $si_sistema; ?></h4>
                        </div>
                        <!--<span class="number_product">17 Products</span>-->
                        <a href="<?php echo $si_link; ?>"> Scopri di più <i class="ion-android-arrow-dropright-circle"></i></a>
                    </div>
                </div>

                    <?php if(($c%2)==1) echo "</div>"; ?>

                <?php
                    $c++;
                }
                $result->close();
                ?>

    </div>
</section>