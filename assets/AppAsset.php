<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/css/bootstrap-rtl.min.css',
        'web/css/site.css',
        'web/css/admin.css',
        'web/css/font-awesome.min.css',
        'web/css/font-awesome-rtl.css',
        'web/css/nprogress.css',
        'web/css/my-style.css'


    ];
    public $js = [

        'web/js/main.js',
        'web/js/bootstrap-select.js',
        'web/js/dropzone.js',
        'web/js/jquery.mask.js',
        'web/js/nprogress.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];
}