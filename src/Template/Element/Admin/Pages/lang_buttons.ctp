<span class="pull-right">перекласти з
<?php foreach ($languages as $language_trans) {
    if($language_trans['Locale'] !== $but_current_language) {?>
        <button type="button"
                data-lang_from="<?= $language_trans['Locale'] ?>"
                data-lang_to="<?= $but_current_language ?>"
                data-ident="<?= $but_ident ?>"
                class="btn btn-primary btn-xs js_translate_button"
                title="<?= $language_trans['name'] ?>"
        ><b><?= $language_trans['Locale'] ?></b></button>
<?php }} ?>
</span>