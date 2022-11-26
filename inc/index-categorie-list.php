<section class="categorie-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title mt-res-sx-30px mt-res-md-30px">
                    <h2>Categorie Popolari</h2>
                    <p>Le categorie piu popolari della settimana</p>
                </div>
                <!-- Section Title -->
            </div>
        </div>
        <!-- Category Slider Start -->
        <div class="category-slider owl-carousel owl-nav-style">
            <?php
            $querySql = "SELECT * FROM ct_categorie WHERE ct_stato > 0 ";
            $result = $dbConn->query($querySql);
            $rows = $dbConn->affected_rows;
            
            while($row_data = $result->fetch_assoc()) {
                
                $ct_id = $row_data['ct_id'];
                $ct_categoria = $row_data['ct_categoria'];
                $ct_link = generateCatLink($ct_id);
                
                $ct_immagine = strlen($row_data['ct_immagine']) > 0 && is_file("upload/categorie/".$row_data['ct_immagine'])
                    ? "upload/categorie/".$row_data['ct_immagine']
                    : "assets/images/product-image/organic/thumb-2.jpg";
                
                ?>
                
                <div class="category-item">
                    <div class="category-list mb-30px">
                        <div class="category-thumb">
                            <a href="<?php echo $ct_link; ?>">
                                <img src="<?php echo $ct_immagine; ?>" alt="immagine-categoria" />
                            </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4 style="color: black"><?php echo $ct_categoria; ?></h4>
                            </div>
                            <!--<span class="number_product">11 Prodotti</span>-->
                            <a href="<?php echo $ct_link; ?>" style="color: red"> Vedi Prodotti <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                    
                    <!--<div class="category-list">
                        <div class="category-thumb">
                            <a href="shop-4-column.html">
                                <img src="assets/images/product-image/organic/thumb-2.jpg" alt="" />
                            </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4>Fresh Salad & Dips</h4>
                            </div>
                            <span class="number_product">17 Products</span>
                            <a href="shop-4-column.html"> Shop Now <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>-->
                
                </div>
            <?php }
            $result->close();
            ?>
        </div>
    </div>
</section>
