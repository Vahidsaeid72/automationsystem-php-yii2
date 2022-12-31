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
$(document).off('click','#add_sig');
$('#frm-updating').on('beforeSubmit', function(e){
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
        $('#cl_close_Update').click();
        NProgress.done();
    }
 }).on('submit', function(e){
    $(document).off('submit','#letters-updating form[data-pjax]');
    e.preventDefault();
 })
})
    
JS;
$this->registerJs($script);
?>

<div class="letters-form">
    <?php Pjax::begin(['id' => 'letters-updating', 'timeout' => false, 'enablePushState' => false]); ?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => 0],
        'enableAjaxValidation' => true,
        'validationUrl' => ['letters/check-response-date'],
        'id' => 'frm-updating'
    ]); ?>

    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item active">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">جزئیات</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">متن نامه</a>
        </li>
        <br>
        <div class="form-group" align="left">
            <?= Html::submitButton('ویرایش پیش نویس', ['class' => 'btn btn-info btn-outline']) ?>
        </div>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-3"><?= $form->field($model, 'LettersSubject')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3"><?= $form->field($model, 'LettersAbstract')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersTypeOfAction')->dropDownList(['' => 'نوع اقدام', 1 => 'عادی', 2 => 'فوری', 3 => 'آنی']) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersSecurity')->dropDownList(['' => 'محرمانگی', 1 => 'عادی', 2 => 'محرمانه', 3 => 'سری']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersFollowType')->dropDownList(['' => 'پیگیری', 1 => 'دارد', 2 => 'ندارد']) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersResponseType')->dropDownList(['' => 'مهلت پاسخ', 1 => 'دارد', 2 => 'ندارد']) ?>
                </div>
                <div class="col-md-3">

                    <?php
                    echo $form->field(
                        $model,
                        'LettersResponseDate'
                    )
                        ->widget(
                            jalaliDatePicker::className(),
                            [
                                'options' => array(
                                    'format' => 'yyyy/mm/dd',
                                    'viewformat' => 'yyyy/mm/dd',
                                    'placement' => 'left',
                                    'todayBtn' => 'linked',
                                ),
                                'htmlOptions' => [
                                    'id' => 'letters-lettersresponsedate',
                                    'class'    => 'form-control'
                                ]
                            ]
                        );

                    ?>

                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <?= $form->field($model, 'LettersText')->textarea(['rows' => 6, 'id' => 'ckeditor'])->label(false) ?>
        </div>
        <button type="button" id="add_sig" class="btn btn-primary btn-outline ">افزودن امضا</button>
    </div>
    >


    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/ckeditor/ckeditor.js');


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