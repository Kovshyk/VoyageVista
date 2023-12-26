

<!--<div class="loader">-->
<!--    <div class="loader__body">-->
<!--        <div class="loader__gif" style="background-image: url(/frontend/img/loader-mini.gif?);"></div>-->
<!--        <div class="loader__text">-->
<!--            <div>Wonder<span>Wood</span></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<?= $this->element('info-bar') ?>
<?= $this->element('header') ?>

<section>
    <div class="app-carousel">
        <div class="app-carousel__cell" style="background-image: url(/frontend/img/home/header-item-1.png);">
            <div class="cell-desc" style="color: var(--col-orange);">
                <div class="header-desc-logo" style="width: 130px; height:85px"></div>
                <h1 class="app-carousel__title"  style="color: var(--col-orange);">VoyageVista</h1>
                <p class="app-carousel__subtitle --type-1"  style="color: var(--col-orange);"><?= $page->getContentField(['home1', 'slide1', 'description']) ?></p>
                <button class="btn btn-primary m-auto go-down">
                    <span class="main-head-down icon-chevron-down"></span>
                    <i class="main-head-down icon-chevron-down"></i>
                </button>
            </div>
        </div>
        <div class="app-carousel__cell" style="background-image: url(/frontend/img/home/header-item-3.png);">
            <div class="cell-desc"  style="color: var(--col-orange);">
                <h2 class="app-carousel__title"  style="color: var(--col-orange);"><?= $page->getContentField(['home1', 'slide2', 'title']) ?></h2>
                <p class="app-carousel__subtitle "  style="color: var(--col-orange);"><?= $page->getContentField(['home1', 'slide2', 'description']) ?></p>
                <a href="<?= $this->getNiceUrl('/services'); ?>" class="btn btn-primary">
                    <span><?= $page->getContentField(['home1', 'slide2', 'button']) ?></span>
                    <i class="icon-long-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="app-carousel__cell" style="background-image: url(/frontend/img/home/header-item-2.png);">
            <div class="cell-desc" >
                <h2 class="app-carousel__title"  style="color: var(--col-orange);"><?= $page->getContentField(['home1', 'slide3', 'title']) ?></h2>
                <p class="app-carousel__subtitle --type-2"  style="color: var(--col-orange);"><?= $page->getContentField(['home1', 'slide3', 'description']) ?></p>
                <a href="<?= $this->getNiceUrl('/projects'); ?>" class="btn btn-primary">
                    <span><?= $page->getContentField(['home1', 'slide3', 'button']) ?></span>
                    <i class="icon-long-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="homes" class="homes">
    <div class="container">
        <div class="row m-row">
            <div class="column col-lg-6 col-md-7 col-xs-12 homes-column">
                <div  class="homes-carousel">
                    <div data-bottom-top="background-position-x: -200px;" data-center="background-position-x: -100px; "
                         class="homes-carousel__cell" style="background-image: url(/frontend/img/home/slider-item-1.jpg);"></div>

                    <div data-bottom-top="background-position-x: -200px; " data-center="background-position-x: -100px; "
                         class="homes-carousel__cell" style="background-image: url(/frontend/img/home/slider-item-2.png);"></div>

                    <div data-bottom-top="background-position-x: -100px; " data-center="background-position-x: 0px; "
                         class="homes-carousel__cell" style="background-image: url(/frontend/img/home/slider-item-3.jpg);"></div>

                    <div data-bottom-top="background-position-x: -200px; " data-center="background-position-x: -100px; "
                         class="homes-carousel__cell" style="background-image: url(/frontend/img/home/slider-item-4.jpg);"></div>

                    <div data-bottom-top="background-position-x: -200px; " data-center="background-position-x: -100px; "
                         class="homes-carousel__cell" style="background-image: url(/frontend/img/home/slider-item-5.jpg);"></div>

                    <div data-bottom-top="background-position-x: -200px; " data-center="background-position-x: -100px; "
                         class="homes-carousel__cell" style="background-image: url(/frontend/img/home/slider-item-6.jpeg);"></div>

                    <div data-bottom-top="background-position-x: -200px; " data-center="background-position-x: -100px; "
                         class="homes-carousel__cell" style="background-image: url(/frontend/img/home/slider-item-7.jpg);"></div>

                    <div data-bottom-top="background-position-x: -200px; " data-center="background-position-x: -100px; "
                         class="homes-carousel__cell" style="background-image: url(/frontend/img/home/slider-item-8.jpg);"></div>


                </div>
            </div>
            <div class="column col-lg-5 large-offset-1 col-md-5 medium-offset-0 col-xs-12 homes-column">
                <div data-bottom-top="left: 0;" data-center-top="left: 0%;" class="homes-desc">
                    <h2 class="heading-2 homes-desc__title"><?= $page->getContentField(['home2', 'title']) ?></h2>
                    <i data-bottom-top="width: 0px;" data-center-top="width: 95px" class="line-inline"> </i>
                    <p class="app-txt"><?= $page->getContentField(['home2', 'description']) ?></p>
                    <a href="<?= $this->getNiceUrl('/projects'); ?>" class="btn btn-primary">
                        <span><?= $page->getContentField(['home2', 'button']) ?></span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="weoffer" class="weoffer">
    <div class="container">
        <div class="row m-row">
        <div class="column col-lg-6 col-md-6 col-xs-12 align-self-bottom">
            <div class="weoffer-desc">
                <h2 class="heading-2 weoffer__title"><?= $page->getContentField(['home3', 'title']) ?></h2>
                <div class="weoffer-wrap">
                    <div class="weoffer-item col-lg-6 column col-md-6 col-xs-12">
                        <a href="<?= $this->getNiceUrl('/projects'); ?>" target="_blank" class="offer-title">
                            <span class="line"></span>
                            <h3><?= $page->getContentField(['home3', 'block1', 'title']) ?></h3>
                        </a>
                        <p class="app-txt"><?= $page->getContentField(['home3', 'block1', 'description']) ?></p>
                    </div>
                    <div class="weoffer-item col-lg-6 column col-md-6 col-xs-12">
                        <a href="<?= $this->getNiceUrl('/projects'); ?>" target="_blank" class="offer-title">
                            <span class="line"></span>
                            <h3><?= $page->getContentField(['home3', 'block2', 'title']) ?></h3>
                        </a>
                        <p class="app-txt"><?= $page->getContentField(['home3', 'block2', 'description']) ?></p>
                    </div>
                    <div class="weoffer-item col-lg-6 column col-md-6 col-xs-12">
                        <a href="<?= $this->getNiceUrl('/projects'); ?>" target="_blank" class="offer-title">
                            <span class="line"></span>
                            <h3><?= $page->getContentField(['home3', 'block3', 'title']) ?></h3>
                        </a>
                        <p class="app-txt"><?= $page->getContentField(['home3', 'block3', 'description']) ?></p>
                    </div>
                    <div class="weoffer-item col-lg-6 column col-md-6 col-xs-12">
                        <a href="<?= $this->getNiceUrl('/projects'); ?>" target="_blank" class="offer-title">
                            <span class="line"></span>
                            <h3><?= $page->getContentField(['home3', 'block4', 'title']) ?></h3>
                        </a>
                        <p class="app-txt"><?= $page->getContentField(['home3', 'block4', 'description']) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="column col-lg-6 col-md-6 col-xs-12">
            <div data-bottom-top="background-position-x: 0px;" data-center="background-position-x: -220px;" class="weoffer-img"></div>
        </div>
    </div>
    </div>
