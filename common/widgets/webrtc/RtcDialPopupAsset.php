<?php
namespace common\widgets\webrtc;

use hail812\adminlte3\assets\FontAwesomeAsset;
use yii\bootstrap4\BootstrapWidgetTrait;
use yii\debug\DebugAsset;

class RtcDialPopupAsset extends \yii\web\AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@common/widgets/webrtc/assets';

    /**
     * @inheritdoc
     */
    public $css = [
        'css/normalize-v8.0.1.css',
        'css/roboto.css',
        'css/font-awesome.min.css',
//        'css/jquery-ui-1.13.2.min.css',
        'css/jquery-ui-1.13.0.css',
//        'css/phone.css',
        'css/miniphone.css',
        'css/phone.dark.css',
        'css/phone.light.css',
        'css/2tsd397wLxj96qwHyNIkxPesZW2xOQ-xsNqO47m55DA.woff2',
        'css/CWB0XYA8bzo0kSThX0UTuA.woff2',
        'css/d-6IYplOFocCacKzxwXSOFtXRa8TVwTICgirnJhmVJw.woff2',
        'css/CWB0XYA8bzo0kSThX0UTuA.woff2',
        'css/RxZJdnzeo3R5zSexge8UUVtXRa8TVwTICgirnJhmVJw.woff2',
        'css/fontawesome-webfont.woff2',
        'css/croppie.css',
        'css/toolbar.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
//        'js/jquery-3.6.1.min.js',
        'js/jquery-ui-1.13.0.js',
        'js/croppie.min.js',
//        'js/phone.js',
        'js/miniphone.js',
        'js/events.js',
        'js/jquery.md5-min.js',
        'js/Chart.bundle-2.7.2.min.js',
        'js/sip-0.21.2.min.js',
        'js/fabric-2.4.6.min.js',
        'js/moment-with-locales-2.24.0.min.js',
        'js/strophe-1.4.1.umd.min.js',
        'js/script.js',
        'js/sw.js',
        'js/toolbar.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}