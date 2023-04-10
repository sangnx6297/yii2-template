<?php
namespace common\widgets\webrtc;


use common\widgets\webrtc\models\Ultilities;
use yii\web\View;

class RtcDialPopupWidget extends \yii\base\Widget
{

    public $wssServer;
    public $webSocketPort;
    public $serverPath;
    public $profileName;
    public $sipDomain;
    public $sipUsername;
    public $sipPassword;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        list($widgetAssetUrl, $bowerAssetDir, $bowerAssetUrl) = $this->registerAssets();
        return $this->render('index', ['bowerAssetUrl' => $bowerAssetUrl]);
    }

    public function registerAssets(){
        $asset = RtcDialPopupAsset::register($this->view);
        $assetDir = \Yii::$app->assetManager->getPublishedPath(__DIR__.'/dist');
        $assetUrl = \Yii::$app->assetManager->getPublishedUrl(__DIR__.'/dist');

        if(!is_dir($assetDir)){
            mkdir($assetDir, 0755,true);
            Ultilities::recursiveDirectoryCopy(__DIR__ . "/dist", $assetDir);
        }

        $this->view->registerJsVar("jsPath", "$asset->baseUrl/js/");
        $this->view->registerJsVar("accountWssServer", $this->wssServer);
        $this->view->registerJsVar("accountWebSocketPort", $this->webSocketPort);
        $this->view->registerJsVar("accountServerPath", $this->serverPath);
        $this->view->registerJsVar("accountProfileName", $this->profileName);
        $this->view->registerJsVar("accountSipDomain", $this->sipDomain);
        $this->view->registerJsVar("accountSipUsername", $this->sipUsername);
        $this->view->registerJsVar("accountSipPassword", $this->sipPassword);
        $this->view->registerJsVar("bowerDist", $assetUrl);

        $this->view->registerMetaTag(['rel' => "apple-touch-icon", "href" => "$assetUrl/icons/512.png"]);
        $this->view->registerMetaTag(['rel' => "manifest", "href" => "$assetUrl/manifest.json"]);

//        <!-- Cache -->
        $this->view->registerMetaTag(['http-equiv' => "Pragma", "content" => "no-cache"]);
        $this->view->registerMetaTag(['http-equiv' => "Cache-Control", "content" => "no-cache, no-store, must-revalidate"]);
        $this->view->registerMetaTag(['http-equiv' => "Expires", "content" => "0"]);


        $this->view->registerMetaTag(['name' => "HandheldFriendly", "content" => "true"]);
        $this->view->registerMetaTag(['name' => "format-detection", "content" => "telephone=no"]);
        $this->view->registerMetaTag(['name' => "theme-color", "media" => "(prefers-color-scheme: light)"]);
        $this->view->registerMetaTag(['name' => "mobile-web-app-capable", "content" => "yes"]);
        $this->view->registerMetaTag(['name' => "apple-mobile-web-app-capable", "content" => "yes"]);

        $this->view->registerJs("initSipAccount();");


        return [
            $asset->baseUrl,
            $assetDir,
            $assetUrl
        ];
    }
}
