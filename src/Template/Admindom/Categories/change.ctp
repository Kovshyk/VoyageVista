<?= $this->element('Admin/loader') ?>
<?= $this->element('Admin/crumbs', ['crumbs' => [0 => 'Проекти', '/admindom/categories/index' => 'Категорії'],
    'active' => (empty($category)) ? 'Додати категорію' : 'Редагувати категорію: ' . $category->name]) ?>
<?php
function niceName($name, $language)
{
    if ($language['type'] == 'main') {
        return $name;
    } else {
        return "_translations[{$language['Locale']}][{$name}]";
    }
}

function niceValue($name, $language, $category)
{
    if ($language['type'] == 'main') {
        return h($category->$name);
    } else {
        return (!empty($category->_translations[$language['Locale']]->$name)) ? h($category->_translations[$language['Locale']]->$name) : '';
    }
}
?>
<style>
    .select2.select2-container .selection .select2-selection.select2-selection--multiple {
        height: auto!important;
        min-height: 34px!important;
    }
</style>
<form action="/admindom/categories/change<?= (!empty($category) ? '/'.$category->id : '') ?>"  method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= (!empty($category) ? $category->id : '') ?>">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Перейти</label> <br>
        <?php if (!empty($languages) && !empty($category)) {
            foreach ($languages as $key => $language) {
                $slug = 'slug_'.$language['Locale'];
                $enable = 'enable_'.$language['Locale'];
                $loc = ($language['type'] == 'main') ? '/' : '/'.$language['Locale'].'/';
                if(!empty($category->$slug) && !empty($category->$enable)) {
                    ?>
                    <a href="<?= $loc.$category->$slug ?>" target="_blank" class="btn btn-sm btn-info"><?= $language['name'] ?></a>
                <?php }}
        } ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label>Проекти</label>
                <select name="projects[]" class="form-control select2" multiple>
                    <?php
                    if(!empty($projects)) {
                        foreach ($projects as $project) { ?>
                            <option <?= (!empty($project_ids) && in_array($project->id, $project_ids->toArray())) ? 'selected' : '' ?> value="<?= $project->id ?>"><?= h($project->name) ?> (id:<?= $project->id ?>)</option>
                        <?php }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Сортування</label>
                <input type="text" name="sort" value="<?= (!empty($category) ? $category->sort : '') ?>"
                       class="form-control">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success" style="margin-top: 22px">Зберегти</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <ul class="nav nav-tabs">
                    <?php if (!empty($languages)) {
                        foreach ($languages as $key => $language) { ?>
                            <li class="<?= (!$key) ? 'active' : '' ?>">
                                <a href="#seo_<?= $language['Locale'] ?>" data-toggle="tab"><?= $language['name'] ?></a>
                            </li>
                        <?php }
                    } ?>
                </ul>
                <div class="tab-content">
                    <?php if (!empty($languages)) {
                        foreach ($languages as $key => $language) { ?>
                            <div class="tab-pane <?= (!$key) ? 'active' : '' ?>"  id="seo_<?= $language['Locale'] ?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-check">
                                            <label>Ативувати сторінку (<b><?= $language['name'] ?></b>)</label>
                                            <br>
                                            <div class="switcher">
                                                <input type="checkbox" name="enable_<?= $language['Locale'] ?>"
                                                    <?= (!empty($category) && $category->getEnableByLocale($language['Locale']) == 1) ? 'checked' : '' ?>
                                                       id="enable_<?= $language['Locale'] ?>" value="1">
                                                <label for="enable_<?= $language['Locale'] ?>"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Назва (<b><?= $language['name'] ?></b>)</label>
                                            <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'name', 'but_current_language' => $language['Locale']]) ?>
                                            <input type="text" name="<?= niceName('name', $language) ?>" value="<?= (!empty($category) ? niceValue('name', $language, $category) : '') ?>"
                                                <?= ($language['Locale'] == 'uk') ? 'required' : '' ?>
                                                   class="form-control name<?= '_'.$language['Locale'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Слаг (<b><?= $language['name'] ?></b>)</label>
                                            <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'slug', 'but_current_language' => $language['Locale']]) ?>
                                            <input type="text" name="slug_<?= $language['Locale'] ?>"
                                                   value="<?= (!empty($category)) ? $category->getSlugByLocale($language['Locale']) : '' ?>"
                                                <?= ($language['Locale'] == 'uk') ? 'required' : '' ?>
                                                   class="form-control slug<?= '_'.$language['Locale'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Короткий опис (<b><?= $language['name'] ?></b>)</label>
                                            <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'short_description', 'but_current_language' => $language['Locale']]) ?>
                                            <textarea class="form-control short_description<?= '_'.$language['Locale'] ?>"
                                                      name="<?= niceName('short_description', $language) ?>" id=""
                                                      rows="3"><?= (!empty($category)) ? niceValue('short_description', $language, $category) : '' ?></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Seo Title (<b><?= $language['name'] ?></b>)</label>
                                            <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'seo_title', 'but_current_language' => $language['Locale']]) ?>
                                            <input type="text"
                                                   value="<?= (!empty($category)) ? niceValue('seo_title', $language, $category) : '' ?>"
                                                   name="<?= niceName('seo_title', $language) ?>"
                                                   class="form-control seo_field seo_title<?= '_'.$language['Locale'] ?>">
                                            <small class="f-s-12 text-grey-darker seo_symb">0</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Seo Description (<b><?= $language['name'] ?></b>)</label>
                                            <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'seo_description', 'but_current_language' => $language['Locale']]) ?>
                                            <textarea class="form-control seo_field seo_description<?= '_'.$language['Locale'] ?>"
                                                      name="<?= niceName('seo_description', $language) ?>" id=""
                                                      rows="3"><?= (!empty($category)) ? niceValue('seo_description', $language, $category) : '' ?></textarea>
                                            <small class="f-s-12 text-grey-darker seo_symb">0</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Seo TEXT (<b><?= $language['name'] ?></b>)</label>
                                            <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'seo_text', 'but_current_language' => $language['Locale']]) ?>
                                            <textarea class="ckeditor seo_field seo_text<?= '_'.$language['Locale'] ?>"
                                                      id="seo_text<?= '_'.$language['Locale'] ?>"
                                                      name="<?= niceName('seo_text', $language) ?>"><?= (!empty($category)) ? niceValue('seo_text', $language, $category) : '' ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="form-group">
                <button  type="submit" class="btn btn-block btn-success">Зберегти</button>
            </div>
        </div>
    </div>
