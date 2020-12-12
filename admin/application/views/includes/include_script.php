<!-- build:js ../assets/js/core.min.js -->
<script src="<?=base_url('sources')?>/libs/bower/jquery/dist/jquery.js"></script>
<script src="<?=base_url('sources')?>/libs/bower/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url('sources')?>/libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="<?=base_url('sources')?>/libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
<script src="<?=base_url('sources')?>/libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?=base_url('sources')?>/libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="<?=base_url('sources')?>/libs/bower/PACE/pace.min.js"></script>
<!-- endbuild -->

<!-- build:js ../assets/js/app.min.js -->
<?php $this->load->view("includes/library.php"); ?>
<script src="<?=base_url('sources')?>/assets/js/plugins.js"></script>
<script src="<?=base_url('sources')?>/assets/js/app.js"></script>
<script src="<?=base_url('sources')?>/assets/js/sweetalert2.all.js"></script>
<script src="<?=base_url('sources')?>/assets/js/toastr.min.js"></script>
<!-- endbuild -->
<script src="<?=base_url('sources')?>/libs/bower/moment/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url('sources')?>/libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?=base_url('sources')?>/assets/js/fullcalendar.js"></script>
<?php $this->load->view("includes/alert.php"); ?>

