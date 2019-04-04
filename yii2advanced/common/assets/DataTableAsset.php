<?php
namespace common\assets;

use yii\web\AssetBundle;

class DataTableAsset extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $css = [
        'https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css',
        'https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css'

    ];
    public $js = [
        'https://code.jquery.com/jquery-3.3.1.js',
        'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js',
        'https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js',
        'https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',
        'https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js',
        'https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js',
        'https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js'


    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}