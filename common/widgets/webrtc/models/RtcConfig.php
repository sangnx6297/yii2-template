<?php

namespace common\widgets\webrtc\models;

use yii\base\Component;

class RtcConfig extends Component
{
    public $wssServer;
    public $webSocketPort;
    public $serverPath;
    public $sipDomain;
}