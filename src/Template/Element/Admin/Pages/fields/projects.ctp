<?php
$layout_sections = [
    [
        'name' => 'Сторінка Проекти + Проекту',
        'name_en' => 'projects',
        'fields' => [
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_projects_title',
                'name' => '[projects][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [],
            [
                'name_uk' => 'Текст під заголовком',
                'name_js' => 'content_projects_title_text',
                'name' => '[projects][title_text]',
                'col' => '12',
                'type' => 'textarea',
            ],
            [],
            [
                'name_uk' => 'Сортувати',
                'name_js' => 'content_projects_sort_name',
                'name' => '[projects][sort][name]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Вибрати',
                'name_js' => 'content_projects_sort_choose',
                'name' => '[projects][sort][choose]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'за ціною',
                'name_js' => 'content_projects_sort_price',
                'name' => '[projects][sort][price]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'за тривалістю',
                'name_js' => 'content_projects_sort_square',
                'name' => '[projects][sort][square]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'від меншої до більшої',
                'name_js' => 'content_projects_sort_up',
                'name' => '[projects][sort][up]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'від більшої до меншої',
                'name_js' => 'content_projects_sort_down',
                'name' => '[projects][sort][down]',
                'col' => '4',
                'type' => 'input',
            ],
            [],
            [
                'name_uk' => 'Тривалість:',
                'name_js' => 'content_projects_totalSquare',
                'name' => '[projects][totalSquare]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Переглянути тур',
                'name_js' => 'content_projects_showProject',
                'name' => '[projects][showProject]',
                'col' => '4',
                'type' => 'input',
            ],
            [],
            [
                'name_uk' => 'Категорії',
                'name_js' => 'content_projects_categories',
                'name' => '[projects][categories]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Всі',
                'name_js' => 'content_projects_categoriesAll',
                'name' => '[projects][categoriesAll]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'ІНФОРМАЦІЯ ПРО ПРОЕКТ',
                'name_js' => 'content_projects_info',
                'name' => '[projects][info]',
                'col' => '4',
                'type' => 'input',
            ],
            [],
            [
                'name_uk' => 'Таби (Опис)',
                'name_js' => 'content_projects_tabs1',
                'name' => '[projects][tabs][1]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Таби (Інформація)',
                'name_js' => 'content_projects_tabs2',
                'name' => '[projects][tabs][2]',
                'col' => '4',
                'type' => 'input',
            ],
            [],

            [
                'name_uk' => 'Дні',
                'name_js' => 'content_projects_piece2',
                'name' => '[projects][piece][2]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => '(Від)',
                'name_js' => 'content_projects_piece3',
                'name' => '[projects][piece][3]',
                'col' => '4',
                'type' => 'input',
            ],
        ],
    ],
[
        'name' => 'Форма зворотнього звязку',
        'name_en' => 'feedbackCalculate',
        'fields' => [
            [
                'name_uk' => 'Назва кнопки виклику в проекті',
                'name_js' => 'content_feedbackCalculate_buttonCall2',
                'name' => '[feedbackCalculate][buttonCall2]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Назва кнопки виклику',
                'name_js' => 'content_feedbackCalculate_buttonCall',
                'name' => '[feedbackCalculate][buttonCall]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_feedbackCalculate_title',
                'name' => '[feedbackCalculate][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Опис',
                'name_js' => 'content_feedbackCalculate_description',
                'name' => '[feedbackCalculate][description]',
                'col' => '4',
                'type' => 'textarea',
            ],
            [
                'name_uk' => 'Кнопка',
                'name_js' => 'content_feedbackCalculate_button',
                'name' => '[feedbackCalculate][button]',
                'col' => '4',
                'type' => 'input',
            ],
        ]
    ],
    [
        'name' => 'Форма зворотнього звязку (Консультація)',
        'name_en' => 'feedbackAdvice',
        'fields' => [
            [
                'name_uk' => 'Назва кнопки виклику',
                'name_js' => 'content_feedbackAdvice_buttonCall',
                'name' => '[feedbackAdvice][buttonCall]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Заголовок',
                'name_js' => 'content_feedbackAdvice_title',
                'name' => '[feedbackAdvice][title]',
                'col' => '4',
                'type' => 'input',
            ],
            [
                'name_uk' => 'Опис',
                'name_js' => 'content_feedbackAdvice_description',
                'name' => '[feedbackAdvice][description]',
                'col' => '4',
                'type' => 'textarea',
            ],
            [
                'name_uk' => 'Кнопка',
                'name_js' => 'content_feedbackAdvice_button',
                'name' => '[feedbackAdvice][button]',
                'col' => '4',
                'type' => 'input',
            ],
        ]
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
