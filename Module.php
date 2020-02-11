<?php

namespace evolun\post;

use yii;

/**
 * A posztok modulja
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'evolun\post\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (!Yii::$app->user->identity instanceof \evolun\user\models\User) {
            throw new \yii\base\InvalidConfigException('You have to install \'evolun-user\' to use this module');
        }
    }
}
