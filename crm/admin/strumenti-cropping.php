<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <script src="../ajax/regioni.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js" integrity="sha512-FHa4dxvEkSR0LOFH/iFH0iSqlYHf/iTwLc5Ws/1Su1W90X0qnxFxciJimoue/zyOA/+Qz/XQmmKqjbubAAzpkA==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" integrity="sha512-NCJ1O5tCMq4DK670CblvRiob3bb5PAxJ7MALAz2cV40T9RgNMrJSAwJKy0oz20Wu7TDn9Z2WnveirOeHmpaIlA==" crossorigin="anonymous" />

        <style>

            img {
                max-width: 100%;
            }

            .btn-selected {

                background-color: #0062cc;
                border-color: #005cbf;

            }

            .box-input {

                height: 500px;

            }

            .box-input input {

                display: none;

            }

            .box-input label {

                border: 1px solid lightgrey;
                width: 100%;
                height: 100%;
                text-align: center;
                padding-top: 150px;

            }

            .box-input label:hover {

                cursor: pointer;

            }

            .box-cropper {

                height: 500px;
                width: auto;
                display: none;

            }

            .box-cropper .result {

                height: 100%;
                width: auto;

            }

            .box-result {

                height: auto;
                width: 100%;
                display: none;
                text-align: center;

            }

            .box-result img {

                border: 1px solid lightgrey;

            }
        </style>

    </head>

    <body>

    <div class="wrapper">
        <!--================================= preloader -->
        <div id="pre-loader">
            <img src="../images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--================================= preloader -->
        <!--================================= header start-->

        <?php include "inc/header.php"; ?>

        <!--================================= header End-->
        <!--================================= Main content -->

        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar -->
                <?php include "inc/sidebar.php"; ?>
                <!-- Left Sidebar End-->

                <!--================================= Main content -->
                <!--================================= wrapper -->
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-3"> Tool modifica immagini</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 mb-10">
                            <div class="card card-statistics">
                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-12 mb-2">
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group mr-2" role="group">
                                                    <button type="button" class="btn btn-primary btn-size" data-width="1920" data-height="690">1920x690 [SLIDE]</button>
                                                    <button type="button" class="btn btn-primary btn-selected btn-size" data-width="1200" data-height="628">1200x628</button>
                                                    <button type="button" class="btn btn-primary btn-size" data-width="1000" data-height="1000">1000x1000</button>
                                                    <button type="button" class="btn btn-primary btn-size" data-width="600" data-height="600">600x600</button>
                                                </div>

                                                <div class="btn-group mr-2" role="group" aria-label="Second group">
                                                    <button type="button" class="btn btn-primary btn-zoom" data-zoom="0.1"><i class="fas fa-search-plus"></i></button>
                                                    <button type="button" class="btn btn-primary btn-zoom" data-zoom="-0.1"><i class="fas fa-search-minus"></i></button>
                                                </div>

                                                <div class="btn-group" role="group" aria-label="Third group">
                                                    <button class="btn btn-primary save disabled">Salva</button>
                                                    <!-- download btn -->
                                                    <a href="" class="btn btn-primary download disabled">Download</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="box-input">
                                                <input type="file" id="file-input" accept="image/*">
                                                <label for="file-input">
                                                    <i class="far fa-image fa-8x"></i><br>
                                                    Seleziona un immagine
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <div class="box-cropper">
                                                <div class="result"></div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="box-result img-result">
                                                <!-- result of crop -->
                                                <img class="cropped" src="" alt="">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <!--================================= wrapper -->

                    <!--================================= footer -->

                    <?php include "inc/footer.php"; ?>

                </div><!-- main content wrapper end-->
            </div>
        </div>
    </div>
    <!--=================================
    footer -->

    <?php include "inc/javascript.php"; ?>

    <script>
        // vars
        let result = document.querySelector('.result'),
            img_result = document.querySelector('.img-result'),
            img_w = 1200,
            img_h = 628,
            //options = document.querySelector('.options'),
            save = document.querySelector('.save'),
            cropped = document.querySelector('.cropped'),
            dwn = document.querySelector('.download'),
            upload = document.querySelector('#file-input'),
            cropper = '';

        // on change show image with crop options
        upload.addEventListener('change', (e) => {
            if (e.target.files.length) {
                // start file reader
                const reader = new FileReader();
                reader.onload = (e)=> {
                    if(e.target.result){
                        // create new image
                        let img = document.createElement('img');
                        img.id = 'image';
                        img.src = e.target.result
                        // clean result before
                        result.innerHTML = '';
                        // append new image
                        result.appendChild(img);
                        // show save btn and options
                        //save.classList.remove('hide');
                        //options.classList.remove('hide');
                        // init cropper
                        cropper = new Cropper(img, {
                            dragMode: 'move',
                            cropBoxResizable: false,
                            movable: false,
                            zoomOnTouch: false,
                            zoomOnWheel: false,
                            data:{ //define cropbox size
                                width: 1200,
                                height:  628,
                            },
                        });

                        $(".save").removeClass("disabled");
                        $(".box-input").hide();
                        $(".box-cropper").show();
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // save on click
        save.addEventListener('click',(e)=>{
            e.preventDefault();
            // get result to data uri
            let imgSrc = cropper.getCroppedCanvas({
                //width: img_w.value // input value
                width: img_w, // input value
                height: img_h, // input value
            }).toDataURL();
            // remove hide class of img
            //cropped.classList.remove('hide');
            //img_result.classList.remove('hide');
            // show image cropped
            cropped.src = imgSrc;
            //dwn.classList.remove('hide');
            dwn.download = 'crop-' + img_w + 'x' + img_h + '.jpg';
            dwn.setAttribute('href',imgSrc);

            $(".box-result").show();
            $(".download").removeClass("disabled");
        });

        $(".btn-size").click(function () {

            $(".btn-size").removeClass("btn-selected");
            $(this).addClass("btn-selected");

            img_w = $(this).data("width");
            img_h = $(this).data("height");
            cropper.setData({height: img_h, width: img_w });

        });

        $(".btn-zoom").click(function () {

            cropper.zoom($(this).data("zoom"));

        });
    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>