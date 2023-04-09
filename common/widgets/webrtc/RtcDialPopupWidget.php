<?php
namespace common\widgets\webrtc;


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
        $this->registerAssets();
        return $this->render('index');
    }

    public function registerAssets(){
        $asset = RtcDialPopupAsset::register($this->view);
        $this->view->registerJsVar("jsPath", "$asset->baseUrl/js/");
        $this->view->registerJsVar("accountWssServer", $this->wssServer);
        $this->view->registerJsVar("accountWebSocketPort", $this->webSocketPort);
        $this->view->registerJsVar("accountServerPath", $this->serverPath);
        $this->view->registerJsVar("accountProfileName", $this->profileName);
        $this->view->registerJsVar("accountSipDomain", $this->sipDomain);
        $this->view->registerJsVar("accountSipUsername", $this->sipUsername);
        $this->view->registerJsVar("accountSipPassword", $this->sipPassword);

        $this->view->registerJs("initSipAccount();");
    }
}
