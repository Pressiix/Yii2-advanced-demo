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
        'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js',
        'https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js',
        'https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js',
        'https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}