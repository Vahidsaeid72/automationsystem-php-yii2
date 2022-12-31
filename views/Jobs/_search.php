<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JobsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jobs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'JobsID') ?>

    <?= $form->field($model, 'JobsName') ?>

    <?= $form->field($model, 'JobsDescription') ?>

    <?= $form->field($model, 'JobsLevel') ?>

    <?= $form->field($model, 'JobsParentID') ?>

    <?php // echo $form->field($model, 'JobsStatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
