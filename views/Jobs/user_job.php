<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\VwUsersjob */
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

$('#frm-user-job').on('beforeSubmit', function(e){
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
        $('#cl_close_user_job').click();
        NProgress.done();
    }
 }).on('submit', function(e){
    $(document).off('submit','#user-job form[data-pjax]');
    e.preventDefault();
 })
})
    
JS;
$this->registerJs($script);
?>

<div class="vw-usersjob-form">

    <?php Pjax::begin(['id' => 'user-job', 'timeout' => false, 'enablePushState' => false]); ?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => 0],
        // 'enableAjaxValidation' => true,
        // 'validationUrl' => ['jobs/check'],
        'id' => 'frm-user-job'
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'UsersID_FK')->dropDownList($Users, ['prompt' => 'انتخاب کاربر']) ?>
        </div>
    </div>


    <?= $form->field($model, 'JobsID_FK')->hiddenInput(['value' => $JobID])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-info btn-outline']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>