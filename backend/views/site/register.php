<?php
/** @var yii\web\View $this */
/** @var ActiveForm $form */

/** @var \frontend\models\SignupForm $model */

use  yii\bootstrap4\ActiveForm;
use yii\bootstrap\Html;

$inputTemplate = '{beginLabel}{labelTitle}{endLabel}
<div class="input-group">
{input}
{prepend}
</div>
                   {error}{hint}';
?>

<div class="register-box">
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new account</p>

            <?php $form = ActiveForm::begin(['id' => 'form-signup',]); ?>

            <div class="form-group">
                <?= $form->field($model, 'username', [
                    'template' => Yii::t('backend', $inputTemplate, [
                        'prepend' => '<div class="input-group-text"><span class="fas fa-user"></span></div>'
                    ])
                ])->textInput(['autofocus' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'email', [
                    'template' => Yii::t('backend', $inputTemplate, [
                        'prepend' => '<div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>'
                    ])
                ]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'password', [
                    'template' => Yii::t('backend', $inputTemplate, [
                        'prepend' => '<div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                    <!-- <div id="extwaiokist" style="display:none" v="efmeb" q="719056a5" c="602.5" i="609" u="0.658"
                         s="03292321" sg="svr_03162317-ga_03292321-bai_03282317" d="1" w="false" e="" a="2" m="BMe="
                         vn="9axur">
                        <div id="extwaigglbit" style="display:none" v="efmeb" q="719056a5" c="602.5" i="609" u="0.658"
                             s="03292321" sg="svr_03162317-ga_03292321-bai_03282317" d="1" w="false" e="" a="2"
                             m="BMe="></div>
                    </div> --> '
                    ]),
                ])->passwordInput() ?>
            </div>

            <div class="form-group">
                <?= $form->field($model, 'retypePassword', [
                    'template' => Yii::t('backend', $inputTemplate, [
                        'prepend' => '<div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>'
                    ])
                ])->passwordInput() ?>
            </div>


            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                            I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>

<!--                <div class="form-group">-->
                    <div class="col-4">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
                    </div>
<!--                </div>-->
            </div>
            <?php ActiveForm::end(); ?>
<!---->
<!--            <div class="social-auth-links text-center">-->
<!--                <p>- OR -</p>-->
<!--                <a href="#" class="btn btn-block btn-primary">-->
<!--                    <i class="fab fa-facebook mr-2"></i>-->
<!--                    Sign up using Facebook-->
<!--                </a>-->
<!--                <a href="#" class="btn btn-block btn-danger">-->
<!--                    <i class="fab fa-google-plus mr-2"></i>-->
<!--                    Sign up using Google+-->
<!--                </a>-->
<!--            </div>-->
            <a href="/site/login" class="text-center">I already have an account</a>
        </div>

    </div>
</div>
