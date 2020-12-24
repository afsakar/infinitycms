<?php
$popup = popup($controllerView);
?>
<?php if ($popup): ?>
    <?php $popup_cookie = get_cookie($popup->popup_id); ?>
    <?php if ($popup_cookie != "true"): ?>
        <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?= $popup->title ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= $popup->description ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <button type="button"
                                data-csrf-key="<?= $this->security->get_csrf_token_name() ?>"
                                data-csrf-value="<?= $this->security->get_csrf_hash() ?>"
                                data-popupid="<?= $popup->popup_id ?>"
                                data-url="<?= base_url("dontShowAgain") ?>"
                                class="btn btn-primary dontShow"
                                data-dismiss="modal">Bir daha gösterme
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $("#popupModal").modal("show");
            });
        </script>

    <?php endif; ?>
<?php endif; ?>