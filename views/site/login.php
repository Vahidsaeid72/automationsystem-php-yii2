<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'ورود به بخش کاربری';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
html,
body {
    position: relative;
    height: 100%;
}

.col-sm-6 {
    width: 100% !important;
}

.login-container {
    position: relative;
    width: 300px;
    margin: 80px auto;
    padding: 20px 40px 40px;
    text-align: center;
    background: #fff;
    border: 1px solid #ccc;
}

#output {
    position: absolute;
    width: 300px;
    top: -75px;
    left: 0;
    color: #fff;
}

#output.alert-success {
    background: rgb(25, 204, 25);
}

#output.alert-danger {
    background: rgb(228, 105, 105);
}


.login-container::before,
.login-container::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    top: 3.5px;
    left: 0;
    background: #fff;
    z-index: -1;
    -webkit-transform: rotateZ(4deg);
    -moz-transform: rotateZ(4deg);
    -ms-transform: rotateZ(4deg);
    border: 1px solid #ccc;

}

.login-container::after {
    top: 5px;
    z-index: -2;
    -webkit-transform: rotateZ(-2deg);
    -moz-transform: rotateZ(-2deg);
    -ms-transform: rotateZ(-2deg);

}

.avatar {
    width: 100px;
    height: 100px;
    margin: 10px auto 30px;
    border-radius: 100%;
    border: 2px solid #aaa;
    background-size: cover;
    /*            background-image: url("*/
    <?php //echo Yii::$app->request->baseUrl.'/web/images/Home.png' 
    ?>
    /*") ;*/
}

.form-box input {
    width: 100%;
    padding: 10px;
    text-align: center;
    height: 40px;
    border: 1px solid #ccc;
    ;
    background: #fafafa;
    transition: 0.2s ease-in-out;

}

.form-box input:focus {
    outline: 0;
    background: #eee;
}

.form-box input[type="text"] {
    border-radius: 5px 5px 0 0;
    text-transform: lowercase;
}

.form-box input[type="password"] {
    border-radius: 0 0 5px 5px;
    border-top: 0;
}

.form-box button.login {
    margin-top: 15px;
    padding: 10px 20px;
}

.animated {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}

@-webkit-keyframes fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translateY(20px);
        transform: translateY(20px);
    }

    100% {
        opacity: 1;
        -webkit-transform: translateY(0);
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translateY(20px);
        -ms-transform: translateY(20px);
        transform: translateY(20px);
    }

    100% {
        opacity: 1;
        -webkit-transform: translateY(0);
        -ms-transform: translateY(0);
        transform: translateY(0);
    }
}

.fadeInUp {
    -webkit-animation-name: fadeInUp;
    animation-name: fadeInUp;
}
</style>

<?php
\yii\bootstrap\NavBar::begin([
    'brandLabel' => 'سیستم اتوماسیون اداری',

    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
        'style' => 'background-color:black'

    ],
]);
\yii\bootstrap\NavBar::end();
?>
<?php \yii\widgets\Pjax::begin(['id' => 'locations-form', 'timeout' => false]) ?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['data-pjax' => 0]
]); ?>

<div class="container">
    <div class="login-container">
        <div id="output"></div>
        <div class="avatar"></div>
        <div class="form-box">
            <div class="row" style="margin-left: 15px">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => '']) ?>
            </div>

            <div class="row" style="margin-left: 15px">
                <?= $form->field($model, 'password')->passwordInput(['class' => '']) ?>

            </div>

            <div class="row">
                <?= $form->field($model, 'rememberMe')->hiddenInput([
                    'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>", 'style' => 'opacity:0,margin-left: 15px'
                ])->label(false) ?>
            </div>

            <div class="row">
                <?= Html::submitButton('ورود', ['class' => 'btn btn-success btn-outline', 'name' => 'login-button']) ?>

            </div>

        </div>
    </div>

</div>







<?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end() ?>

<?php
$script = <<<JS

JS;
$this->registerJs($script);