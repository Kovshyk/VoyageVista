<?php if(isset($p_pages, $p_href_pre, $p_page, $direction)) {
    $href = '';
    if($direction == 'next') {
        $href = ($p_pages == $p_page) ? '' : $this->getNiceUrl($p_href_pre.'/page/'.($p_page+1));
    }
    if($direction == 'previous') {
        if($p_page == 1) {
            $href = '';
        } else {
            $href = (($p_page - 1) == 1) ? $this->getNiceUrl($p_href_pre) : $this->getNiceUrl($p_href_pre.'/page/'.($p_page - 1));
        }
    }
    ?>
    <li class="pagination-list__item">
        <a <?= (!empty($href)) ? 'href="'.$href.'"' : '' ?>
                class="pagination-list__link <?= (empty($href)) ? 'disabled' : '' ?>
                <?= ($direction == 'next') ? 'icon-chevron-right' : 'icon-chevron-left' ?> --button"></a>
    </li>
<?php } ?>