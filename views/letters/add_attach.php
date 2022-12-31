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
history.pushState(null,'','/automationsystem/letters');
$(document).off('submit','#add-attach-form form[data-pjax]');

$("#add-attach-form").on('pjax:beforeSend',function(){
    NProgress.start();
});
$("#add-attach-form").on('pjax:success',function(){

history.pushState(null,'','/automationsystem/letters');
$.pjax.reload({container:"#letters-index",async:false});

$('#cl_close_Attach').click();
    NProgress.done();

});
JS;
$this->registerJs($script);
?>

<div class="letters-form">
    <?php Pjax::begin(['id' => 'add-attach-form', 'timeout' => false]); ?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => 0, 'enctype' => 'multipart/form-data'],

    ]); ?>

    <br>

    <div class="row">
        <?= $form->field($model, 'imageFile')->fileInput() ?>
    </div>
    <div class="form-group" align="left">
        <?= Html::submitButton('اضافه کردن', ['class' => 'btn btn-info btn-outline']) ?>
    </div>





    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/ckeditor/ckeditor.js');

    $script = <<<JS
    $(document).off('submit','#add-attach-form form[data-pjax]');
JS;
    $this->registerJs($script);
    ?>
    <?php Pjax::end(); ?>
</div>