<?php


namespace Models;

use Phalcon\Mvc\Model;


class ModelBase extends Model
{
    protected $FILE_DIR;

    public function saveIn($where = '') {
        $methodName = 'saveIn'.ucfirst($where);
        if(method_exists($this, $methodName))
            return $this->$methodName();
        return null;
    }

    public function saveInFile() {
        if (!is_dir($this->FILE_DIR))
            mkdir($this->FILE_DIR);

        return file_put_contents($this->FILE_DIR . 'output.txt', $this, FILE_APPEND);
    }

    public function saveInDb() {
        return $this->save();
    }
}