<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FollowUpLetters */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'نامه های پیگیری دار';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
td {
    font-size: 12px;
}

h1 {
    font-size: 20px;
}

#RecivelettersGridView table thead th {
    background-color: #ccf5ff;
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
<!-- -------------show_letter------------------- -->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="show_letter" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_show_letter' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="show_letter_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!-- ------------------------------ -->

<!-- -------------letter_rotation------------------- -->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="letter_rotation"
    data-backdrop="static" data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_letter_rotation' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="letter_rotation_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!-- ------------------------------ -->
<!-- -------------letter_description------------------- -->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="letter_description"
    data-backdrop="static" data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_letter_description' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="letter_description_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!-- ------------------------------ -->
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
        'rowOptions' => function ($model, $key, $index, $gird) {

            $contextMenuId = $gird->columns[0]->contextMenuId;
            return ['data' => ['toggle' => 'context', 'target' => "#" . $contextMenuId]];
        },
        'options' => [
            'id' => 'RecivelettersGridView'
        ],
        'columns' => [
            [
                'class' => \liyunfang\contextmenu\SerialColumn::className(),
                'contextMenu' => true,
                'template' => ' {show_letter}<li class="divider">{download}<li class="divider">{letter_rotation}',
                'buttons' => [
                    'show_letter' => function ($url, $model) {
                        return '<li data-id="' . $model->LettersID . '" class="right_contex show_letter"><i class="right_contex_icon fa fa-eye"></i>مشاهده نامه</li>' . PHP_EOL;
                    },
                    'letter_rotation' => function ($url, $model) {
                        return '<li data-id="' . $model->LettersID . '" class="right_contex letter_rotation"><i class="right_contex_icon fa fa-recycle"></i>گردش نامه</li>' . PHP_EOL;
                    },

                    'download' => function ($url, $model) {
                        if ($model->LettersAttachmentType == 2) {

                            return '<li data-id="' . $model->LettersID . '" class="right_contex download"><i class="right_contex_icon fa fa-download"></i>دانلود پیوست </li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-download"></i>دانلود پیوست </li>' . PHP_EOL;
                        }
                    },
                ],
            ],
            'LettersID',
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
            'LettersResponseDate',
            //'LettersResponseID',
            // 'LettersAttachmentType',
            //'LettersAttachmentUrl',
            'LettersAttachmentFileName',
            'PersianLettersAttachmentType',
            //'LettersArchiveType',
            //'UsersID_FK',
            //'FullNameSender',
            'FullNameReciever' =>
            [
                'label' => 'گیرندگان',
                'attribute' => 'FullNameReciever',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::activeDropDownList($model, 'FullNameReciever', \yii\helpers\ArrayHelper::map(
                        \app\models\VwUsers::find()->select(['UsersID', 'FullName'])->where(['IN', 'UsersID', \app\models\VwRecieveletter::find()->select(['UsersID_Reciever'])
                            ->where(['LettersID' => $model->LettersID])])->all(),
                        'UsersID',
                        'FullName'
                    ), []);
                }
            ],
            //'SendLettersID',
            //'UsersID_Reciever',
            'SendLettersDate',
            //'SendLettersReadType',
            'PersianLettersTypeOfAction',
            'PersianLettersSecurity',
            'PersianLettersArchiveType',
            'PersianLettersFollowType',
            // 'PersianLettersAttachmentType',
            'PersianLettersType',
            'PersianLettersResponseType',
            // 'PersianLettersDraftType',
            // 'PersianSendLettersReadType',

        ],
    ]); ?>
    <?php
    $showLetter = Yii::$app->getUrlManager()->createUrl('followupletters/show-letter');
    $letterRotation = Yii::$app->getUrlManager()->createUrl('followupletters/letter-rotation');
    // $this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/sweetalert.css');
    // $this->registerJsFile(Yii::$app->request->baseUrl . '/web/js/sweetalert.min.js');

    $script = <<<JS
    document.title = 'نامه های پیگیری دار';


$('.show_letter').click(function(){
    let id = $(this).data('id');
    NProgress.start();

    $.post('$showLetter',{id:id},function(data){
        $('#show_letter').modal('show').find('#show_letter_box').html(data);
        NProgress.done();
    })
});

$('.letter_rotation').click(function(){
    let id = $(this).data('id');
    NProgress.start();

    $.post('$letterRotation',{id:id},function(data){
        $('#letter_rotation').modal('show').find('#letter_rotation_box').html(data);
        NProgress.done();
    })
});

$('.download').click(function(){
    let id = $(this).data('id');
    MyWindow=window.open('/automationsystem/recieveletter/download-file?id='+id+'','MyWindow','toolbar=yes,location=yes,directories=yes,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=500,height=500,left=500,top=170');
    return false;
});



JS;
    $this->registerJs($script);
    ?>
    <?php Pjax::end(); ?>
</div>