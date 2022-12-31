<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VwLetterstrashSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'سطل اشغال';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
#letterstrashGridView table thead th {
    background-color: #f9fdc0 !important;
}
</style>
<div class="vw-letterstrash-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'hover' => true,
        'resizableColumns' => false,
        'options' => [
            'id' => 'letterstrashGridView'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'LettersID',
            'LettersSubject',
            // 'LettersText:ntext',
            'LettersAbstract',
            'LettersCreateDate',
            'LettersNumber',
            //'LettersDraftType',
            //'LettersType',
            //'LettersTypeOfAction',
            //'LettersSecurity',
            //'LettersFollowType',
            //'LettersResponseType',
            //'LettersResponseDate',
            //'LettersResponseID',
            //'LettersAttachmentType',
            //'LettersAttachmentUrl',
            'LettersAttachmentFileName',
            //'LettersArchiveType',
            //'UsersID_FK',
            //'LettersTrashID',
            //'LettersID_FK',
            //'UsersIDDeletor',
            'LettersTrashDate',
            'FullNameSender',
            //'FullNameDeletor',
            'PersianLettersTypeOfAction',
            'PersianLettersSecurity',
            'PersianLettersArchiveType',
            'PersianLettersFollowType',
            'PersianLettersAttachmentType',
            'PersianLettersType',
            'PersianLettersResponseType',
            'PersianLettersDraftType',

        ],
    ]); ?>

    <?php
    $script = <<<JS
    document.title = 'سطل زباله';
    JS;
    $this->registerJs($script);
    ?>

    <?php Pjax::end(); ?>
</div>