<?php
namespace common\assets;

use yii\web\AssetBundle;

class FullCalendarAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $css = [
        'https://fullcalendar.io/js/fullcalendar-3.9.0/fullcalendar.css',
    ];
    public $js = [
        'https://fullcalendar.io/js/fullcalendar-3.9.0/lib/moment.min.js',
        'https://fullcalendar.io/js/fullcalendar-3.9.0/fullcalendar.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}