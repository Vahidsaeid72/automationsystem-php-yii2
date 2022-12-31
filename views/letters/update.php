<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */

$this->title = 'Update Letters: ' . $model->LettersID;
$this->params['breadcrumbs'][] = ['label' => 'Letters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->LettersID, 'url' => ['view', 'id' => $model->LettersID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="letters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
