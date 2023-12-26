<?= $this->element('info-bar') ?>
<?= $this->element('header') ?>

<section class="static-page display-table ">
    <div class="display-table__cell">
        <div class="container">
            <div class="header-desc-logo"></div>
            <h1 class="app-carousel__title"><?= $page->getContentField(['thanks', 'title']) ?></h1>
            <p class="app-carousel__subtitle"><?= $page->getContentField(['thanks', 'description']) ?></p>
            <a href="<?= $this->getNiceUrl('/'); ?>" class="btn btn-primary m-auto">
                <span><?= $page->getContentField(['thanks', 'button']) ?></span>
                <i class="icon-long-arrow-right"></i>
            </a>
        </div>
    </div>
</section>