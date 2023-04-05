<?php

namespace app\components;

use Yii;

class MyApplication extends \yii\web\Application
{
    public $language = 'en-US';

    public function init()
    {
        parent::init();

        // Set the language based on the user's preference, if available
        if (isset(Yii::$app->user->identity->language)) {
            $this->language = Yii::$app->user->identity->language;
        }

       // Check if the language specific view path exists, if not, fallback to default view path
        if (is_dir(Yii::getAlias('@app/views/' . $this->language))) {
            $this->viewPath = '@app/views/' . $this->language;
        } else {
            $this->viewPath = '@app/views';
        }
    }
}
