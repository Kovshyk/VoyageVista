<?= $this->element('info-bar') ?>
<?= $this->element('header') ?>

<section class="page-head display-table" style="background-image: url(/frontend/img/backgrounds/about-bg.jpg)">
    <div class="display-table__cell">
        <div class="container">
            <h1 class="heading-1 --white text-center"><?= $page->getContentField(['about_us', 'title']) ?></h1>
        </div>
    </div>
</section>

<div class="container">
    <?= $this->element('breadcrumbs', [
        'crumbs' => [$this->getNiceUrl('/') => $layout_page->getContentField(['menu', 'home'])],
        'active' => $page->getContentField(['about_us', 'title'])
    ]); ?>
</div>

<section>
    <div class="container">
        <div class="row m-row align-center">
            <div class="col-lg-10 column">
                <div class="about-top">
                    <?= $page->getContentField(['about_us', 'description']) ?>
                    <i class="icon-angle-double-down" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-how">
    <div class="container">
        <div class="row m-row align-center">
            <div class="column col-lg-10 col-xs-12">
                <div data-bottom-top="transform: translateY(60px); " data-center="transform: translateY(0px);" class="how-about-card ">
                    <div class="col-lg-6 col-md-6 col-xs-12 about-card-img"></div>
                    <div class="col-lg-6 col-md-6 col-xs-12  about-card-text">
                        <h2 class="about-card-text__title"><?= $page->getContentField(['section1', 'title']) ?></h2>
                        <p class="app-txt about-card-text__txt"><?= $page->getContentField(['section1', 'description']) ?>
                            <i class="about-card-text__line --line-1"></i>
                            <i class="about-card-text__line --line-2"></i>
                        </p>
                        <button
                                data-title="<?= $page->getContentField(['section1Feedback', 'title']) ?>"
                                data-description="<?= $page->getContentField(['section1Feedback', 'description']) ?>"
                                data-button_name="<?= $page->getContentField(['section1Feedback', 'button']) ?>"
                                data-type="formAbout"
                                class="btn btn-primary m-auto popup-link">
                            <span><?= $page->getContentField(['section1Feedback', 'buttonCall']) ?></span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-result">
    <div class="container">
        <h2 class="heading-2 text-center about-result__title"><?= $page->getContentField(['section2', 'title']) ?></h2>
        <div class="row m-row align-center">
            <div class="col-xl-10 col-xs-12 column">
                <div class="row align-middle result-row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div data-bottom-top="transform: translateX(100px)" data-center-top="transform: translateX(0px)"
                             class="result-img" style="background-image: url(/frontend/img/about-result1.png)"></div>
                    </div>
                    <div class="column large-offset-1 medium-offset-2 col-lg-5 col-md-4 col-xs-12">
                        <div data-bottom-top="transform: translateX(-90px)" data-center="transform: translateX(0px)" class="result-text result-text-right">
                            <p class="app-txt"><?= $page->getContentField(['section2', 'description1']) ?></p>
                        </div>
                    </div>
                    <div data-bottom-top="transform: translateY(-90px)" data-center="transform: translateY(0px)" class="result-count">
                        <div class="result-count-body">
                            <span>01</span>
                        </div>
                    </div>
                </div>
                <div class="row align-middle result-row --reverse">
                    <div class="column col-lg-6 col-md-5 col-xs-12 column-first">
                        <div data-bottom-top="transform: translateX(90px)" data-center="transform: translateX(0px)" class="result-text result-text-left">
                            <p class="app-txt"><?= $page->getContentField(['section2', 'description2']) ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 medium-offset-1 large-offset-0 col-xs-12 column-second">
                        <div data-bottom-top="transform: translateX(-100px)" data-center="transform: translateX(0px)" class="result-img" style="background-image: url(/frontend/img/about-result2.png)"></div>
                    </div>
                    <div data-bottom-top="transform: translateY(90px)" data-center="transform: translateY(0px)" class="result-count">
                        <div class="result-count-body">
                            <span>02</span>
                        </div>
                    </div>
                </div>
                <div class="row align-middle result-row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div data-bottom-top="transform: translateX(100px)" data-center="transform: translateX(0px)" class="result-img" style="background-image: url(/frontend/img/about-result3.png)"></div>
                    </div>
                    <div class="column large-offset-1 medium-offset-2 col-lg-5 col-md-4 col-xs-12">
                        <div data-bottom-top="transform: translateX(-90px)" data-center="transform: translateX(0px)" class="result-text result-text-right">
                            <p class="app-txt"><?= $page->getContentField(['section2', 'description3']) ?></p>
                        </div>
                    </div>
                    <div data-bottom-top="transform: translateY(-90px)" data-center="transform: translateY(0px)" class="result-count">
                        <div class="result-count-body">
                            <span>03</span>
                        </div>
                    </div>
                </div>
                <div class="row align-middle result-row --reverse">
                    <div class="column col-lg-6 col-md-5 col-xs-12 column-first">
                        <div data-bottom-top="transform: translateX(90px)" data-center="transform: translateX(0px)" class="result-text result-text-left">
                            <p class="app-txt"><?= $page->getContentField(['section2', 'description4']) ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 medium-offset-1 large-offset-0 col-xs-12 column-second">
                        <div data-bottom-top="transform: translateX(-100px)" data-center="transform: translateX(0px)" class="result-img" style="background-image: url(/frontend/img/about-result4.png)"></div>
                    </div>
                    <div data-bottom-top="transform: translateY(90px)" data-center="transform: translateY(0px)" class="result-count">
                        <div class="result-count-body">
                            <span>04</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->element('wonder-price', [
        'title' => $page->getContentField(['section4', 'title']),
        'price_description' => $page->getContentField(['section4', 'description']),
        'price_inputTitle' => $page->getContentField(['section4', 'inputTitle']),
        'price_inputDescription' => $page->getContentField(['section4', 'inputDescription']),
        'btn_txt' => $page->getContentField(['section4', 'button']),
        'type' => 'documentAbout'
]) ?>

<?php $this->append('pageScript'); ?>
<script src="/frontend/js/libs/skrollr.min.js"></script>
<script>
    jQuery(function () {
        skrollParallax.init();
    });
</script>
<?php $this->end(); ?>
