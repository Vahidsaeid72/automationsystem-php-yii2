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

<div class="alert alert-info text-center">
    <h5 class="text-primary">مشاهده اطلاعات نامه با شماره : <strong><?= $model->LettersNumber ?></strong></h5>
    <h5 class="text-primary">فرستنده نامه : <strong><?= $model->FullNameSender ?></strong></h5>
    <h5 class="text-primary">تاریخ ارسال : <strong><?= $model->SendLettersDate ?></strong></h5>
</div>
<div class="letters-form">

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => 0],

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

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade in active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersSubject')->textarea(['maxlength' => true, 'readonly' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersAbstract')->textarea(['maxlength' => true, 'readonly' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersTypeOfAction')->dropDownList(['' => 'نوع اقدام', 1 => 'عادی', 2 => 'فوری', 3 => 'آنی'], ['disabled' => 'disabled']) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersSecurity')->dropDownList(['' => 'محرمانگی', 1 => 'عادی', 2 => 'محرمانه', 3 => 'سری'], ['disabled' => 'disabled']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersFollowType')->dropDownList(['' => 'پیگیری', 1 => 'دارد', 2 => 'ندارد'], ['disabled' => 'disabled']) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'LettersResponseType')->dropDownList(['' => 'مهلت پاسخ', 1 => 'دارد', 2 => 'ندارد'], ['disabled' => 'disabled']) ?>
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
                                    'class'    => 'form-control',
                                    'disabled' => 'disabled'
                                ]
                            ]
                        );

                    ?>

                </div>

            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <?= $form->field($model, 'LettersText')->textarea(['rows' => 6, 'id' => 'ckeditor', 'readonly' => true])->label(false) ?>
        </div>

    </div>
    >


    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/ckeditor/ckeditor.js');


    $script = <<<JS
    
    
    CKEDITOR.replace("ckeditor");
    JS;
    $this->registerJs($script);
    ?>

</div>