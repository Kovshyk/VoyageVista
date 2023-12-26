<?php

namespace App\Controller\Admindom;


class FormsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Forms');
    }

    public function index()
    {
        $forms = $this->Forms->find('all')->order(['created' => 'DESC']);
        $orders_set = [];
        foreach ($forms as $order) {
            if(!$order->viewed){
                $order->viewed = 1;
                $this->Forms->save($order);
                $order->viewed = 0;
                $orders_set[] = $order;
            } else {
                $orders_set[] = $order;
            }
        }
        $this->set('orders', $orders_set);
    }

    public function remove($id)
    {
        $form = $this->Forms->get($id);
        $this->Forms->delete($form);
        $this->redirect($this->referer());
    }

}