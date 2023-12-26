<?php

namespace App\View\Traits;

trait LangTrait
{
    public $lang;

    public $languages = [
        'uk' => ['name' => 'Українська', 'name_short' => 'UKR', 'class' => '', 'href' => ''],
        'ru' => ['name' => 'Русский', 'name_short' => 'RU', 'class' => '', 'href' => '/ru'],
        'en' => ['name' => 'English', 'name_short' => 'EN', 'class' => '', 'href' => '/en'],
        'de' => ['name' => 'Deutsch', 'name_short' => 'DE', 'class' => '', 'href' => '/de'],
        'pl' => ['name' => 'Polish', 'name_short' => 'PL', 'class' => '', 'href' => '/pl'],
    ];

    public function initLang()
    {
        $this->lang = (!empty($this->get('lang'))) ? $this->get('lang') : 'uk';
    }


    public function getNiceUrl($url)
    {
        $url = ($url === '/') ? '' : $url;
        $url = $this->languages[$this->lang]['href'] . $url;
        return (empty($url)) ? '/' : $url;
    }

    public function getRequestTarget()
    {
        $request = $this->request->here;
        if ($request == '/')
            return '';
        $lng_i = substr($request, 0, 3);
        if (in_array($lng_i, ['/ru', '/en', '/de', '/pl'])) {
            $request = substr($request, 3, strlen($request) - 3);
        }
        return $request;
    }


    public function getLanguageHref($lang)
    {
        $url = $this->getNotDefaultUrl($lang);
        if($url) {
            return $this->languages[$lang]['href'] . $url;
        }
        $request = $this->getRequestTarget();
        $url = $this->languages[$lang]['href'] . $request;
        return (empty($url)) ? '/' : $url;
    }


    public function getNotDefaultUrl($lang)
    {
        if($this->isBlogCategoryPage() && !empty($this->get('active_category'))) {
            if(empty($this->get('p_page')) || $this->get('p_page') == 1) {
                return $this->get('active_category')->_getHref($lang);
            } else {
                return $this->get('active_category')->_getHref($lang).'/page/'.$this->get('p_page');
            }
        }
        if($this->isCategoryPage() && !empty($this->get('active_category'))) {
            $active_category = $this->get('active_category');
            $slug = 'slug_'.$lang;
            $enable = 'enable_'.$lang;
            if(!empty($active_category->$slug) && !empty($active_category->$enable)) {
                return '/'.$active_category->$slug;
            } else {
                return '/projects';
            }
        }
        if ($this->isBlogPage() && !empty($this->get('post'))) {
            return $this->get('post')->_getHref($lang);
        }
        if ($this->isProjectPage() && !empty($this->get('project'))) {
            return $this->get('project')->_getHref($lang);
        }
        return false;
    }
}