<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SendLettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'نامه های ارسالی';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
#SendlettersGridView table thead th {
    background-color: #f9fdc0 !important;

}
</style>
<div class="vw-recieveletter-index">

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
            'id' => 'SendlettersGridView'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],



            // 'LettersID',
            'LettersSubject',
            // 'LettersText:ntext',
            'LettersAbstract',
            // 'LettersCreateDate',
            'LettersNumber',
            //'LettersDraftType',
            //'LettersType',
            //'LettersTypeOfAction',
            //'LettersSecurity',
            //'LettersFollowType',
            //'LettersResponseType',
            //'LettersResponseID',
            //'LettersAttachmentType',
            //'LettersAttachmentUrl',
            'LettersAttachmentFileName',
            //'LettersArchiveType',
            //'UsersID_FK',
            // 'FullNameSender',
            'FullNameReciever',
            //'SendLettersID',
            //'UsersID_Reciever',
            'SendLettersDate',
            //'SendLettersReadType',
            'PersianLettersTypeOfAction',
            'PersianLettersSecurity',
            'PersianLettersFollowType',
            'PersianLettersAttachmentType',
            'PersianLettersType',
            'PersianLettersResponseType',
            'LettersResponseDate',
            // 'PersianLettersDraftType',
            'PersianSendLettersReadType',
            'PersianLettersArchiveType',


        ],
    ]); ?>
    <?php
    $script = <<<JS
    document.title = 'نامه های ارسالی';
    JS;
    $this->registerJs($script);
    ?>
    <?php Pjax::end(); ?>
</div>