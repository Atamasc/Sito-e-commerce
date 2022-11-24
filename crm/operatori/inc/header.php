<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo w-100" href="javascript:;" style="background-image: url('../images/logo.png'); background-size: contain; background-repeat: no-repeat; height: 52px; margin-left: 0px;margin-top: 8px;"> </a>
        <a class="navbar-brand brand-logo-mini w-100" href="javascript:;"  style="background-image: url('../images/mini-logo.png'); background-size: contain; background-repeat: no-repeat; height: 51px;"><!--<img src="../images/mini-logo.png" alt="">--></a>
    </div>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
        </li>

        <!--
        <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" style="opacity:.01; width: 30px!important; height: 20px!important;padding: 10px; display: block; margin-top: 20px; z-index: 9999" href="javascript:void(0);">&nbsp;&nbsp;</a>
                <i class="ti-search" style="margin-bottom: -10px; position: absolute; top: 27px; left: 10px; "></i>
                <div class="search-box not-click">
                    <form action="blog-gst.php">
                        <input type="text" class="not-click form-control" placeholder="Cerca" value="" name="pr_nome">
                        <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                    </form>
                </div>
            </div>
        </li>
        -->

    </ul>
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link" ><i class="ti-fullscreen"></i></a>
        </li>

        <!--
        <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="ti-bell"></i>
                <span class="badge badge-danger notification-status"> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="dropdown-header notifications">
                    <strong>Notifications</strong>
                    <span class="badge badge-pill badge-warning">05</span>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">New registered user <small class="float-right text-muted time">Just now</small> </a>
                <a href="#" class="dropdown-item">New invoice received <small class="float-right text-muted time">22 mins</small> </a>
                <a href="#" class="dropdown-item">Server error report<small class="float-right text-muted time">7 hrs</small> </a>
                <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1 days</small> </a>
                <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2 days</small> </a>
            </div>
        </li>
        -->

        <!--
        <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big">
                <div class="dropdown-header">
                    <strong>Quick Links</strong>
                </div>
                <div class="dropdown-divider"></div>
                <div class="nav-grid">
                    <a href="blog-add.php" class="nav-grid-item"><i class="ti-files text-primary"></i><h5>Nuovo post</h5></a>
                    <a href="ordini-gst.php" class="nav-grid-item"><i class="ti-check-box text-success"></i><h5>Ordini ricevuti</h5></a>
                </div>
                <div class="nav-grid">
                    <a href="carrelli-gst.php" class="nav-grid-item"><i class="ti-shopping-cart text-warning"></i><h5>Elenco carrelli</h5></a>
                    <a href="ordini-gst.php?or_stato_spedizione=1" class="nav-grid-item"><i class="ti-truck text-danger "></i><h5>Ordini spediti</h5></a>
                </div>
            </div>
        </li>
        -->

        <li class="nav-item dropdown mr-30">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <!--<img src="../images/profile-avatar.jpg" alt="avatar">-->
                <i class="ti-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0"><?php echo getOperatore($session_id); ?></h5>
                            <!--<span>michael-bean@mail.com</span>-->
                        </div>
                    </div>
                </div>
                <!--
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="text-secondary ti-reload"></i>Activity</a>
                <a class="dropdown-item" href="#"><i class="text-success ti-email"></i>Messages</a>
                <a class="dropdown-item" href="#"><i class="text-warning ti-user"></i>Profile</a>
                <a class="dropdown-item" href="#"><i class="text-dark ti-layers-alt"></i>Projects <span class="badge badge-info">6</span> </a>
                -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="operatori-mod.php?op_id=<?php echo $session_id; ?>"><i class="text-info ti-settings"></i>Dati</a>
                <a class="dropdown-item" href="logout.php"><i class="text-danger ti-unlock"></i>Logout</a>
            </div>
        </li>
    </ul>
</nav>