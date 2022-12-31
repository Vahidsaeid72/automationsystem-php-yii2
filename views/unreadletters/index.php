<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UnreadLettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'نامه های خوانده نشده';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$script = <<<JS
    document.title = 'نامه های خوانده نشده';
    JS;
$this->registerJs($script);
?>
<style>
#unreadlettersGridView table thead th {
    background-color: #f9fdc0 !important;

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
            'id' => 'unreadlettersGridView'
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
            'PersianLettersTypeOfAction',
            'PersianLettersSecurity',
            'PersianLettersFollowType',
            'PersianLettersAttachmentType',
            'PersianLettersType',
            'PersianLettersResponseType',
            'LettersResponseDate',
            // 'PersianLettersDraftType',
            // 'PersianSendLettersReadType',    
            'PersianLettersArchiveType',


        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>