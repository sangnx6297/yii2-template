
<?=\common\widgets\webrtc\RtcDialPopupWidget::widget([
    'wssServer' => Yii::$app->rtc->wssServer,
    'webSocketPort' => Yii::$app->rtc->webSocketPort,
    'serverPath' => Yii::$app->rtc->serverPath,
    'profileName' => Yii::$app->user->identity->username,
    'sipDomain' => Yii::$app->rtc->sipDomain,
//    'sipUsername' => Yii::$app->session->get(Yii::$app->user->id."_sip_username"),
//    'sipPassword' => Yii::$app->session->get(Yii::$app->user->id."_sip_secret"),
    'sipUsername' => Yii::$app->user->identity->extension,
    'sipPassword' => Yii::$app->user->identity->extension_secret,
])?>
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
    </div>
</footer>