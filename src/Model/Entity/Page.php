<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;
use Cake\I18n\I18n;

class Page extends Entity
{
    protected $niceContentTemp = false;
    protected $defaultContentTemp = false;
    protected $contentTemp = false;
    protected function _getNiceContent()
    {
        if(!$this->niceContentTemp) {
            $this->niceContentTemp = unserialize($this->content);
        }
        return $this->niceContentTemp;
    }

    public function getContentField($field)
    {
        if(!$this->defaultContentTemp) {
            $this->defaultContentTemp = unserialize($this->content);
        }
        if(I18n::locale() == 'uk') {
            $temp = $this->defaultContentTemp;
            foreach ($field as $piece) {
                if(empty($temp[$piece])) {
                    $temp = '';
                    break;
                }
                $temp = $temp[$piece];
            }
            if(!strstr($temp, '<p>')) {
                $temp = nl2br($temp);
            }
            return $temp;
        }
//debug($this->_translations);die;
        if (!$this->contentTemp) {
            if (empty($this->_translations[I18n::locale()]->content)) {
                $this->contentTemp = $this->defaultContentTemp;
            } else {
                $this->contentTemp = unserialize($this->_translations[I18n::locale()]->content);
            }
        }
      //  debug($this->defaultContentTemp);
       // debug($this->contentTemp); die;

        $temp = $this->contentTemp;
        foreach ($field as $piece) {
            if(empty($temp[$piece])) {
                $temp = '';
                break;
            }
            $temp = $temp[$piece];
        }
        if(empty($temp)) {
            $temp = $this->defaultContentTemp;
            foreach ($field as $piece) {
                if(empty($temp[$piece])) {
                    $temp = '';
                    break;
                }
                $temp = $temp[$piece];
            }
        }
        if(!strstr($temp, '<p>')) {
            $temp = nl2br($temp);
        }
        return $temp;
    }
}
