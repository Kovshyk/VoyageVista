<ol class="breadcrumb pull-right">
    <li><a href="/admindom/dashboard">Дошка</a></li>
    <?php if (!empty($crumbs) && $crumbs) {
        foreach ($crumbs as $href => $crumb) { ?>
            <li><a <?= (!empty($href)) ? "href=\"$href\"" : '' ?>><?= $crumb ?></a></li>
        <?php }
    } ?>
    <li class="active"><?= $active ?></li>
</ol>
<h1 class="page-header"><?= $active ?></h1>
