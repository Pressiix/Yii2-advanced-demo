<?php
namespace common\assets;

use yii\web\AssetBundle;

class ChartJsDataLabelAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    /*public $css = [
        'css/style.css',
    ];*/
    public $js = [
        'https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.1.0'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}