<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">
    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <div class="wrapper">

        <!--=================================
         preloader -->

        <div id="pre-loader">
            <img src="../images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
         preloader -->


        <!--=================================
         header start-->

        <?php include "inc/header.php"; ?>

        <!--=================================
         header End-->

        <!--=================================
         Main content -->

        <div class="container-fluid">
            <div class="row">

                <!-- Left Sidebar start-->
                <?php include "inc/sidebar.php"; ?>
                <!-- Left Sidebar End-->

                <!--=================================
               wrapper -->

                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Dashboard</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- widgets -->
                    <?php include "inc/dashboard-stats.php"; ?>

                    <!-- Orders Status widgets-->

                    <?php //include "inc/dashboard-ordini.php"; ?>

                    <?php include "inc/dashboard-clienti.php"; ?>


                    <!--=================================
                     wrapper -->

                    <!--=================================
                     footer -->

                    <?php include "inc/footer.php"; ?>

                </div><!-- main content wrapper end-->
            </div>
        </div>
    </div>

    <!--=================================
     footer -->

    <?php include "inc/javascript.php"; ?>

    <script>

        $(function () {

            if ($('#custom-chart').exists()) {

                var config_chart = {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: $('#custom-chart').data('value'),
                            backgroundColor: [
                                window.chartColors.red,
                                window.chartColors.orange,
                                window.chartColors.yellow,
                                window.chartColors.green,
                                window.chartColors.blue,
                            ],
                            label: 'Dataset 1'
                        }],
                        labels: $('#custom-chart').data('label')
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: false,
                            text: 'Doughnut Chart'
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                };

                var ctx3 = document.getElementById("custom-chart").getContext("2d");
                window.myLine3 = new Chart(ctx3, config_chart);

            }

        });

    </script>

    </body>
    </html>
<?php include "../inc/db-close.php"; ?>