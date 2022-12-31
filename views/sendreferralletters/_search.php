<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SendReferrallettersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vw-referralletters-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ReferralLettersID') ?>

    <?= $form->field($model, 'ReferralLettersDate') ?>

    <?= $form->field($model, 'ReferralLettersDescription') ?>

    <?= $form->field($model, 'LettersID_FK') ?>

    <?= $form->field($model, 'UsersID_Sender') ?>

    <?php // echo $form->field($model, 'UsersID_Receiver') ?>

    <?php // echo $form->field($model, 'ReferralLettersReadType') ?>

    <?php // echo $form->field($model, 'LettersID') ?>

    <?php // echo $form->field($model, 'LettersSubject') ?>

    <?php // echo $form->field($model, 'LettersText') ?>

    <?php // echo $form->field($model, 'LettersAbstract') ?>

    <?php // echo $form->field($model, 'LettersCreateDate') ?>

    <?php // echo $form->field($model, 'LettersNumber') ?>

    <?php // echo $form->field($model, 'LettersDraftType') ?>

    <?php // echo $form->field($model, 'LettersType') ?>

    <?php // echo $form->field($model, 'LettersTypeOfAction') ?>

    <?php // echo $form->field($model, 'LettersSecurity') ?>

    <?php // echo $form->field($model, 'LettersFollowType') ?>

    <?php // echo $form->field($model, 'LettersResponseType') ?>

    <?php // echo $form->field($model, 'LettersResponseDate') ?>

    <?php // echo $form->field($model, 'LettersResponseID') ?>

    <?php // echo $form->field($model, 'LettersAttachmentType') ?>

    <?php // echo $form->field($model, 'LettersAttachmentUrl') ?>

    <?php // echo $form->field($model, 'LettersAttachmentFileName') ?>

    <?php // echo $form->field($model, 'LettersArchiveType') ?>

    <?php // echo $form->field($model, 'UsersID_FK') ?>

    <?php // echo $form->field($model, 'FullNameSender') ?>

    <?php // echo $form->field($model, 'FullNameReceiver') ?>

    <?php // echo $form->field($model, 'FullCreator') ?>

    <?php // echo $form->field($model, 'PersianLettersTypeOfAction') ?>

    <?php // echo $form->field($model, 'PersianLettersSecurity') ?>

    <?php // echo $form->field($model, 'PersianLettersArchiveType') ?>

    <?php // echo $form->field($model, 'PersianLettersFollowType') ?>

    <?php // echo $form->field($model, 'PersianLettersAttachmentType') ?>

    <?php // echo $form->field($model, 'PersianLettersType') ?>

    <?php // echo $form->field($model, 'PersianLettersResponseType') ?>

    <?php // echo $form->field($model, 'PersianLettersDraftType') ?>

    <?php // echo $form->field($model, 'PersianReferralLettersReadType') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
