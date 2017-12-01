<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/src.css',
        '/main/assets/css/reset.css',
        '/main/assets/css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900',
    ];
    public $js = [
        '/js/common/src.js'
    ];
    public $depends = [
//        'yii\web\JqueryAsset' => false,
    ];
}
