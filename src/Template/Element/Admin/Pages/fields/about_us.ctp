<?php
$layout_sections = [
    [
        'name' => 'Сторінка про нас',
        'name_en' => 'about_us',
        'fields' => [
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_about_us_title',
                'name' => '[about_us][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Опис',
                'name_js' => 'content_about_us_description',
                'name' => '[about_us][description]',
                'col' => '8',
                'type' => 'textarea_editor',
            ],
        ],
    ],
    [
        'name' => '1 секція (Чим ми можемо бути вам корисні)',
        'name_en' => 'section1',
        'fields' => [
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_section1_title',
                'name' => '[section1][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Опис',
                'name_js' => 'content_section1_description',
                'name' => '[section1][description]',
                'col' => '8',
                'type' => 'textarea',
            ],
        ],
    ],
    [
        'name' => '1 секція - Форма зворотнього звязку',
        'name_en' => 'section1Feedback',
        'fields' => [
            [
                'name_uk' => 'Назва кнопки виклику',
                'name_js' => 'content_section1Feedback_buttonCall',
                'name' => '[section1Feedback][buttonCall]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_section1Feedback_title',
                'name' => '[section1Feedback][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Опис',
                'name_js' => 'content_section1Feedback_description',
                'name' => '[section1Feedback][description]',
                'col' => '4',
                'type' => 'textarea',
            ],
            [
                'name_uk' => 'Кнопка',
                'name_js' => 'content_section1Feedback_button',
                'name' => '[section1Feedback][button]',
                'col' => '4',
                'type' => 'input',
            ],
        ]
    ],
    [
        'name' => '2 секція (Результат, який ми гарантуємо)',
        'name_en' => 'section2',
        'fields' => [
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_section2_title',
                'name' => '[section2][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Опис 1',
                'name_js' => 'content_section2_description1',
                'name' => '[section2][description1]',
                'col' => '4',
                'type' => 'textarea',
            ],
            [
                'name_uk' => 'Опис 2',
                'name_js' => 'content_section2_description2',
                'name' => '[section2][description2]',
                'col' => '4',
                'type' => 'textarea',
            ],
            [
                'name_uk' => 'Опис 3',
                'name_js' => 'content_section2_description3',
                'name' => '[section2][description3]',
                'col' => '4',
                'type' => 'textarea',
            ],
            [
                'name_uk' => 'Опис 4',
                'name_js' => 'content_section2_description4',
                'name' => '[section2][description4]',
                'col' => '4',
                'type' => 'textarea',
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

