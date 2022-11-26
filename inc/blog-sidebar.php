<!-- Sidebar Area Start -->
<div class="col-lg-3 col-md-12 mb-res-md-60px mb-res-sm-60px">
    <div class="left-sidebar">
        <!-- Sidebar single item -->
        <!--<div class="sidebar-widget">
            <div class="main-heading">
                <h2>Search</h2>
            </div>
            <div class="search-widget">
                <form action="#">
                    <input placeholder="Search entire store here ..." type="text" />
                    <button type="submit"><i class="ion-ios-search-strong"></i></button>
                </form>
            </div>
        </div>-->
        <!-- Sidebar single item -->
        <!-- Sidebar single item -->
        <div class="sidebar-widget mt-40">
            <div class="main-heading">
                <h2>Categorie</h2>
            </div>
            <div class="category-post">
                <ul>
                    <?php
                    $querySql = "SELECT * FROM bc_blog_categorie WHERE bc_stato > 0";
                    $result = $dbConn->query($querySql);

                    while( ($row_data = $result->fetch_assoc()) !== NULL) {

                        $bc_id = $row_data['bc_id'];
                        $bc_titolo = $row_data['bc_titolo'];

                        $querySql = "SELECT COUNT(bl_id) FROM bl_blog WHERE bl_bc_id = $bc_id AND bl_stato > 0";
                        $result_count = $dbConn->query($querySql);
                        $count = $result_count->fetch_row()[0];
                        $result_count->close();

                        $link= generateBlogCatLink($bc_id);

                        echo "<li><a href='$link'>$bc_titolo&nbsp;&nbsp;&nbsp;($count)</a> </li>";

                    }
                    $result->close();
                    ?>
                </ul>
            </div>
        </div>
        <!-- Sidebar single item -->
        <div class="sidebar-widget mt-40">
            <div class="main-heading">
                <h2>Post Recenti</h2>
            </div>
            <div class="recent-post-widget">

                <?php
                $querySql = "SELECT * FROM bl_blog INNER JOIN bc_blog_categorie ON bl_bc_id = bc_id WHERE bl_stato > 0 ORDER BY bl_data DESC LIMIT 0, 3";
                $result = $dbConn->query($querySql);
                $rows = $dbConn->affected_rows;

                while (($row_data = $result->fetch_assoc()) !== NULL) {

                $bl_id = $row_data["bl_id"];
                $bl_titolo = $row_data["bl_titolo"];
                $bc_titolo = $row_data["bc_titolo"];
                $bl_data = date("d/m/Y", $row_data["bl_data"]);

                $bl_immagine = getImmagineBlog($bl_id);

                $bl_link = generateBlogLink($bl_id);
                ?>

                <div class="recent-single-post d-flex">
                    <div class="thumb-side">
                        <a href="<?php echo $bl_link; ?>"><img src="<?php echo $bl_immagine; ?>" alt="<?php echo $bl_titolo; ?>" /></a>
                    </div>
                    <div class="media-side">
                        <h5><a href="<?php echo $bl_link; ?>"><?php echo $bl_titolo; ?> </a></h5>
                        <span class="date"><?php echo $bl_data; ?></span>
                    </div>
                </div>

                    <?php
                }
                $result->close();
                ?>

            </div>
        </div>
        <!-- Sidebar single item -->
        <div class="sidebar-widget mt-40">
            <div class="main-heading">
                <h2>Tag</h2>
            </div>
            <div class="sidebar-widget-tag">
                <ul>
                    <?php
                    $subQuery = "SELECT COUNT(tb_id) FROM tb_tag_blog WHERE tb_tg_id = tg_id ";
                    $querySql = "SELECT tg_tag, tg_id, ($subQuery) AS tb_count FROM tg_tag WHERE tg_stato > 0 HAVING tb_count > 0 ORDER BY RAND() LIMIT 10";
                    $result = $dbConn->query($querySql);

                    $oldTags = [];

                    while( ($row_data = $result->fetch_assoc() ) !== NULL) {

                        $tg_tag = $row_data['tg_tag'];
                        $tg_id = $row_data['tg_id'];

                        $tg_tag = trim($tg_tag);
                        $link = generateBlogTagLink($tg_tag, $tg_id);

                        if(!in_array($tg_tag, $oldTags) && strlen($tg_tag) > 0) {

                            array_push($oldTags, $tg_tag);
                            echo "<li><a href='$link'>$tg_tag</a></li>";

                        }
                    }
                    $result->close();
                    ?>
                </ul>
            </div>
        </div>
        <!-- Sidebar single item -->
    </div>
</div>
<!-- Sidebar Area End -->