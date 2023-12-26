<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-header">Навігація</li>
            <li class="">
                <?= $this->PerfectHTML->linkSB('Дошка', ['fa', 'fa-laptop'], ['controller' => 'Admin', 'action' => 'dashboard']); ?>
            </li>
            <li class=""><a href="/admindom/forms/index">
                    <?php if (!empty($orders_forms_sidebar_count)) { ?>
                        <span class="badge pull-right"><?= $orders_forms_sidebar_count ?></span>
                    <?php } ?>
                    <i class="fa fa-laptop"></i> <span>Форми</span>
                </a>
            </li>
            <li class="has-sub" id="sb-services">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-paint-brush  bg-gradient-blue"></i>
                    <span>Проекти</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="/admindom/categories/index">Категорії</a></li>
                    <li><a href="/admindom/projects/index">Керування проектами</a></li>
                    <li><a href="/admindom/projects/change">Додати проект</a></li>
                    <li><a href="/admindom/projects/prices">Ціни</a></li>
                </ul>
            </li>
            <li class="has-sub" id="sb-services">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-paint-brush  bg-gradient-blue"></i>
                    <span>Галарея</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="/admindom/galleryCategories/index">Категорії</a></li>
                    <li><a href="/admindom/gallery/index">Керування</a></li>
                    <li><a href="/admindom/gallery/imageTitles">Фото (Title / Alt)</a></li>
                </ul>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Сторінки</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="/admindom/pages/page/layout">Шаблон</a></li>
                    <li><a href="/admindom/pages/page/home">Головна</a></li>
                    <li><a href="/admindom/pages/page/projects">Проекти</a></li>
                    <li><a href="/admindom/pages/page/gallery">Галерея</a></li>
                    <li><a href="/admindom/pages/page/about_us">Про нас</a></li>
                    <li><a href="/admindom/pages/page/contacts">Контакти</a></li>
                    <li><a href="/admindom/pages/page/thanks">Сторінка подяки</a></li>
                    <li><a href="/admindom/pages/page/404">Сторінка 404</a></li>
                </ul>
            </li>

            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                            class="fa fa-angle-double-left"></i></a></li>
        </ul>
    </div>
</div>
<div class="sidebar-bg"></div>