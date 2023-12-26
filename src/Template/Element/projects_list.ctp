<?php if (!empty($projects)) { ?>
    <div class="column col-lg-9 col-xs-12 t-sidebar">
        <div class="projects-main">
            <div class="projects-main__sort">
                <?= $page->getContentField(['projects', 'sort', 'name']) ?>
                <div class="projects-main__left js_projects_sort">
                    <div class="projects-main__sort__main">
                        <span class="js_sort_field_text"><?= $page->getContentField(['projects', 'sort', 'choose']) ?></span>
                        <svg class="projects-main__sort__arrow" style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                        </svg>
                    </div>
                    <div class="projects-main__sort__other">
                        <a data-field="price"
                           data-text_asc="<?= $page->getContentField(['projects', 'sort', 'up']) ?>"
                           data-text_desc="<?= $page->getContentField(['projects', 'sort', 'down']) ?>"
                           class="projects-main__sort__other__item
                           js_change_sort_field "><?= $page->getContentField(['projects', 'sort', 'price']) ?></a>

                        <a data-field="area"
                           data-text_asc="<?= $page->getContentField(['projects', 'sort', 'up']) ?>"
                           data-text_desc="<?= $page->getContentField(['projects', 'sort', 'down']) ?>"
                           class="projects-main__sort__other__item
                           js_change_sort_field"><?= $page->getContentField(['projects', 'sort', 'square']) ?></a>
                    </div>
                </div>

                <div class="projects-main__right js_projects_sort">
                    <div class="projects-main__sort__main projects-main__sort__main1">
                        <span class="js_sort_direction_text"><?= $page->getContentField(['projects', 'sort', 'choose']) ?></span>
                        <svg class="projects-main__sort__arrow" style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
                        </svg>
                    </div>
                    <div class="projects-main__sort__other">
                        <a class="projects-main__sort__other__item js_change_sort_direction " data-direction="asc"><?= $page->getContentField(['projects', 'sort', 'up']) ?></a>
                        <a class="projects-main__sort__other__item js_change_sort_direction" data-direction="desc"><?= $page->getContentField(['projects', 'sort', 'down']) ?></a>
                    </div>
                </div>

            </div>
        </div>
        <div id="categor" class="projects-items">
            <?php foreach ($projects as $project) { ?>
                <div class="projects-items__item mix <?= 'category_'.$project->category_id ?>" style="display: block"
                     data-modified="<?= (!empty($project->modified) ? $project->modified : '') ?>"
                     data-area="<?= (!empty($project->area) ? $project->area  : '') ?>"
                     data-price="<?= (!empty($project->price) ? $project->price : '') ?>">
                    <a href="<?= (!empty($project->href) ? $this->getNiceUrl($project->href) : '') ?>" class="projects-items__item__img">
                        <div class="overlay"></div>
                        <img class="checkx" src="/frontend/img/eye.png" alt="">
                        <span class="check-txt"><?= $page->getContentField(['projects', 'showProject']) ?></span>
                        <img src="<?= (!empty($project->photos[0]->img_medium) ? $project->photos[0]->img_medium : '') ?>"
                             alt="<?= h($project->photos[0]->title) ?>" title="<?= h($project->photos[0]->title) ?>" class="image projects-items__item__foto">
                    </a>
                    <h2 style="text-transform:none" class="projects-items__item__name"><?= (!empty($project->name) ? $project->name : '') ?></h2>
                    <div class="projects-items__item__sqr"><?= $page->getContentField(['projects', 'totalSquare']) ?> <span><?= (!empty($project->area) ? $project->area  : '') ?> <?= $page->getContentField(['projects', 'piece', 2]) ?></span>
                    </div>
                    <div class="projects-items__item__price"><?= $page->getContentField(['projects', 'piece', 3]) ?> $ <?=(!empty($project->price) ? number_format($project->price, 0, '', ' ') : '')?></div>
                    <a href="<?=(!empty($project->href) ? $this->getNiceUrl($project->href) : '')?>" class="projects-items__item__more"><?= $page->getContentField(['projects', 'showProject']) ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>