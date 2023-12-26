<?php
$layout_sections = [
    [
        'name' => 'Меню + Футер',
        'name_en' => 'menu',
        'fields' => [
            [
                'name_uk' => 'Меню',
                'name_js' => 'content_menu_menu',
                'name' => '[menu][menu]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Головна',
                'name_js' => 'content_menu_home',
                'name' => '[menu][home]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Проекти',
                'name_js' => 'content_menu_projects',
                'name' => '[menu][projects]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Галерея',
                'name_js' => 'content_menu_gallery',
                'name' => '[menu][gallery]',
                'col' => '4',
                'type' => 'input',
            ],
            [],

            [
                'name_uk' => 'Про нас',
                'name_js' => 'content_menu_about_us',
                'name' => '[menu][about_us]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Контакти',
                'name_js' => 'content_menu_contacts',
                'name' => '[menu][contacts]',
                'col' => '4',
                'type' => 'input',
            ],
            [],
            [
                'name_uk' => 'Про нас блок в футері',
                'name_js' => 'content_menu_about_us_footer',
                'name' => '[menu][about_us_footer]',
                'col' => '12',
                'type' => 'textarea',
            ],

        ],
    ],
    [
        'name' => 'Форма зворотнього звязку (телефон знизу зліва)',
        'name_en' => 'feedbackLayout',
        'fields' => [
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_feedbackLayout_title',
                'name' => '[feedbackLayout][title]',
                'col' => '6',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Опис',
                'name_js' => 'content_feedbackLayout_description',
                'name' => '[feedbackLayout][description]',
                'col' => '6',
                'type' => 'textarea',
            ],
            [
                'name_uk' => 'Імя (назва)',
                'name_js' => 'content_feedbackLayout_name_name',
                'name' => '[feedbackLayout][name][name]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Телефон (назва)',
                'name_js' => 'content_feedbackLayout_phone_name',
                'name' => '[feedbackLayout][phone][name]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Кнопка',
                'name_js' => 'content_feedbackLayout_button',
                'name' => '[feedbackLayout][button]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Імя (плейсхолдер)',
                'name_js' => 'content_feedbackLayout_name_placeholder',
                'name' => '[feedbackLayout][name][placeholder]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Телефон (плейсхолдер)',
                'name_js' => 'content_feedbackLayout_phone_placeholder',
                'name' => '[feedbackLayout][phone][placeholder]',
                'col' => '4',
                'type' => 'input',
            ],


        ]
    ],


];
?>
    <input type="hidden" name="name" value="<?= $page_type ?>">
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
