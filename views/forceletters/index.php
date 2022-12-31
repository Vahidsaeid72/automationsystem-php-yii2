<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ForceLettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'نامه های اقدام فوری';
$this->params['breadcrumbs'][] = $this->title;

$script = <<<JS
document.title = 'نامه های اقدام فوری';
JS;
$this->registerJs($script);
?>

<style>
td {
    font-size: 12px;
}

h1 {
    font-size: 20px;
}

#ForcelettersGridView table thead th {
    background-color: #ccf5ff;
}

.form-control {
    width: 100%;
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
            'id' => 'ForcelettersGridView'
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
            'FullNameSender',
            //'FullNameReciever',
            //'SendLettersID',
            //'UsersID_Reciever',
            'SendLettersDate',
            //'SendLettersReadType',
            // 'PersianLettersTypeOfAction',
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
    <?php Pjax::end(); ?>
</div>