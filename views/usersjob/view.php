<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VwUsersjob */

$this->title = $model->UsersJobID;
$this->params['breadcrumbs'][] = ['label' => 'Vw Usersjobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-usersjob-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->UsersJobID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->UsersJobID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'UsersJobID',
            'UsersJobStartDate',
            'UsersJobEndDate',
            'UsersJobStatus',
            'UsersID_FK',
            'JobsID_FK',
            'JobsID',
            'JobsName',
            'JobsDescription',
            'JobsLevel',
            'JobsParentID',
            'JobsStatus',
            'FullName',
            'PersianJobsStatus',
        ],
    ]) ?>

</div>
