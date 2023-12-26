<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class NicePaginationComponent extends Component
{
    /**
     * Default config
     *
     * @var array
     */
    protected $_defaultConfig = [
        'limit' => 6,
        'page' => 1,
    ];


    public function initialize(array $config)
    {

    }

    public function paginate($query, $set_name, $href_pre)
    {
        $page = $this->config('page');
        $limit = $this->config('limit');
        $start = ($limit*($page - 1));
//        debug($start); die;

        $pages = ceil($query->count() / $limit);

        $query->offset($start);
        $query->limit($limit);

//        debug($start);
//        debug($limit);
//        debug($query->toArray());
//        die;

        $controller = $this->_registry->getController();
        $controller->set($set_name, $query->toArray());
        $controller->set('p_page', $page);
        $controller->set('p_pages', $pages);
        $controller->set('p_href_pre', $href_pre);
    }
}