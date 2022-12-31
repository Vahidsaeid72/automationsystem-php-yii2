<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VwUsersjob */

$this->title = 'Create Vw Usersjob';
$this->params['breadcrumbs'][] = ['label' => 'Vw Usersjobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-usersjob-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
