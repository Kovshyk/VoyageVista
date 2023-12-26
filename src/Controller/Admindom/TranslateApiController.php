<?php

namespace App\Controller\Admindom;
use App\Helpers\GoogleTranslateHelper;

class TranslateApiController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function translateTest()
    {
        $x = GoogleTranslateHelper::translate('uk', 'en', 'тато');
        debug($x); die;

    }

    public function translate()
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (isset($data['lang_from'], $data['lang_to'], $data['text']) ) {
                $this->response->body(json_encode([
                    'error' => false,
                    'text' => GoogleTranslateHelper::translate($data['lang_from'], $data['lang_to'], $data['text'])
                ]));
                $this->response->statusCode(200);
                return $this->response;
            }
        }
        $this->response->body(json_encode(['error' => true]));
        $this->response->statusCode(500);
        return $this->response;
    }
}