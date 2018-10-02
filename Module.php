<?php

namespace novatorgroup\statsource;

class Module extends \yii\base\Module
{
    /**
     * @var array - sources config
     */
    public $sources = [];

    /**
     * @var string - username for HttpBasicAuth
     */
    public $username;

    /**
     * @var string - password for HttpBasicAuth
     */
    public $password;

    public function init()
    {
        parent::init();

        $this->controllerMap = [
            'load' => LoadController::class
        ];
    }
}