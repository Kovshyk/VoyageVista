<?= $this->Element('Admin/loader') ?>

<?= $this->Flash->render() ?>
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
        return $category->$name;
    } else {
        return (!empty($category->_translations[$language['Locale']]->$name)) ? $category->_translations[$language['Locale']]->$name : '';
    }
}

function niceContentValue($name, $language, $page_content)
{
    if(empty($page_content[$language['Locale']])) {
        return '';
    }
    $name = str_replace('[', '', $name);
    $name = str_replace(']', ' ', $name);
    $name = trim($name);
    $pieces = explode(" ", $name);

    $temp = $page_content[$language['Locale']];

    foreach ($pieces as $piece) {

        if(empty($temp[$piece])) {
            return '';
        }
        $temp = $temp[$piece];
    }
    return $temp;
}


?>
    <style>
        .nav-tabs {
            background: #c1ccd1!important;
        }
        .panel {
            background-color: #ddd!important;
        }
    </style>
<h1 class="page-header m-b-10">Сторінки / <?= (!empty($page_name)) ? $page_name : '' ?></h1>
    <form action="/admindom/pages/change" method="post">
<div class="row">
    <div class="m-b-10 m-t-10"><b class="text-inverse">Сео</b></div>
    <div class="col-md-12">
            <input type="hidden" name="name" value="<?= $page_type ?>">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Seo Title (<b><?= $language['name'] ?></b>)</label>
                                            <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'seo_title', 'but_current_language' => $language['Locale']]) ?>
                                            <input type="text"
                                                   value="<?= (!empty($page)) ? niceValue('seo_title', $language, $page) : '' ?>"
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
                                                      rows="3"><?= (!empty($page)) ? niceValue('seo_description', $language, $page) : '' ?></textarea>
                                            <small class="f-s-12 text-grey-darker seo_symb">0</small>
                                        </div>
                                    </div>
                                    <?php if($page_type == 'projects') { ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Seo Text (<b><?= $language['name'] ?></b>)</label>
                                                <?= $this->Element('Admin/Pages/lang_buttons', ['but_ident' => 'seo_text', 'but_current_language' => $language['Locale']]) ?>
                                                <textarea class="form-control seo_text<?= '_'.$language['Locale'] ?>"
                                                          name="<?= 'content['.$language['Locale'].'][seo_text]' ?>" id="seo_text<?= '_'.$language['Locale'] ?>"
                                                          rows="3"><?= (!empty($page_content)) ? niceContentValue('[seo_text]', $language, $page_content) : '' ?></textarea>
                                            </div>
                                        </div>

                                    <?php $this->append('pageScriptEditor'); ?>
                                        <script type="text/javascript">
                                            CKEDITOR.replace("seo_text<?= '_'.$language['Locale'] ?>", {
                                                customConfig: 'config_fields.js',
                                            });
                                        </script>
                                        <?php $this->end(); ?>
                                <?php } ?>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-sm btn-success">Зберегти
                    </button>
                </div>
            </div>
    </div>
</div>

<?= $this->Element('Admin/Pages/fields/'.$page_type) ?>
    </form>
<?php $this->append('pageScript'); ?>
    <script src="/admin/js/ckeditor/ckeditor.js"></script>
    <?= $this->fetch('pageScriptEditor'); ?>

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
            console.log(ident)
            if (ident === 'js_content'
                || ident === 'section6_tab3_description'
                || ident === 'content_service1_description'
                || ident === 'content_service2_description'
                || ident === 'content_service3_description'
                || ident === 'content_service4_description'
                || ident === 'seo_text'
                || ident === 'content_service5_description'
                || ident === 'content_service6_description'
                || ident === 'content_about_us_description'
                || ident === 'section6_tab1_description2') {
                text = CKEDITOR.instances[ident + '_' + lang_from].getData();
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
                        if (ident === 'js_content'
                            || ident === 'content_service1_description'
                            || ident === 'content_service2_description'
                            || ident === 'content_service3_description'
                            || ident === 'content_service4_description'
                            || ident === 'seo_text'
                            || ident === 'content_service5_description'
                            || ident === 'content_service6_description'
                            || ident === 'content_about_us_description'
                            || ident === 'section6_tab1_description2') {
                            text = CKEDITOR.instances[ident + '_' + lang_to].setData(response.text);
                        } else {
                            $('.' + ident + '_' + lang_to).val(response.text);
                        }
                        seo_fields.fillAll();
                    }
                    $('.js_content_loader').hide();
                }
            });
        });
    </script>
<?php $this->end(); ?>