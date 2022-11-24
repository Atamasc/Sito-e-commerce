<!--=================================
 jquery -->

<!-- jquery -->
<script src="../js/jquery-3.3.1.min.js"></script>

<!-- plugins-jquery -->
<script src="../js/plugins-jquery.js"></script>

<!-- plugin_path -->
<script>var plugin_path = '../js/';</script>

<!-- chart -->
<script src="../js/chart-init.js"></script>

<!-- calendar -->
<script src="../js/calendar.init.js"></script>

<!-- charts sparkline -->
<script src="../js/sparkline.init.js"></script>

<!-- charts morris -->
<script src="../js/morris.init.js"></script>

<!-- datepicker -->
<script src="../js/datepicker.js"></script>

<!-- sweetalert2 -->
<script src="../js/sweetalert2.js"></script>

<!-- toastr -->
<script src="../js/toastr.js"></script>

<!-- validation -->
<script src="../js/validation.js"></script>

<!-- lobilist -->
<script src="../js/lobilist.js"></script>

<!-- FA Pro -->
<script src="../js/fa-pro.js"></script>

<!-- custom -->
<script src="../js/custom.js?<?php echo time(); ?>"></script>


<!-- ====| LUIGI |==== -->

<!-- ==== FRANCESCO ==== -->
<div tabindex="-1" class="modal fade modale-custom" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="body-custom-modale">
            ERRORE
        </div>
    </div>
</div>

<div tabindex="-1" class="modal fade modale-custom-email" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="body-custom-modale-email">
            <div class="modal-header">
                <div class="modal-title"><div class="mb-30">
                        <h2>INVIO NEWSLETTER</h2>
                    </div>
                </div>
                <button class="close" aria-label="Close" type="button" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">

                Il server sta eseguendo l'invio, attendere...

                <p class="text-center">
                    <i class="fa fa-spinner fa-spin fa-5x"></i>
                </p>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Chiudi</button>
            </div>

        </div>
    </div>
</div>

<div tabindex="-1" class="modal fade modale-custom-img" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="body-custom-modale-img" style="display: block; text-align: center;">

            <div class="modal-header">
                <button class="close" aria-label="Close" type="button" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <img id="img-modale" style="width: 100%;" src="">

        </div>
    </div>
</div>