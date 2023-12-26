<?php if(isset($p_pages, $p_href_pre, $p_page)) { ?>
<li class="pagination-list__item">
    <a
        <?php if($i !== '...'){ ?>
            href="<?= ($i == 1) ? $this->getNiceUrl($p_href_pre) : $this->getNiceUrl($p_href_pre.'/page/'.$i) ?>"
        <?php } ?>
       class="pagination-list__link <?= ($p_page == $i) ? 'active' : '' ?>"><?= $i ?></a>
</li>
<?php } ?>