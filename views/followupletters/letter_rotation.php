<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FollowUpLetters */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
<style>
td {
    font-size: 12px;
}

h1 {
    font-size: 20px;
}

#rotationlettersGridView table thead th {
    background-color: #dca7a7;
}

.confirm-btn,
.cancel-btn {
    width: 100px;
}

.modal-dialog {
    min-width: 80vw !important;
}

.modal-mg {
    min-width: 30vw !important;
}

.form-control {
    width: 100%;
}

.right_contex {
    padding-right: 10px;
    cursor: pointer;
    font-size: 12px;
}

.right_contex_icon {
    margin-left: 10px;
}
</style>

<div class="alert alert-info text-center">
    <h5 class="text-primary">مشاهده اطلاعات نامه با شماره : <strong><?= $model->LettersNumber ?></strong></h5>
    <h5 class="text-primary">تاریخ ارسال : <strong><?= $model->SendLettersDate ?></strong></h5>
</div>
<div class="vw-recieveletter-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'responsive' => true,
        'hover' => true,
        'resizableColumns' => false,

        'options' => [
            'id' => 'rotationlettersGridView'
        ],
        'columns' => [
            'ReferralLettersDate',
            'FullNameSender',
            'FullNameReceiver',
            [
                'class' => 'yii\grid\ActionColumn', 'header' => 'مشاهده توضیحات', 'template' => '{view_description}',
                'buttons' =>
                [
                    'view_description' => function ($url, $model) {
                        return '<button data-id="' . $model->ReferralLettersID . '" class="btn btn-danger btn-outline show_desc" type="button">مشاهده جزئیات</button>';
                    }
                ]
            ]
        ],
    ]); ?>
    <?php
    $showDescrioption = Yii::$app->getUrlManager()->createUrl('followupletters/show-description');
    // $this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/sweetalert.css');
    // $this->registerJsFile(Yii::$app->request->baseUrl . '/web/js/sweetalert.min.js');

    $script = <<<JS

$('.show_desc').click(function(){
    let id = $(this).data('id');
    NProgress.start();

    $.post('$showDescrioption',{id:id},function(data){
        $('#letter_description').modal('show').find('#letter_description_box').html(data);
        NProgress.done();
    })
});

JS;
    $this->registerJs($script);
    ?>
    <?php Pjax::end(); ?>
</div>