<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VwUsersjobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vw-usersjob-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UsersJobID') ?>

    <?= $form->field($model, 'UsersJobStartDate') ?>

    <?= $form->field($model, 'UsersJobEndDate') ?>

    <?= $form->field($model, 'UsersJobStatus') ?>

    <?= $form->field($model, 'UsersID_FK') ?>

    <?php // echo $form->field($model, 'JobsID_FK') ?>

    <?php // echo $form->field($model, 'JobsID') ?>

    <?php // echo $form->field($model, 'JobsName') ?>

    <?php // echo $form->field($model, 'JobsDescription') ?>

    <?php // echo $form->field($model, 'JobsLevel') ?>

    <?php // echo $form->field($model, 'JobsParentID') ?>

    <?php // echo $form->field($model, 'JobsStatus') ?>

    <?php // echo $form->field($model, 'FullName') ?>

    <?php // echo $form->field($model, 'PersianJobsStatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
