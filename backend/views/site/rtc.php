<?php
?>

<?=\common\widgets\webrtc\RtcDialPopupWidget::widget([
    'wssServer' => 'pbx.lsat.vn',
    'webSocketPort' => '443',
    'serverPath' => '/ws',
    'profileName' => Yii::$app->user->identity->username,
    'sipDomain' =>'pbx.lsat.vn',
    'sipUsername' => "2902",
    'sipPassword' => "Cis@2902",
])?>

