<?php

namespace App\Traits;

use App\Helpers\LanguagesHelper;

trait XmlTrait
{
    public function createXmlFile()
    {
        $str = '<?xml version="1.0" encoding="UTF-8"?>';
        $str .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $lastmod = '2019-01-04';
        $languages = LanguagesHelper::getLanguages();

        $i = 0;
        // статичні сторінки
        foreach ($languages as $key => $language) {
            $loc = ($language['type'] == 'other') ? $language['Locale'] : '';

            $arr[$i]['loc'] = DOMAIN . '/' . $loc;
            $arr[$i]['lastmod'] = $lastmod;
            $arr[$i]['priority'] = '1';
            $i++;

            $pages = ['/projects', '/gallery', '/objects', '/services', '/about_us', '/contacts'];
            foreach ($pages as $page) {
                $arr[$i]['loc'] = (!empty($loc)) ? DOMAIN . '/' . $loc . $page : DOMAIN . $page;
                $arr[$i]['lastmod'] = $lastmod;
                $arr[$i]['priority'] = '0.8';
                $i++;
            }
        }

        // категорії
        $this->loadModel('Categories');
        $categories = $this->Categories->find('all');
        foreach ( $categories as $category ) {
            foreach ($languages as $key => $language) {
                $loc = ($language['type'] == 'other') ? $language['Locale'] : '';
                $slug = 'slug_'.$language['Locale'];
                $enable = 'enable_'.$language['Locale'];
                if(!empty($category->$slug) && !empty($category->$enable)) {
                    $arr[$i]['loc'] = (!empty($loc)) ? DOMAIN.'/'.$loc.'/'.$category->$slug : DOMAIN.'/'.$category->$slug;
                    $arr[$i]['lastmod'] = $category->xmlCreated;
                    $arr[$i]['priority'] = '0.8';
                    $i++;
                }
            }
        }

        // проекти
        $this->loadModel('Projects');
        $projects = $this->Projects
            ->find('all')
            ->order(['modified' => 'DESC']);

        // продукти
        foreach ($projects as $project) {
            foreach ($languages as $key => $language) {
                $loc = ($language['type'] == 'other') ? $language['Locale'] : '';
                $arr[$i]['loc'] = (!empty($loc)) ? DOMAIN . '/' . $loc . $project->_getHref($language['Locale']) : DOMAIN . $project->_getHref($language['Locale']);
                $arr[$i]['lastmod'] = $project->xmlCreated;
                $arr[$i]['priority'] = '0.7';
                $i++;
            }
        }

        // блог
        $this->loadModel('PostsCategories');
        $posts_categories = $this->PostsCategories->getPublishedCategories();
        $posts_categories->contain('Posts');

        foreach ($posts_categories as $posts_category) {
            // категорії
            foreach ($languages as $key => $language) {
                $loc = ($language['type'] == 'other') ? $language['Locale'] : '';
                $r = 'slug_' . $language['Locale'];
                $arr[$i]['loc'] = (!empty($loc)) ? DOMAIN . '/' . $loc . '/blog/' . $posts_category->$r : DOMAIN . '/blog/' . $posts_category->$r;
                $arr[$i]['lastmod'] = $posts_category->xmlCreated;
                $arr[$i]['priority'] = '0.8';
                $i++;
            }
            // продукти
            foreach ($posts_category->posts as $post) {
                foreach ($languages as $key => $language) {
                    $loc = ($language['type'] == 'other') ? $language['Locale'] : '';
                    $r = 'slug_' . $language['Locale'];
                    $arr[$i]['loc'] = (!empty($loc)) ? DOMAIN . '/' . $loc . '/post/' . $post->$r : DOMAIN . '/post/' . $post->$r;
                    $arr[$i]['lastmod'] = $post->xmlCreated;
                    $arr[$i]['priority'] = '0.6';
                    $i++;
                }
            }
        }


        foreach ($arr as $item) {
            $str .= '<url>';
            $str .= '<loc>';
            $str .= $item['loc'];
            $str .= '</loc>';
            $str .= '<lastmod>';
            $str .= $item['lastmod'];
            $str .= '</lastmod>';
            $str .= '<priority>';
            $str .= $item['priority'];
            $str .= '</priority>';
            $str .= '</url>';
        }
        $str .= '</urlset>';
        file_put_contents(WWW_ROOT . 'sitemap.xml', $str);
    }
}