<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */

$this->title = $model->LettersID;
$this->params['breadcrumbs'][] = ['label' => 'Letters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->LettersID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->LettersID], [
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
            'LettersID',
            'LettersSubject',
            'LettersText:ntext',
            'LettersAbstract',
            'LettersCreateDate',
            'LettersNumber',
            'LettersDraftType',
            'LettersType',
            'LettersTypeOfAction',
            'LettersSecurity',
            'LettersFollowType',
            'LettersResponseType',
            'LettersResponseDate',
            'LettersResponseID',
            'LettersAttachmentType',
            'LettersAttachmentUrl',
            'LettersAttachmentFileName',
            'LettersArchiveType',
            'UsersID_FK',
        ],
    ]) ?>

</div>
