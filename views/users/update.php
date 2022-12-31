<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'ویرایش کاربر: ';
$this->params['breadcrumbs'][] = ['label' => 'کاربران', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="users-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>