<?php
    if (isset($p_pages, $p_href_pre, $p_page) && $p_pages > 1) {
        echo '<ul class="pagination-list">';
        echo $this->Element('NicePagination/posts_direction', ['direction' => 'previous']);
        for ($i = 1; $i <= $p_pages; $i++) {
            if ($p_pages < 5) {
                echo $this->Element('NicePagination/posts_page', ['i' => $i]);
            } else {
                if ($p_page == 1) {
                    if (in_array($i, [1, 2, 3, $p_pages])) {
                        echo $this->Element('NicePagination/posts_page', ['i' => $i]);
                    }
                    if ($i === 4) {
                        echo $this->Element('NicePagination/posts_page', ['i' => '...']);
                    }
                }

                if ($p_page == $p_pages) {
                    if (in_array($i, [1, $p_pages - 2, $p_pages - 1, $p_pages])) {
                        echo $this->Element('NicePagination/posts_page', ['i' => $i]);
                    }
                    if ($i === $p_pages - 3) {
                        echo $this->Element('NicePagination/posts_page', ['i' => '...']);
                    }
                }

                if ($p_page != $p_pages && $p_page != 1) {
                    if ($p_page != 2 && $p_page != 3 && $i === 2) {
                        echo $this->Element('NicePagination/posts_page', ['i' => '...']);
                    }
                    if (in_array($i, [1, $p_page - 1, $p_page, $p_page + 1, $p_pages])) {
                        echo $this->Element('NicePagination/posts_page', ['i' => $i]);
                    }
                    if ($p_page != $p_pages - 1 && $p_page != $p_pages - 2 && $i == $p_pages - 1) {
                        echo $this->Element('NicePagination/posts_page', ['i' => '...']);
                    }
                }
            }
        }
        echo $this->Element('NicePagination/posts_direction', ['direction' => 'next']);
        echo '</ul>';
    }