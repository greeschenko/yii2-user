<?php

namespace greeschenko\user\assets;

use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $sourcePath = '@greeschenko/user/web';
    public $css = [
        'css/user.sass',
    ];
    public $js = [
        'js/user.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
