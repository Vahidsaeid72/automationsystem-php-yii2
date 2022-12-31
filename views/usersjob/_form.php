<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VwUsersjob */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vw-usersjob-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UsersID_FK')->textInput() ?>

    <?= $form->field($model, 'JobsID_FK')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>