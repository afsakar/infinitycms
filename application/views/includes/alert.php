<?php $alert = $this->session->userdata("alert"); ?>
<?php if ($alert){ ?>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": 'toast-<?=$alert["position"]?>',
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <?php if ($alert === "success"): ?>
        <script>
            toastr['<?=$alert["type"]?>']('<?=$alert["text"]?>', '<?=$alert["title"]?>');
        </script>
    <?php else: ?>
        <script>
            toastr['<?=$alert["type"]?>']('<?=$alert["text"]?>', '<?=$alert["title"]?>');
        </script>
    <?php endif; ?>

<?php } ?>
