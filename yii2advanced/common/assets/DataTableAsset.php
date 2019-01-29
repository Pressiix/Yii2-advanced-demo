<?php
namespace common\assets;

use yii\web\AssetBundle;

class DataTableAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $css = [
        'https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css'
    ];
    public $js = [
        'https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}