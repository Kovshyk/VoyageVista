<?php

if(!empty($fields)) {
    foreach ($fields as $field) {
        if(empty($field)) {
            echo ' <div class="col-md-12"><hr></div>';
            continue;
        }
        ?>

        <div class="col-md-<?= $field['col'] ?>">
            <div class="form-group">
                <label><?= $field['name_uk'] ?> (<b><?= $language['name'] ?></b>)</label>
        <?php //if($field['type'] != 'textarea_editor'){ ?>

            <?= $this->Element('Admin/Pages/lang_buttons', [
                    'but_ident' => $field['name_js'],
                    'but_current_language' => $language['Locale']
                ]) ?>
        <?php //} ?>

                <?php if($field['type'] == 'input'){ ?>
                <input type="text"
                       value="<?= (!empty($page_content)) ? niceContentValue($field['name'], $language, $page_content) : '' ?>"
                       name="<?= 'content['.$language['Locale'].']'.$field['name'] ?>"
                       class="form-control <?= $field['name_js'] ?><?= '_'.$language['Locale'] ?>">
                <?php } ?>
                <?php if($field['type'] == 'textarea'){ ?>
                    <textarea class="form-control <?= $field['name_js'] ?><?= '_'.$language['Locale'] ?>"
                              name="<?= 'content['.$language['Locale'].']'.$field['name'] ?>"
                              rows="3"><?= (!empty($page_content)) ? niceContentValue($field['name'], $language, $page_content) : '' ?></textarea>
                <?php } ?>

                <?php if($field['type'] == 'textarea_editor'){ ?>
                    <textarea class="form-control <?= $field['name_js'] ?><?= '_'.$language['Locale'] ?>" id="<?= $field['name_js'] ?><?= '_'.$language['Locale'] ?>"
                              name="<?= 'content['.$language['Locale'].']'.$field['name'] ?>"
                              rows="3"><?= (!empty($page_content)) ? niceContentValue($field['name'], $language, $page_content) : '' ?></textarea>

                    <?php $this->append('pageScriptEditor'); ?>
                    <script type="text/javascript">
                        CKEDITOR.replace("<?= $field['name_js'] ?><?= '_'.$language['Locale'] ?>", {
                            customConfig: 'config_fields.js',
                        });
                    </script>
                    <?php $this->end(); ?>
                <?php } ?>

            </div>
        </div>
   <?php }
} ?>

