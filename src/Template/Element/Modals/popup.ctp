<div id="popup" class="modal">
    <div id="popup_wrap" class="modal__wrap">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="modal__content">
                <h2 class="modal__title js-modal-title"></h2>
                <p class="modal__txt app-txt mb-15 js-modal-txt"></p>

                    <form id="popup-form" method="post" data-action="<?= $this->getNiceUrl('/sendForm'); ?>" action="<?= $this->getNiceUrl('/sendForm'); ?>">
                        <input type="hidden" name="g-recaptcha-response" value="" id="popup-form-token">

                        <?php if(!empty($project_modal) && !empty($project)) { ?>
                            <input type="hidden" name="type" value="formProject">
                            <input type="hidden" name="projectName" value="<?= h($project->name) ?>">
                        <?php } ?>
                        <div class="form-group">
                            <label class="form-label" for="popup_name"><?= $layout_page->getContentField(['feedbackLayout', 'name', 'name']) ?></label>
                            <input type="text" name="name" id="popup_name" class="form-input" placeholder="<?= $layout_page->getContentField(['feedbackLayout', 'name', 'placeholder']) ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="popup_phone"><?= $layout_page->getContentField(['feedbackLayout', 'phone', 'name']) ?></label>
                            <input type="text" name="phone" id="popup_phone" placeholder="<?= $layout_page->getContentField(['feedbackLayout', 'phone', 'placeholder']) ?>" class="form-input phone-mask">
                        </div>
                        <div class="form-group flex-group mt-30">
                            <button type="button" id="popup-form-submit" class="btn btn-secondary modal__btn js-modal-btn"></button>
                        </div>
                    </form>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="modal__img"></div>
        </div>
    </div>
</div>


<?php $this->append('pageScript'); ?>
<script src="https://www.google.com/recaptcha/api.js?render=6LcvACspAAAAAA5j7YjifGwSaLZYGphytqV_mwRn"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function(){
        $(document).on('click', '#popup-form-submit', function (e) {
            grecaptcha.ready(function() {
                grecaptcha.execute('6LcvACspAAAAAA5j7YjifGwSaLZYGphytqV_mwRn', {action: 'submit'}).then(function(token) {
                    $('#popup-form-token').val(token);
                    $('#popup-form').submit();
                });
            });
        });
    });
</script>
<?php $this->end(); ?>
