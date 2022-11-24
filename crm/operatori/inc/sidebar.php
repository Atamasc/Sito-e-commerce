<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            <!-- menu item Dashboard-->
            <li>
                <a href="dashboard.php"><i class="ti-blackboard"></i><span class="right-nav-text">Dashboard</span></a>
            </li>

            <!-- menu title -->
            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Gestioni </li>

            <li>
                <a href="clienti-gst.php"><i class="far fa-users mr-3"></i><span class="right-nav-text">Clienti</span></a>
            </li>

            <li>
                <a href="giacenze-gst.php"><i class="far fa-box mr-3"></i><span class="right-nav-text">Giacenze</span></a>
            </li>

            <li>
                <a href="distribuzione-gst.php"><i class="far fa-shipping-fast mr-3"></i><span class="right-nav-text">Distribuzione</span></a>
            </li>

            <li>
                <a href="ordini-gst.php"><i class="fas fa-box mr-3"></i><span class="right-nav-text">Ordini</span></a>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#attivita">
                    <div class="pull-left"><i class="ti-tablet"></i><span class="right-nav-text">Attività</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="attivita" class="collapse" data-parent="#sidebarnav">
                    <li><a href="attivita-add.php">Aggiungi attività</a></li>
                    <li><a href="attivita-gst.php">Elenco attività</a></li>
                </ul>
            </li>

            <li>
                <a href="operatori-mod.php?op_id=<?php echo $session_id; ?>"><i class="far fa-user mr-3"></i><span class="right-nav-text">I tuoi dati</span></a>
            </li>

            <li>
                <a href="logout.php"><i class="ti-panel"></i><span class="right-nav-text">Logout</span> </a>
            </li>
        </ul>
    </div>
</div>