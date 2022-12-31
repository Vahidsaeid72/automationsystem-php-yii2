<?php

use faravaghi\jalaliDatePicker\jalaliDatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */
/* @var $form yii\widgets\ActiveForm */

$userSig =  Yii::$app->user->identity->UsersSignature;

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
JS;
$this->registerJs($script);
?>

<div class="letters-form">
    <?php Pjax::begin(['id' => 'rotation-description-form', 'timeout' => false]); ?>

    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => 0, 'enctype' => 'multipart/form-data'],
        'validationUrl' => ['letters/check-response-date']
    ]); ?>

    <div class="row">
        <?= $form->field($FindReferralLetter, 'ReferralLettersDescription')->textarea(['rows' => 6, 'id' => 'ckeditor', 'readonly' => true])->label(false) ?>
    </div>

</div>




<?php ActiveForm::end(); ?>
<?php
$this->registerJsFile(Yii::$app->request->baseUrl . '/web/ckeditor/ckeditor.js');

$script = <<<JS
    
    
    CKEDITOR.replace("ckeditor");


    JS;
$this->registerJs($script);
?>
<?php Pjax::end(); ?>
</div>