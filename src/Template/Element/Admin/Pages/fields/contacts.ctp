<?php
$layout_sections = [
    [
        'name' => 'Сторінка послуги',
        'name_en' => 'contacts',
        'fields' => [
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_contacts_title',
                'name' => '[contacts][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Телефони',
                'name_js' => 'content_contacts_phone',
                'name' => '[contacts][phone]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'E-mail',
                'name_js' => 'content_contacts_email',
                'name' => '[contacts][email]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Соціальні мережі',
                'name_js' => 'content_contacts_socials',
                'name' => '[contacts][socials]',
                'col' => '4',
                'type' => 'input',
            ],
        ],
    ],
    [
        'name' => 'Форма зв’язку',
        'name_en' => 'feedback',
        'fields' => [
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_feedback_title',
                'name' => '[feedback][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Опис',
                'name_js' => 'content_feedback_description',
                'name' => '[feedback][description]',
                'col' => '4',
                'type' => 'textarea',
            ],
            [],
            [
                'name_uk' => 'Заголовок (поле вводу імя)',
                'name_js' => 'content_feedback_field1_title',
                'name' => '[feedback][field1][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Заголовок (поле вводу телефону)',
                'name_js' => 'content_feedback_field2_title',
                'name' => '[feedback][field2][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Заголовок (поле вводу повідомлення)',
                'name_js' => 'content_feedback_field3_title',
                'name' => '[feedback][field3][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Плейсхолдер (поле вводу імя)',
                'name_js' => 'content_feedback_field1_placeholder',
                'name' => '[feedback][field1][placeholder]',
                'col' => '4',
                'type' => 'input',
            ],

            [
                'name_uk' => 'Плейсхолдер (поле вводу телефону)',
                'name_js' => 'content_feedback_field2_placeholder',
                'name' => '[feedback][field2][placeholder]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Плейсхолдер (поле вводу повідомлення)',
                'name_js' => 'content_feedback_field3_placeholder',
                'name' => '[feedback][field3][placeholder]',
                'col' => '4',
                'type' => 'input',
            ],
            [],
            [
                'name_uk' => 'Кнопака',
                'name_js' => 'content_feedback_button',
                'name' => '[feedback][button]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Кнопака (опис)',
                'name_js' => 'content_feedback_buttonDescription',
                'name' => '[feedback][buttonDescription]',
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