</section>



<section id="services" class="services">
    <h2 class="services__title heading-2 text-center"><?= $page->getContentField(['home5', 'title']) ?></h2>
    <div class="container">
        <div class="row m-row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 column">
            <div class="services-item">
                <a href="<?= $this->getNiceUrl('/services?section=documents#servis'); ?>" target="_blank" class="services-title">
                    <span class="line"></span>
                    <h3><?= $page->getContentField(['home5', 'block1', 'title']) ?></h3>
                </a>
                <p class="services-text app-txt"><?= $page->getContentField(['home5', 'block1', 'description']) ?></p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 column">
            <div class="services-item">
                <a href="<?= $this->getNiceUrl('/services?section=fireplaces#servis'); ?>" target="_blank" class="services-title">
                    <span class="line"></span>
                    <h3><?= $page->getContentField(['home5', 'block2', 'title']) ?></h3>
                </a>
                <p class="services-text app-txt"><?= $page->getContentField(['home5', 'block2', 'description']) ?></p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 column">
            <div class="services-item">
                <a href="<?= $this->getNiceUrl('/services?section=water#servis'); ?>" target="_blank" class="services-title">
                    <span class="line"></span>
                    <h3><?= $page->getContentField(['home5', 'block3', 'title']) ?></h3>
                </a>
                <p class="services-text app-txt"><?= $page->getContentField(['home5', 'block3', 'description']) ?></p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 column">
            <div class="services-item">
                <a href="<?= $this->getNiceUrl('/services?section=furniture#servis'); ?>" target="_blank" class="services-title">
                    <span class="line"></span>
                    <h3><?= $page->getContentField(['home5', 'block4', 'title']) ?></h3>
                </a>
                <p class="services-text app-txt"><?= $page->getContentField(['home5', 'block4', 'description']) ?></p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 column">
            <div class="services-item">
                <a href="<?= $this->getNiceUrl('/services?section=saunas#servis'); ?>" target="_blank" class="services-title">
                    <span class="line"></span>
                    <h3><?= $page->getContentField(['home5', 'block5', 'title']) ?></h3>
                </a>
                <p class="services-text app-txt"><?= $page->getContentField(['home5', 'block5', 'description']) ?></p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 column">
            <div class="services-item">
                <a href="<?= $this->getNiceUrl('/services?section=stavni#servis'); ?>" target="_blank" class="services-title">
                    <span class="line"></span>
                    <h3><?= $page->getContentField(['home5', 'block6', 'title']) ?></h3>
                </a>
                <p class="services-text app-txt"><?= $page->getContentField(['home5', 'block6', 'description']) ?></p>
            </div>
        </div>
    </div>
    </div>
