<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'UsersID') ?>

    <?= $form->field($model, 'UsersName') ?>

    <?= $form->field($model, 'UsersFamily') ?>

    <?= $form->field($model, 'UsersUserName') ?>

    <?= $form->field($model, 'UsersPassword') ?>

    <?php // echo $form->field($model, 'UsersGender') ?>

    <?php // echo $form->field($model, 'UsersActivity') ?>

    <?php // echo $form->field($model, 'UsersEmail') ?>

    <?php // echo $form->field($model, 'UsersPhone') ?>

    <?php // echo $form->field($model, 'UsersMobile') ?>

    <?php // echo $form->field($model, 'UsersPicture') ?>

    <?php // echo $form->field($model, 'UsersSignature') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
