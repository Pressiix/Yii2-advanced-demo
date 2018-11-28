<?php
namespace common\assets;

use yii\web\AssetBundle;

class ChartJsAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    /*public $css = [
        'css/style.css',
    ];*/
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}