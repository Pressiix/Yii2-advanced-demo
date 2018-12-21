<?php
/**
 * AssetBundle.php
 * @author Revin Roman
 * @link https://rmrevin.ru
 */

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Class AssetBundle
 * @package rmrevin\yii\fontawesome
 */
class FontawesomeAsset extends AssetBundle
{

    /**
     * @inherit
     */
    public $sourcePath = '@vendor/bower-asset/fontawesome';

    /**
     * @inherit
     */
    public $css = [
        'css/fontawesome.min.css',
    ];

    /**
     * Initializes the bundle.
     * Set publish options to copy only necessary files (in this case css and font folders)
     * @codeCoverageIgnore
     */
    public $publishOptions = [
        'only' => [
            'fonts/',
            'css/',
        ]
    ];
}