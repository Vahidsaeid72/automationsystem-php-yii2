<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Jobs */
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

$('#frm-jobs').on('beforeSubmit', function(e){
    NProgress.start();
 let form = $(this);
 let formData = form.serialize();
 
 $.ajax({
    url:form.attr('action'),
    type:form.attr('method'),
    data:formData,
    success: function(data){
        history.pushState(null,'','/automationsystem/jobs')
        $.pjax.reload({container:"#jobs-index",async:false});
        $('#cl_close_edit-job').click();
        NProgress.done();
    }
 }).on('submit', function(e){
    $(document).off('submit','#jobs-updating form[data-pjax]');
    e.preventDefault();
 })
})
    
JS;
$this->registerJs($script);
?>

<div class="jobs-form">
    <?php Pjax::begin(['id' => 'jobs-updating', 'timeout' => false, 'enablePushState' => false]); ?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => 0],
        // 'enableAjaxValidation' => true,
        // 'validationUrl' => ['jobs/check'],
        'id' => 'frm-jobs'
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'JobsName')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'JobsDescription')->textarea(['maxlength' => true]) ?>
        </div>
    </div>


    <!-- <?= $form->field($model, 'JobsStatus')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('ثبت تغییرات', ['class' => 'btn btn-info btn-outline']) ?>
    </div>


    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
    <?php
    $script = <<<JS
    
    history.pushState(null,'','/automationsystem/jobs')
    $(document).off('submit','#jobs-updating form[data-pjax]')
    JS;
    $this->registerJs($script);
    ?>
</div>