</form>

<?php $this->append('pageCss'); ?>
<link href="/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
<?php $this->end(); ?>
<?php $this->append('pageScript'); ?>
<script src="/admin/assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="/admin/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
var seo_fields = {
    init: function () {
        this.fillAll();
        this.events();
    },
    events: function () {
        var self = this;
        $(document).on('keyup', '.seo_field', function () {
            self.fillOne(this);
        });
    },
    fillAll: function () {
        var fields = $('.seo_field');
        for (var i = 0; i < fields.length; i++) {
            this.fillOne(fields[i])
        }
    },
    fillOne: function (field) {
        $(field).closest('.form-group').find('.seo_symb').text($(field).val().length);
    }
};
seo_fields.init();

$(document).on("click", ".js_translate_button", function () {
    let lang_from = $(this).data('lang_from');
    let lang_to = $(this).data('lang_to');
    let ident = $(this).data('ident');
    let text = $('.' + ident + '_' + lang_from).val();
    if (ident === 'seo_text') {
        let editorFrom = CKEDITOR.instances['seo_text_' + lang_from];
        if (!editorFrom) {
            CKEDITOR.replace('seo_text_' + lang_from);
            editorFrom = CKEDITOR.instances['seo_text_' + lang_from];
        }
        if (editorFrom) {
            text = editorFrom.getData();
        } else {
            console.error('CKEditor instance not found for language: ' + lang_from);
        }
    }
    if (text === '' || text === '<p>&nbsp;</p>' || text === '&nbsp;') {
        alert('Поле пусте!');
        return false;
    }
    $('.js_content_loader').show();

    $.ajax({
        type: "POST",
        url: '/admindom/translateApi/translate',
        data: {
            "lang_from": lang_from,
            "lang_to": lang_to,
            "text": text,
        },
        success: function (response) {
            if (response.error) {
                alert('Помилка');
            } else {
                if (ident === 'seo_text') {
                    let editorTo = CKEDITOR.instances['seo_text_' + lang_to];
                    if (!editorTo) {
                        CKEDITOR.replace('seo_text_' + lang_to);
                        editorTo = CKEDITOR.instances['seo_text_' + lang_to];
                    }
                    if (editorTo) {
                        editorTo.setData(response.text);
                    } else {
                        console.error('CKEditor instance not found for language: ' + lang_to);
                    }
                } else {
                    $('.' + ident + '_' + lang_to).val(response.text);
                }
                seo_fields.fillAll();
            }
            $('.js_content_loader').hide();
        }
    });
});

$('.select2').select2();
</script>
<?php $this->end(); ?>
