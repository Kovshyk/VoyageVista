<div class="projects-fixed-nav">
    <?= $this->element('header') ?>
</div>

<div class="project">

    <div class="container">
        <?= $this->element('breadcrumbs', [
            'crumbs' => [$this->getNiceUrl('/') => $layout_page->getContentField(['menu', 'home']), $this->getNiceUrl('/projects') => $page->getContentField(['projects', 'title'])],
            'active' => (!empty($project->name)? $project->name : '')
        ]); ?>
    </div>

    <h1 class="heading-1 --lower-size text-center title projects__title"><?=(!empty($project->name)? $project->name : '')?></h1>

    <div class="project__slider">
        <div class="container">
            <div class="row m-row align-middle">
                <div class="column col-lg-7 col-xs-12 ">
                    <div class="project-carousel" id="project-thumbnials">
                        <?php if(!empty($project->photos[0])){ ?>
                            <?php foreach ($project->photos as $key => $photo) {?>
                                <div class="project__photo carousel-cell" id="cell-<?=$photo->id?>" data-src="<?=$photo->img_src?>">
                                    <img src="<?=$photo->img_src?>" style="display: none"
                                         alt="<?=h($photo->title)?>" title="<?=h($photo->title)?>">
                                    <div class="project__photo__img" style="background-image: url(<?=$photo->img_src?>)">
                                        <div class="overlay">
                                            <i class="view-galerry"></i>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        <?php }?>
                    </div>
                </div>

                <div class="column col-lg-5">
                    <div class="project__images-list">
                        <?php if(!empty($project->photos[0])){ ?>
                            <?php foreach ($project->photos as $photo) {?>
                            <div class="project__images-list__column">
                                <a href="#cell-<?=$photo->id?>" class="project__images-list__link">
                                    <div class="project__images-list__item" style="background-image:  url(<?=$photo->img_src?>)"></div>
                                </a>
                            </div>
                            <?php }?>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="project-info">
        <div class="container">
            <h2 class="project-info__sub-title"><?=(!empty($project->short_description)? $project->short_description : '')?></h2>
            <h3 class="project-info__title"><?= $page->getContentField(['projects', 'info']) ?></h3>
            <div class="row row-cent">
                <div class="column col-lg-8">
                    <div class="projects__line">
                        <i class="logo-sm"></i>
                        <i class="inline line-l"></i>
                    </div>
                </div>
            </div>
            <div class="row m-row row-cent row-vert">
                <div class="col-lg-4 column">

                    <div class="projects-items__item__sqr"><?= $page->getContentField(['projects', 'totalSquare']) ?> <span><?=(!empty($project->area)? $project->area +$project->area_add : '')?> <?= $page->getContentField(['projects', 'piece', 2]) ?> </span></div>

                    <?php foreach ($prices as $price){

                            if(in_array($price->id, json_decode($project->prices))){
                                $price=$price->price_uk;
                            }

                    } ?>
                    <div class="projects-items__item__sqr"><?= $page->getContentField(['projects', 'piece', 3]) ?> <span><?=(!empty($project->prices)? $price * $project->area : '')?> $ </span></div>
                </div>
                <div class="col-lg-4 column">
                    <a class="btn-or project-bottom__btn popup-link" data-title="<?= $page->getContentField(['feedbackAdvice', 'title']) ?>"
                       data-description="<?= $page->getContentField(['feedbackAdvice', 'description']) ?>"
                       data-button_name="<?= $page->getContentField(['feedbackAdvice', 'button']) ?>"
                       data-type="formPhone"><?= $page->getContentField(['feedbackAdvice', 'buttonCall']) ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="project-main">
        <div class="container">
            <div class="row m-row">
                <div class="column col-lg-12 col-xs-12">
                    <div class="tabs">
                        <ul class="tabs__list">
                            <li class="tabs__item active" id="tab-links1">
                                <?= $page->getContentField(['projects', 'tabs', 1]) ?>
                            </li>
                            <li class="tabs__item" id="tab-links2">
                                <?= $page->getContentField(['projects', 'tabs', 2]) ?>
                            </li>

                        </ul>
                        <div class="tabs__content">
                            <div class="tab-content active" id="tab-1" style="display: block;">
                                 <?=(!empty($project->complet) ? $project->complet : '')?>
                            </div>
                            <div class="tab-content" id="tab-2" style="display: none;">
                                <?=(!empty($project->construct) ? $project->construct : '')?>
                            </div>


                        </div>
                    </div>
                    <div class="project-bottom">
                        <a class="btn-or project-info__btn popup-link" data-title="<?= $page->getContentField(['feedbackCalculate', 'title']) ?>"
                           data-description="<?= $page->getContentField(['feedbackCalculate', 'description']) ?>"
                           data-button_name="<?= $page->getContentField(['feedbackCalculate', 'button']) ?>"
                           data-type="formPhone"
                        ><?= $page->getContentField(['feedbackCalculate', 'buttonCall2']) ?></a>
                        <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"
                             data-layout="button_count" data-size="small" data-mobile-iframe="true">
                            <a target="_blank"
                               href="https://www.facebook.com/sharer/sharer.php?u=<?php echo DOMAIN.$this->request->here; ?>&amp;src=sdkpreparse"
                               class="fb-xfbml-parse-ignore">
                                <svg viewBox="0 0 24 24">
                                    <path d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M18,5H15.5A3.5,3.5 0 0,0 12,8.5V11H10V14H12V21H15V14H18V11H15V9A1,1 0 0,1 16,8H18V5Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->append('pageScript') ?>

<script src="/frontend/js/libs/lightgallery.js"></script>

<script src="/frontend/js/libs/flickity.pkgd.js"></script>
<script src="/frontend/js/libs/flicky-hash.js"></script>
<script>

    let flicky_slider = {
        selectedCell: 0,
        slider_options_default: {
            wrapAround: true,
            pageDots: false,
            prevNextButtons: true,
            autoPlay: false,
            cellAlign: 'left',
            contain: true,
            imagesLoaded: true,
            hash: true
        },

        init: function () {
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                flicky_slider.newSlider('.project-carousel', {draggable: false});
            } else{
                flicky_slider.newSlider('.project-carousel');
            }
        },

        updateStatus: function(carousel){
            flicky_slider.selectedCell = carousel.selectedIndex + 1;
            $('.project__images-list__link').removeClass('active');
            $(".project__images-list > .project__images-list__column:nth-child(" + this.selectedCell + ") a").addClass('active');
        },

        newSlider: function (selector, options) {
            options = (options !== undefined) ? Object.assign({}, this.slider_options_default, options) : this.slider_options_default;
            var carousel = new Flickity(document.querySelector(selector), options);
            carousel.on('select', function (e) {
                flicky_slider.updateStatus(carousel);
            });
            return new Flickity(document.querySelector(selector), options);
        }
    };

    jQuery(function () {
        flicky_slider.init();
    });

    $('#project-thumbnials').lightGallery({
    });

</script>
<?php $this->end() ?>



