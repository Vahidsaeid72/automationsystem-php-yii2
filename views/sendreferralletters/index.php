<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SendReferrallettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ارجاعی ارسالی';
$this->params['breadcrumbs'][] = $this->title;


$script = <<<JS
document.title = ' ارجاعی ارسالی ';
JS;
$this->registerJs($script);

?>
<style>
#SendreferrallettersGridView table thead th {
    background-color: #f9fdc0 !important;

}

.confirm-btn,
.cancel-btn {
    width: 100px;
}
</style>
<div class="vw-referralletters-index">


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
            'id' => 'SendreferrallettersGridView'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'ReferralLettersID',
            'ReferralLettersDate',
            // 'ReferralLettersDescription:ntext',
            // 'LettersID_FK',
            // 'UsersID_Sender',
            //'UsersID_Receiver',
            //'ReferralLettersReadType',
            //'LettersID',
            //'LettersSubject',
            //'LettersText:ntext',
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
            'FullNameSender',
            'FullNameReceiver',
            'FullCreator',
            'PersianLettersTypeOfAction',
            'PersianLettersSecurity',
            'PersianLettersArchiveType',
            'PersianLettersFollowType',
            'PersianLettersAttachmentType',
            'PersianLettersType',
            'PersianLettersResponseType',
            'PersianLettersDraftType',
            'PersianReferralLettersReadType',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>