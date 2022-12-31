<?php

use faravaghi\jalaliDatePicker\jalaliDatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */
/* @var $form yii\widgets\ActiveForm */

$userSig =  Yii::$app->user->identity->UsersSignature;
$SignSrc = Yii::$app->request->baseUrl . '/web/users_picture/' . $userSig;
$sendRefrral = Yii::$app->getUrlManager()->createUrl('recieveletter/send-referral');
?>
<style>
.form-control {
    width: 100%;
}

.control-label {
    font-size: 12px;
}

.select {
    margin-top: 20px;
}
</style>

<?php
$script = <<<JS
$(document).off('click','#add_sig');
$('.selectpicker').selectpicker('refresh');
$('#frm-referral').on('beforeSubmit', function(e){
    NProgress.start();
    let form = $(this);
    let formData = form.serialize();
 
 $.ajax({
    url:form.attr('action'),
    type:form.attr('method'),
    data:formData,
    success: function(data){
        history.pushState(null,'','/automationsystem/recieveletter');
        $.pjax.reload({container:"#vw-recieveletter-index",async:false});

        $('#cl_close_referral').click();
        NProgress.done();
    }
 }).on('submit', function(e){
    $(document).off('submit','#referraling form[data-pjax]');
    e.preventDefault();
 })
})
    
JS;
$this->registerJs($script);
?>

<div class="letters-form">
    <?php Pjax::begin(['id' => 'referraling', 'timeout' => false, 'enablePushState' => false]); ?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => 0],
        'id' => 'frm-referral',
        'action' => $sendRefrral,
    ]); ?>

    <ul class="nav nav-tabs" id="myTab" role="tablist">


        <br>
        <div class="form-group" align="left">
            <?= Html::submitButton('ارسال ارجاع', ['class' => 'btn btn-info btn-outline']) ?>
        </div>
    </ul>
    <div class="row select">
        <div class="col-md-6 ">
            <?= $form->field($model, 'UsersID_Receiver')->dropDownList($Users, ['multiple' => 'multiple', 'class' => 'selectpicker', 'multiple data-live-search' => 'true', 'title' => 'گیرندگان ارجاع...'])->label('گیرندگان ارجاع') ?>
        </div>

        <?= $form->field($model, 'LettersID_FK')->hiddenInput(['value' => $LetterID])->label(false) ?>
        <?= $form->field($model, 'UsersID_Sender')->hiddenInput(['value' => $userId])->label(false) ?>

    </div>
    <div class="row">
        <?= $form->field($model, 'ReferralLettersDescription')->textarea(['rows' => 6, 'id' => 'ckeditor'])->label(false) ?>
    </div>


    <button type="button" id="add_sig" class="btn btn-primary btn-outline ">افزودن امضا</button>
</div>



<?php ActiveForm::end(); ?>
<?php
$this->registerJsFile(Yii::$app->request->baseUrl . '/web/ckeditor/ckeditor.js');
$this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/bootstrap-select.css');


$script = <<<JS
     $(document).off('submit','#answer-form form[data-pjax]');
       $(document).off('click','#add_sig');
    
    CKEDITOR.replace("ckeditor");
    $(document).on('click','#add_sig',function(){
        CKEDITOR.instances['ckeditor'].insertHtml('<img src="$SignSrc" style="width : 120px; height : 120px;">');
    })
    JS;
$this->registerJs($script);
?>
<?php Pjax::end(); ?>
</div>