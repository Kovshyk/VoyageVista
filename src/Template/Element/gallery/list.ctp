<?php if (!empty($galleries)){ ?>
<div id="gallery-sort" class="gallery__main js-gallery__main">
    <?php foreach ($galleries as $key => $gallery) { ?>
        <?php if ($gallery->type === 'photo') { ?>
            <div class="gallery__items mix category_<?= $gallery->gallery_category_id ?>" data-src="<?= $gallery->img_src ?>" style="display: block">
                <div class="gallery__item">
                    <img src="<?= $gallery->img_src ?>"
                         alt="<?=h($gallery->title)?>" title="<?=h($gallery->title)?>" class="gallery__image" >
                    <div class="overlay">
                        <a href="<?= $gallery->video_href ?>" class="galerry-zoom">
                            <i class="view-galerry"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="gallery__items mix category_<?= $gallery->gallery_category_id ?>" data-src="<?= $gallery->video_href ?>" style="display: block">
                <div class="gallery__item">
                    <iframe class="gallery__img" src="<?= $gallery->video_href ?>" frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <div class="overlay">
                        <a href="<?= $gallery->video_href ?>" class="galerry-zoom">
                            <i class="view-galerry"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }; ?>
</div>
<?php }; ?>