<header class="header">
    <div class="container">
        <div class="row m-row align-middle align-justify header__row">
            <div class="header__column">
                <a href="<?= $this->getNiceUrl('/'); ?>">
                    <img src="/frontend/img/logo/logo-nav.png" class="header__logo" alt="VoyageVista logo" title="VoyageVista logo" style="max-width: 120px">
                </a>
            </div>
           <div class="header__column">
               <ul class="menu-main" style="<?= ($lang == 'de') ? 'padding-right:30px;' : '' ?>" >
                   <li><a href="<?= $this->getNiceUrl('/'); ?>"><?= $layout_page->getContentField(['menu', 'home']) ?></a></li>
                   <li><a href="<?= $this->getNiceUrl('/projects'); ?>"><?= $layout_page->getContentField(['menu', 'projects']) ?></a></li>
                   <li><a href="<?= $this->getNiceUrl('/gallery'); ?>"><?= $layout_page->getContentField(['menu', 'gallery']) ?></a></li>
                   <li><a href="<?= $this->getNiceUrl('/about_us'); ?>"><?= $layout_page->getContentField(['menu', 'about_us']) ?></a></li>
                   <li><a href="<?= $this->getNiceUrl('/contacts'); ?>"><?= $layout_page->getContentField(['menu', 'contacts']) ?></a></li>
                   <li class="language">
                       <a class="language__link  js-lang-uk active"><?= ($lang == 'uk') ? 'UA' : mb_strtoupper($lang) ?></a>
                       <ul class="language__list">
                           <?php foreach (['uk', 'ru', 'en','de','pl'] as $item) {
                               if($item !== $lang) { ?>
                                   <li class="language__item">
                                       <a href="<?= $this->getLanguageHref($item) ?>" class="language__link js-lang-ru"><?= ($item == 'uk') ? 'UA' : mb_strtoupper($item) ?></a>
                                   </li>
                               <?php }
                           } ?>
                       </ul>
                   </li>
               </ul>

           </div>
            <div class="nav-menu"><span></span><span></span><span></span></div>
            <div class="nav-close"> </div>
        </div>
    </div>
</header>
