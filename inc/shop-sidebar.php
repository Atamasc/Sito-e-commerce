<div class="col-lg-3 order-lg-first col-md-12 order-md-last mb-res-md-60px mb-res-sm-60px">
    <div class="left-sidebar">

        <div class="sidebar-heading">
            <div class="main-heading">
                <h2>Categorie</h2>
            </div>
            <!-- Sidebar single item -->
            <div class="sidebar-widget">
                <div class="sidebar-widget-list">
                    <ul class="categories-menu">
                        <?php
                        $subQuery = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_ct_id = ct_id AND pr_stato > 0 ";
                        $querySql = "SELECT ct_id, ct_categoria, ($subQuery) AS pr_count FROM ct_categorie WHERE ct_stato > 0 ";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $ct_id = $row_data['ct_id'];
                            $ct_categoria = $row_data['ct_categoria'];
                            $pr_count = $row_data['pr_count'];

                            $ct_link = generateCatLink($ct_id);
                            ?>
                            <li>
                                <a href="javascript:;"><?php echo "$ct_categoria <span>($pr_count)</span>"; ?></a><i class="ion-ios-arrow-forward open-submenu"></i>
                                <ul class="categories-submenu">

                                    <?php
                                    $subQuery = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_st_id = st_id AND pr_stato > 0 ";
                                    $querySql = "SELECT st_id, st_sottocategoria, ($subQuery) AS pr_count FROM st_sottocategorie WHERE st_stato > 0 AND st_ct_id = '$ct_id' ";
                                    $result_st = $dbConn->query($querySql);

                                    while (($row_data_st = $result_st->fetch_assoc()) !== NULL) {

                                        $st_id = $row_data_st['st_id'];
                                        $st_sottocategoria = $row_data_st['st_sottocategoria'];
                                        $pr_count = $row_data_st['pr_count'];

                                        $st_link = generateSubCatLink($st_id);
                                        ?>
                                        <li>
                                            <a href="<?php echo $st_link; ?>"><?php echo "$st_sottocategoria <span>($pr_count)</span>"; ?></a>
                                        </li>
                                        <?php

                                    }

                                    $result_st->close();
                                    ?>
                                    <li><a href="<?php echo $ct_link; ?>">Tutti i prodotti</a></li>
                                </ul>
                            </li>
                            <?php

                        }

                        $result->close();
                        ?>

                    </ul>
                </div>
            </div>
        </div>


        <div class="sidebar-heading">
            <div class="main-heading">
                <h2>Sistemi</h2>
            </div>
            <!-- Sidebar single item -->
            <div class="sidebar-widget">
                <div class="sidebar-widget-list">
                    <ul class="categories-menu">
                        <?php
                        $subQuery = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_si_id = si_id AND pr_stato > 0 ";

                        $querySql = "SELECT si_id, si_sistema, ($subQuery) AS si_count FROM si_sistemi WHERE si_stato > 0 ";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $si_id = $row_data['si_id'];
                            $si_sistema = $row_data['si_sistema'];
                            $si_count = $row_data['si_count'];

                            $si_link = generateSistemaLink($si_id);
                            ?>
                            <li>
                                <a href="<?php echo $si_link; ?>"><?php echo "$si_sistema <span>($si_count)</span>"; ?></a>
                            </li>
                            <?php

                        }

                        $result->close();
                        ?>

                    </ul>
                </div>
            </div>
        </div>


        <div class="sidebar-heading">
            <div class="main-heading">
                <h2>Marchi</h2>
            </div>
            <!-- Sidebar single item -->
            <div class="sidebar-widget">
                <div class="sidebar-widget-list">
                    <ul class="categories-menu">
                        <?php
                        $subQuery = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_mr_id = mr_id AND pr_stato > 0 ";

                        $querySql = "SELECT mr_id, mr_marche, ($subQuery) AS mr_count FROM mr_marche WHERE mr_stato > 0 ";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $mr_id = $row_data['mr_id'];
                            $mr_marche = $row_data['mr_marche'];
                            $mr_count = $row_data['mr_count'];

                            $mr_link = generateMarca2Link($mr_id);
                            ?>
                            <li>
                                <a href="<?php echo $mr_link; ?>"><?php echo "$mr_marche <span>($mr_count)</span>"; ?></a>
                            </li>
                            <?php

                        }

                        $result->close();
                        ?>

                    </ul>
                </div>
            </div>
        </div>


        <!--
                <div class="sidebar-heading">
                    <div class="main-heading">
                        <h2>Filtra</h2>
                </div>

                    <div class="sidebar-widget mt-20">
                        <h4 class="pro-sidebar-title">Price</h4>
                        <div class="price-filter mt-10">
                            <div class="price-slider-amount">
                                <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                            </div>
                            <div id="slider-range"></div>
                        </div>
                    </div>

                    <div class="sidebar-widget mt-30">
                        <h4 class="pro-sidebar-title">Sistemi</h4>
                        <div class="sidebar-widget-list">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" /> <a href="#">A modo mio<span>(4)</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">Espresso point<span>(4)</span></a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">Dolce gusto<span>(4)</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">Caffitaly<span>(4)</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-widget no-cba mt-20">
                        <h4 class="pro-sidebar-title">Colour</h4>
                        <div class="sidebar-widget-list">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" /> <a href="#">Grey<span>(2)</span> </a>
                                        <span class="checkmark grey"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">White<span>(4)</span></a>
                                        <span class="checkmark white"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">Black<span>(4)</span> </a>
                                        <span class="checkmark black"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">Camel<span>(4)</span> </a>
                                        <span class="checkmark camel"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-widget mt-30">
                        <h4 class="pro-sidebar-title">Marchi</h4>
                        <div class="sidebar-widget-list">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" /> <a href="#">Lollo<span>(10)</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">Borbone<span>(7)</span></a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-widget mt-30">
                        <h4 class="pro-sidebar-title">Dimension</h4>
                        <div class="sidebar-widget-list">
                            <ul>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" /> <a href="#">40x60<span>(5)</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">60x90<span>(5)</span></a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar-widget-list-left">
                                        <input type="checkbox" value="" /> <a href="#">90x120<span>(5)</span> </a>
                                        <span class="checkmark"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                -->

        <!--
        <div class="sidebar-widget tag mt-30">
            <div class="main-heading">
                <h2>Tag</h2>
            </div>
            <div class="sidebar-widget-tag">
                <ul>
                    <li><a href="#">Fresh Fruit</a></li>
                    <li><a href="#"> Fresh Vegetables</a></li>
                    <li><a href="#">Fresh Salad</a></li>
                    <li><a href="#"> Butter & Eggs</a></li>
                </ul>
            </div>
        </div>
        -->
    </div>
</div>