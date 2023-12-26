<?php

namespace App\View\Traits;

trait SeoTrait
{

    public function getSeoOptions()
    {
        $request = $this->request->here;
        $url = ($request == '/') ? DOMAIN : DOMAIN . $request;
        $options = [
            'title' => '',
            'description' => '',
            'url' => $url,
            'fb_app_id' => '',
            'og_images' => [],
        ];

        if (!empty($this->get('page'))) {
            $options['title'] = $this->get('page')->seo_title;
            $options['description'] = $this->get('page')->seo_description;
        }

        if ($this->isCategoryPage() && !empty($this->get('active_category'))) {
            $options['title'] = $this->get('active_category')->seo_title;
            $options['description'] = $this->get('active_category')->seo_decription;
        }

        if ($this->isProjectPage() && !empty($this->get('project'))) {
            $options['title'] = $this->get('project')->niceSeoTitle;
            $options['description'] = $this->get('project')->niceSeoDescription;
            $options['og_images'] = [$this->get('project')->niceSeoImg];
        }

        if ($this->isBlogCategoryPage() && !empty($this->get('active_category'))) {
            $options['title'] = $this->get('active_category')->niceSeoTitle;
            $options['description'] = $this->get('active_category')->niceSeoDescription;
            if (!empty($this->get('p_page')) && $this->get('p_page') > 1) {
                $options['title'] = $options['title'] . ' -'.$this->get('p_page');
                $options['description'] = $options['description'] . ' -'.$this->get('p_page');
            }
        }

        if ($this->isBlogPage() && !empty($this->get('post'))) {
            $options['title'] = $this->get('post')->niceSeoTitle;
            $options['description'] = $this->get('post')->niceSeoDescription;
            $options['og_images'] = [$this->get('post')->niceSeoImg];
        }

        if (!empty($this->get('layout_page'))) {
            if (empty($options['title']))
                $options['title'] = $this->get('layout_page')->seo_title;

            if (empty($options['description']))
                $options['description'] = $this->get('layout_page')->seo_description;
        }

        if (empty($options['og_images']))
            $options['og_images'] = ['/img/og2.jpg'];

        return $options;
    }

    public function printNiceSeo()
    {
        $options = $this->getSeoOptions();
        echo '<title>' . $options['title'] . '</title>';
        echo '<meta name="description" content="' . $options['description'] . '">';
        echo '<meta property="og:title" content="' . $options['title'] . '">';
        echo '<meta property="og:description" content="' . $options['description'] . '">';
        echo '<meta property="og:url" content="' . $options['url'] . '">';
        echo '<meta property="og:type" content="website" />';
        if (!empty($options['fb_app_id'])) {
            echo '<meta property="fb:app_id" content="' . $options['fb_app_id'] . '" />';
        }
        if (!empty($options['og_images'])) {
            foreach ($options['og_images'] as $og_image) {
                echo '<meta property="og:image" content="' . DOMAIN . $og_image . '">';
            }
        }

//        for pagination
        if ($this->isBlogCategoryPage()) {
            if (!empty($this->get('p_pages')) && !empty($this->get('p_page')) && !empty($this->get('p_href_pre'))) {
                if ($this->get('p_page') < $this->get('p_pages')) {
                    echo '<link rel="next" href="' . $this->getNiceUrl($this->get('p_href_pre') . '/page/') . ($this->get('p_page') + 1) . '"/>';
                }
                if ($this->get('p_page') > 1) {
                    if (($this->get('p_page') - 1) == 1) {
                        echo '<link rel="prev" href="' . $this->getNiceUrl($this->get('p_href_pre')) . '"/>';
                    } else {
                        echo '<link rel="prev" href="' .$this->getNiceUrl( $this->get('p_href_pre') . '/page/' . ($this->get('p_page') - 1)) . '"/>';
                    }
                }
            }
        }
    }

}