<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.form-control {
    width: 100%;
}

.control-label {
    font-size: 12px;
}
</style>

<?php
$script = <<<JS
$("#users-form").on('pjax:beforeSend',function(){
    NProgress.start();
});
$("#users-form").on('pjax:success',function(){
    $.pjax.reload({container:"#users-index",async:false});
    $("#users-usersname").val(null);
    $("#users-usersfamily").val(null);
    $("#users-usersusername").val(null);
    $("#users-usersgender").val(null);
    $("#users-userspassword").val(null);
    $("#users-reapetedpassword").val(null);
    $("#users-usersactivity").val(null);
    $("#users-usersemail").val(null);
    $("#users-usersphone").val(null);
    $("#users-usersmobile").val(null);
    $("#users-userspicture").val(null);
    NProgress.done();
});
JS;
$this->registerJs($script);
?>
<div class="users-form">
    <?php Pjax::begin(['id' => 'users-form', 'timeout' => false]); ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => 0]]); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'UsersName')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'UsersFamily')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'UsersUserName')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'UsersGender')->dropDownList(['' => 'جنسیت', 1 => 'مرد', 0 => 'زن']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'UsersPassword')->passwordInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ReapetedPassword')->passwordInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'UsersActivity')->dropDownList(['' => 'وضعیت', 1 => 'فعال', 0 => 'غیر فعال']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'UsersEmail')->textInput(['maxlength' => true]) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'UsersPhone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'UsersMobile')->textInput(['maxlength' => true]) ?>
        </div>
        <!-- <div class="col-md-3 p-2">
            <?= $form->field($model, 'UsersPicture')->fileInput() ?>
        </div> -->
        <!-- <div class="col-md-3">
            <?= $form->field($model, 'UsersSignature')->textInput(['maxlength' => true]) ?>
        </div> -->

    </div>


    <div class="form-group">
        <?= Html::submitButton('ثبت نام', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>