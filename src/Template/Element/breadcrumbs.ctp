<ul class="breadcrumbs">
    <?php if (!empty($crumbs) && $crumbs) {
        $c = 1;
        foreach ($crumbs as $href => $crumb) { ?>
            <li class="breadcrumbs__item <?= ($c === 1) ? '' : 'js-seconds' ?>" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                <a <?= (!empty($href)) ? 'href="'.$href.'"' : '' ?> class="breadcrumbs__link" itemprop="url"><?= $crumb ?></a>
            </li>
        <?php
            $c++;
        }
    } ?>
    <li class="breadcrumbs__item">
        <a class="breadcrumbs__link active" itemprop="url"> <?= $active ?></a>
    </li>
</ul>
