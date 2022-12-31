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
$('.selectpicker').selectpicker('refresh');

$('#frm-send-users').on('beforeSubmit', function(e){
    NProgress.start();
 let form = $(this);
 let formData = form.serialize();
 
 $.ajax({
    url:form.attr('action'),
    type:form.attr('method'),
    data:formData,
    success: function(data){
        history.pushState(null,'','/automationsystem/letters');
        $.pjax.reload({container:"#letters-index",async:false});
        $('#cl_close_sending').click();
        swal("موفقیت", "نامه با موفقیت ارسال شد!", "success");
        NProgress.done();
    }
 }).on('submit', function(e){
    $(document).off('submit','#users-form form[data-pjax]');
    e.preventDefault();
 })
})
JS;
$this->registerJs($script);
?>

<div class="letters-form">
    <?php Pjax::begin(['id' => 'users-form', 'timeout' => false]); ?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => 0],
        'action' => ['letters/send-for-users'],
        'id' => 'frm-send-users'

    ]); ?>

    <br>

    <div class="row">
        <?= $form->field($model, 'UsersID_FK')->dropDownList($Users, ['multiple' => 'multiple', 'class' => 'selectpicker', 'multiple data-live-search' => 'true', 'title' => 'گیرندگان...'])->label('گیرندگان') ?>


        <?= $form->field($model, 'LettersID_FK')->hiddenInput(['value' => $LetterID])->label(false) ?>
    </div>
    <div class="form-group" align="left">
        <?= Html::submitButton('ارسال', ['class' => 'btn btn-info btn-outline']) ?>
    </div>





    <?php ActiveForm::end(); ?>
    <?php
    $this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/bootstrap-select.css');

    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/ckeditor/ckeditor.js');

    $script = <<<JS
JS;
    $this->registerJs($script);
    ?>
    <?php Pjax::end(); ?>
</div>