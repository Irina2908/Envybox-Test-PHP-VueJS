<?php


namespace Modules\Feedback\Models;

use Phalcon\Mvc\Model;

use Models\ModelBase;


class Message extends ModelBase
{
    public $id;
    public $name;
    public $phone;
    public $text;

    public function initialize()
    {
        $config = \Phalcon\DI::getDefault()->get('config');
        $this->FILE_DIR = $config->storage->file->feedback;
    }

    public function __toString()
    {
        $result = '';
        foreach (['name', 'phone', 'text'] as $propName)
        {
            $name = $propName;
            $val = ($propName === 'phone') 
                ? $this->getPhoneFormatted() 
                : $this->$propName;
            $result .= "${name}: ${val}\n";
        }
        return $result . "\n";
    }
    
    function getPhoneFormatted()
    {
        $phonePattern = "/\(?(\d{3})\)?\s?(\d{3})\-?(\d{2})\-?(\d{2})$/";

        if (!preg_match($phonePattern, $this->phone, $phoneParts))
            return $this->phone;

        return '+7 ' . '(' . $phoneParts[1] . ')' . ' ' . $phoneParts[2] . '-' . $phoneParts[3] . '-' . $phoneParts[4];
    }
}