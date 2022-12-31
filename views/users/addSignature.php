<?php

use faravaghi\jalaliDatePicker\jalaliDatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */
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
history.pushState(null,'','/automationsystem/users');
$(document).off('submit','#add-signature-form form[data-pjax]');

$("#add-Signature-form").on('pjax:beforeSend',function(){
    NProgress.start();
});
$("#add-Signature-form").on('pjax:success',function(){

history.pushState(null,'','/automationsystem/users');
$.pjax.reload({container:"#users-index",async:false});

$('#cl_close_Signature').click();
    NProgress.done();

});
JS;
$this->registerJs($script);
?>

<div class="users-form">
    <?php Pjax::begin(['id' => 'add-Signature-form', 'timeout' => false]); ?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => 0, 'enctype' => 'multipart/form-data'],

    ]); ?>

    <br>

    <div class="row">
        <?= $form->field($model, 'imageFile')->fileInput() ?>
    </div>
    <div class="form-group" align="left">
        <?= Html::submitButton('اضافه کردن امضا', ['class' => 'btn btn-info btn-outline']) ?>
    </div>





    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/ckeditor/ckeditor.js');

    $script = <<<JS
$(document).off('submit','#add-signature-form form[data-pjax]');
JS;
    $this->registerJs($script);
    ?>
    <?php Pjax::end(); ?>
</div>