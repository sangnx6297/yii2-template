
<?=\common\widgets\webrtc\RtcDialPopupWidget::widget([
    'wssServer' => 'pbx.lsat.vn',
    'webSocketPort' => '443',
    'serverPath' => '/ws',
    'profileName' => Yii::$app->user->identity->username,
    'sipDomain' =>'pbx.lsat.vn',
    'sipUsername' => "2902",
    'sipPassword' => "Cis@2902",
])?>
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
    </div>
</footer>