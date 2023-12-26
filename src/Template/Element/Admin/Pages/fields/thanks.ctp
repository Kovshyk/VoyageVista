<?php
$layout_sections = [
    [
        'name' => 'Сторінка послуги',
        'name_en' => 'thanks',
        'fields' => [
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_thanks_title',
                'name' => '[thanks][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Опис',
                'name_js' => 'content_thanks_description',
                'name' => '[thanks][description]',
                'col' => '4',
                'type' => 'textarea',
            ],
            [
                'name_uk' => 'Кнопка',
                'name_js' => 'content_thanks_button',
                'name' => '[thanks][button]',
                'col' => '4',
                'type' => 'input',
            ],
        ],
    ],

];
?>
<?php foreach ($layout_sections as $layout_section) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" style="cursor: pointer"
                     data-target="#<?= $layout_section['name_en'] ?>" aria-expanded="false">
                    <h4 class="panel-title"><?= $layout_section['name'] ?></h4>
                </div>
                <div id="<?= $layout_section['name_en'] ?>" class="collapse">
                    <div class="panel-body">
                        <input type="hidden" name="name" value="<?= $page_type ?>">
                        <div class="form-group">
                            <ul class="nav nav-tabs">
                                <?php if (!empty($languages)) {
                                    foreach ($languages as $key => $language) { ?>
                                        <li class="<?= (!$key) ? 'active' : '' ?>">
                                            <a href="#<?= $layout_section['name_en'] ?>_<?= $language['Locale'] ?>"
                                               data-toggle="tab"><?= $language['name'] ?></a>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                            <div class="tab-content">
                                <?php if (!empty($languages)) {
                                    foreach ($languages as $key => $language) { ?>
                                        <div class="tab-pane <?= (!$key) ? 'active' : '' ?>"
                                             id="<?= $layout_section['name_en'] ?>_<?= $language['Locale'] ?>">
                                            <div class="row">
                                                <?= $this->Element('Admin/Pages/fields/fields_layout',
                                                    ['fields' => $layout_section['fields'],
                                                        'language' => $language,
                                                        'page' => $page,
                                                    ]
                                                )
                                                ?>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-sm btn-success ">Зберегти
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
