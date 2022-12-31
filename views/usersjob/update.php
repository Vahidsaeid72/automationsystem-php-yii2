<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VwUsersjob */

$this->title = 'Update Vw Usersjob: ' . $model->UsersJobID;
$this->params['breadcrumbs'][] = ['label' => 'Vw Usersjobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UsersJobID, 'url' => ['view', 'id' => $model->UsersJobID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vw-usersjob-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