</section>

<!--<section class="wonder-price display-table">-->
<!--    <div class="display-table__cell">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="wonder-price__wrap column col-xs-12">-->
<!--                    <div class="row">-->
<!--                        <div class="col-lg-5 large-offset-1 col-xs-12 col-md-6">-->
<!--                            <div class="wonder-price__inside">-->
<!--                                <h2 class="mb-30">--><?//= $page->getContentField(['home6', 'title']) ?><!--</h2>-->
<!--                                <a href="--><?//= $this->getNiceUrl('/projects'); ?><!--" class="btn btn-secondary">--><?//= $page->getContentField(['home6', 'button']) ?><!--</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-lg-5 large-offset-1 col-md-6 hide-for-small-only column wonder-price__column">-->
<!--                            <div class="wonder-price__image"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->





<?php $this->append('pageScript'); ?>
<script src="/frontend/js/libs/flickity.pkgd.js"></script>
<script src="/frontend/js/libs/jquery.mixitup.js"></script>
<script src="/frontend/js/libs/lightgallery.js"></script>
<script src="/frontend/js/libs/skrollr.min.js"></script>
<script type="text/javascript">
    $(function () {


        flicky.newSlider('.app-carousel', {
            arrowShape: {
                x0: 10,
                x1: 55, y1: 40,
                x2: 60, y2: 35,
                x3: 20
            }
        });
        flicky.newSlider('.homes-carousel', {
            arrowShape: {
                x0: 10,
                x1: 55, y1: 40,
                x2: 60, y2: 35,
                x3: 20
            }
        });

        $('#Container').mixItUp();
        skrollParallax.init();


        $('.main-gallery').lightGallery({
            selector: '.galerry-zoom'
        });
    });
</script>
<?php $this->end(); ?>