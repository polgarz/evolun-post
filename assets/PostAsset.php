<?php
namespace evolun\post\assets;

use yii\web\AssetBundle;

class PostAsset extends AssetBundle
{
    public $sourcePath = '@vendor/polgarz/evolun-post/assets/js/';

    public $js = [
        'post.js'
    ];
    public $depends = [
        '\evolun\post\assets\SummernoteAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
