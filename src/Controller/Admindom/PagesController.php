<?php

namespace App\Controller\Admindom;
use Cake\ORM\TableRegistry;
use App\Helpers\LanguagesHelper;

class PagesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function page($type)
    {
        $pages_names = [
            'layout' => 'Шаблон',
            'home' => 'Головна',
            'projects' => 'Тури',
            'gallery' => 'Галерея',
            'about_us' => 'Про нас',
            'contacts' => 'Контакти',
            'thanks' => 'Сторінка подяки',
            '404' => 'Сторінка 404',
        ];

        if (array_key_exists($type, $pages_names)) {
            $this->set('page_name', $pages_names[$type]);
        }
        $page = $this->Pages->find('translations')
            ->where(['Pages.name' => $type])
            ->first();

        $languages = LanguagesHelper::getLanguages();
        $this->set('languages', $languages);

        $page_content = [];
        if (!empty($page->content)) {
            foreach ($languages as $language) {
                if($language['type'] == 'main') {
                    $page_content[$language['Locale']] = unserialize($page->content);

                } else {
                    if (!empty($page->_translations[$language['Locale']]->content)) {
                        $page_content[$language['Locale']] = unserialize($page->_translations[$language['Locale']]->content);
                    }
                }
            }
            $this->set('page_content', $page_content);
        }
//        debug($page_content['uk']->about->left->title); die;
//        debug($page_content); die;
//
        $this->set('page', $page);
        $this->set('page_type', $type);
    }

    public function change()
    {
        $this->Pages->change($this->request->data);
        $this->Flash->success('Збережено');
        return $this->redirect($this->referer());
    }


}