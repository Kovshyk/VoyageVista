<?php
namespace App\Model\Table;

use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Table;
use Cake\Utility\Text;

class AppTable extends Table {
	public function initialize(array $config)
    {
//		$this->addBehavior('Timestamp');
    }

	/**
	 * Before save callback.
	 * 
	 * @param $event
	 * @param $entity
	 * @param $options
	 */
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && $this->_schema->column('created') && empty($entity->created)) {
            $entity->created = time();
        }
        if ($this->_schema->column('modified')) {
            $entity->modified = time();
        }
    }
    public function afterSave($event, $entity, $options)
    {

    }


    public function toFlashMessage($errors = [])
    {
        if (!is_array($errors)) {
            throw new \RuntimeException('Errors data from model is not an array!');
        }

        $out = '';
        foreach ($errors as $field => $error) {
            if (is_array($error)) {
                foreach ($error as $er) {
                    $out .= "<b>$field</b>: " . $er . "<br/>\n \r";
                }
            }
        }

        return $out;
    }

    //        function of forming a field slug
    protected function formSlug($string)
    {
        $regex = '^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}';
        $quotedReplacement = preg_quote('-', '/');
        $map = [
            '/[' . $regex . ']/mu' => ' ',
            '/[\s]+/mu' => '-',
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        ];
//      preg_replace - using regular expressions cut out all invalid characters like%, *, + ,;
//      also replace all spaces with -

//      mb_strtolower - string to the lowercase
        $string = Text::slug(mb_strtolower(preg_replace(array_keys($map), $map, $string)));
        return $string;
    }

}