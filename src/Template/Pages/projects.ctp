<div class="projects-fixed-nav">
    <?= $this->element('header') ?>
</div>
<div class="projects">
    <div class="container">
        <?= $this->element('breadcrumbs', [
            'crumbs' => [$this->getNiceUrl('/') => $layout_page->getContentField(['menu', 'home'])],
            'active' => (!empty($active_category)) ? $active_category->name : $page->getContentField(['projects', 'title'])
        ]); ?>
    </div>
    <?php if(!empty($active_category)) { ?>
        <h1 class="heading-1 --lower-size projects__title text-center"><?= $active_category->name ?></h1>
        <?php if(!empty($active_category->short_description)) { ?>
            <div class="projects-items__item__sqr" style="text-align: center"><?= $active_category->short_description ?></div>
        <?php } ?>
    <?php } else { ?>
        <h1 class="heading-1 --lower-size projects__title text-center"><?= $page->getContentField(['projects', 'title']) ?></h1>

        <?php if(!empty($page->getContentField(['projects', 'title_text']))) { ?>
            <div class="projects-items__item__sqr" style="text-align: center"><?= $page->getContentField(['projects', 'title_text']) ?></div>
        <?php } ?>
    <?php } ?>
    <div class="container">
        <div class="projects__line">
            <i class="logo-sm"></i>
            <i class="inline line-l"></i>
        </div>
        <div class="row m-row">
            <div class="column col-lg-3 col-xs-12 t-sidebar">
                <div class="category">
                    <ul class="category__nav controls">
                        <li class="category__item"><?= $page->getContentField(['projects', 'categories']) ?></li>
                        <li class="category__item">
                            <a href="<?= $this->getNiceUrl('/projects') ?>" class="category__link <?= (empty($active_category)) ? 'active' : '' ?>  "><?= $page->getContentField(['projects', 'categoriesAll']) ?></a>
                        </li>
                        <?php if (!empty($categories)) {
                            foreach ($categories as $category) {
                                $slug = 'slug_'.$lang;
                                $enable = 'enable_'.$lang;
                                $loc = ($lang == 'uk') ? '/' : '/'.$lang.'/';
                                if(empty($category->$slug) || empty($category->$enable)) {
                                    continue;
                                }
                                ?>
                                <li class="category__item ">
                                    <a href="<?= $loc.$category->$slug ?>"
                                       class="category__link <?= (!empty($active_category) && $active_category->id === $category->id) ? 'active' : '' ?>"><?= $category->name ?></a>
                                </li>
                            <?php }
                        } ?>
                    </ul>
                </div>
            </div>
            <?= $this->element('projects_list') ?>
        </div>
    </div>
</div>

<div class="seo-text">
    <div class="container">
        <div class="text-content">
            <?= (!empty($active_category)) ? $active_category->seo_text : $page->getContentField(['seo_text']) ?>
        </div>
    </div>
</div>
<?php $this->append('pageScript') ?>
<script src="/frontend/js/libs/jquery.mixitup.js"></script>
<script>
    $(function () {
        $('#Container').mixItUp();
    });
</script>
<script>
    var projects = {
        mix: 0,
        sort_field: 'modified',
        sort_direction: 'desc',
        mixSelector: $('#categor'),
        filter: '*',
        init: function () {
            this.mixSelector.mixItUp({
                load: {
                    filter: this.filter,
//                    sort: this.sort_field + ':' + this.sort_direction
                },
            });
//            this.sortInit();
            this.events();
        },
        sortInit: function () {
            this.mixSelector.mixItUp('filter', this.filter);
            this.mixSelector.mixItUp('sort', this.sort_field + ':' + this.sort_direction);
        },
        events: function () {
            var self = this;
            $(document).on('click', '.category__link', function (e) {
                e.preventDefault();
                if (window.innerWidth > 575){
                    window.location.href = $(this).attr('href');
                } else {
                    window.location.href = $(this).attr('href') + '#categor';
                }
                // $('.category__link').removeClass('active');
                // $(this).addClass('active');
                // self.filter = $(this).data('filter');
                // self.sortInit();
            });

            $(document).on('click', '.js_change_sort_field', function () {
                if ($(this).hasClass('active')) {
                    return false;
                }
                $('.js_sort_direction_text').text($(this).data('text_' + self.sort_direction));
                $('.js_change_sort_direction[data-direction="asc"]').text($(this).data('text_asc'));
                $('.js_change_sort_direction[data-direction="desc"]').text($(this).data('text_desc'));

                $('.js_change_sort_direction').removeClass('active');
                $('.js_change_sort_direction[data-direction="' + self.sort_direction + '"]').addClass('active');

                $('.js_change_sort_field').removeClass('active');
                $(this).addClass('active');
                $('.js_sort_field_text').text($(this).text());

                self.sort_field = $(this).data('field');
                self.sortInit();
            });

            $(document).on('click', '.js_projects_sort', function () {
                $(this).find('.projects-main__sort__other').toggle();
            });

            $(document).on('click', '.js_change_sort_direction', function () {
                $('.js_sort_direction_text').text($(this).text());
                $('.js_change_sort_direction').removeClass('active');
                $(this).addClass('active');
                self.sort_direction = $(this).data('direction');
                self.sortInit();
            });

            $(document).on('click', function(e) {
                if (!$('.js_projects_sort').is(e.target) && $('.js_projects_sort').has(e.target).length === 0){
                    $('.projects-main__sort__other').hide();
                }
            });
        }
    };
    projects.init();

</script>
<?php $this->end() ?>