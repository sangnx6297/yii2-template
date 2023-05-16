<?php

namespace lcssoft\report\models;

use yii\base\Model;

class ReportSession extends Model
{
    private $storage = [];

    public function getStorage($key)
    {
        if (!empty($this->storage)) {
            return isset($this->storage[$key]) ? $this->storage[$key] : null;
        }
        return null;
    }

    public function setStorage($key, $value)
    {
        $this->storage[$key] = $value;
    }

    public function removeStorage($key)
    {
        unset($this->storage[$key]);
    }

    public function flushAll()
    {
        $this->storage = [];
    }
}