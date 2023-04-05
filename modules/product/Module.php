<?php

namespace app\modules\product;


use yii\base\Module as BaseModule;


/**
 * product module definition class
 */
class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\product\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Set up the module with the configuration options
        $this->modules = [
            'v1' => [
                'class' => 'app\modules\product\modules\v1\Module',
            ],
        ];

         // Set the default controller
         $this->defaultRoute = 'default';
    }
}
