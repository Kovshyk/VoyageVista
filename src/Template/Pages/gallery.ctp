<div class="projects-fixed-nav">
    <?= $this->element('header') ?>
</div>

<div class="gallery">

    <div class="container">
        <?= $this->element('breadcrumbs', [
            'crumbs' => [$this->getNiceUrl('/') => $layout_page->getContentField(['menu', 'home'])],
            'active' => $page->getContentField(['gallery', 'title'])
        ]); ?>
    </div>

    <h1 class="heading-1 --lower-size text-center  title gallery__title"><?= $page->getContentField(['gallery', 'title']) ?></h1>
    <div class="container">
        <div class="projects__line">
            <i class="logo-sm"></i>
            <i class="inline line-l"></i>
        </div>
    </div>
    <ul class="gallery__nav controls">
        <li class="gallery__linkes">
            <a data-filter="*" class="category__link filter"><?= $page->getContentField(['gallery', 'all']) ?></a>
        </li>
        <?php if(!empty($categories)) {
            foreach ($categories as $category) { ?>
                <li class="gallery__linkes">
                    <a data-filter=".category_<?= $category->id ?>" class="category__link filter"><?= $category->name ?></a>
                </li>
            <?php }
        } ?>
    </ul>
    <div class="wrapper" id="gallery">
        <?= $this->element('gallery/list') ?>
        <?= $this->element('gallery/paginator') ?>
    </div>
</div>

<!--front pagination-->

<?php $this->append('pageScript') ?>
<script src="/frontend/js/libs/jPages.js"></script>
<script src="/frontend/js/libs/jquery.mixitup.js"></script>
<script src="/frontend/js/libs/lightgallery.js"></script>

<script type="text/javascript">

    $('.js-gallery__main').lightGallery({
        // selector: ".project__photo"
    });

    $(function () {
        // $('#gallery-sort').mixItUp();
        //front pagination script
        var pagination = $('.pagination');
        let scroll = false;
        function setPagination(){
            pagination.jPages({
                containerID: 'gallery-sort',
                perPage: 33,
                startPage: 1,
                startRange: 1,
                midRange: 3,
                endRange: 1,
                first: false,
                last: false,
                callback: function( pages){
                    if(scroll){
                        $("html, body").animate({ scrollTop: 0 }, 300);
                    } else{
                        scroll = true;
                    }
                }

            });
        }

        function destroyPagination() {
            $('.category__link').css('pointer-events', 'none');
            setTimeout(function () {
                $('.category__link').removeAttr('style');
            }, 2000);
            pagination.jPages('destroy');
        };
        setPagination();

        $('#gallery-sort').mixItUp({
            load: {
                filter: '*'
            },
            callbacks: {
                onMixLoad: function(state,futureState ){

                    //setPagination();
                },
                onMixStart: function(state,futureState ){
                    destroyPagination();

                },
                onMixEnd: function(state, futureState){
                    setPagination();
                }
            }
        });

    });

</script>
<?php $this->end() ?>
