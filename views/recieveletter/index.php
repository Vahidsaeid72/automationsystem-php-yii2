<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VwRecieveletterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'نامه های دریافتی';
$this->params['breadcrumbs'][] = $this->title;

$script = <<<JS
    document.title = 'نامه های  دریافتی';
$('#cl_close_show_letter').click(function () {
    $.pjax.reload({container:"#vw-recieveletter-index",async:false});
})
JS;
$this->registerJs($script);
?>
<style>
#RecivelettersGridView table thead th {

    background-color: #f9fdc0 !important;

}
</style>

<!---------show letter--------- -->
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
<!------------------ -->
<!---------send_answer--------- -->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="send_answer" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_send_answer' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="send_answer_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<!---------referral--------- -->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="referral" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_referral' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="referral_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<div class="vw-recieveletter-index">


    <?php Pjax::begin(['id' => 'vw-recieveletter-index', 'timeout' => false]); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]);
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'hover' => true,
        'resizableColumns' => false,

        'rowOptions' => function ($model, $key, $index, $gird) {
            if ($model->SendLettersReadType == 1) {

                $contextMenuId = $gird->columns[0]->contextMenuId;
                return ['data' => ['toggle' => 'context', 'target' => "#" . $contextMenuId], 'style' => 'background-color:#ffb6b6'];
            }
            $contextMenuId = $gird->columns[0]->contextMenuId;
            return ['data' => ['toggle' => 'context', 'target' => "#" . $contextMenuId], 'style' => 'background-color:#b6ffdd'];
        },
        'options' => [
            'id' => 'RecivelettersGridView'
        ],
        'columns' => [
            [
                'class' => \liyunfang\contextmenu\SerialColumn::className(),
                'contextMenu' => true,
                'template' => ' {show_letter}<li class="divider">{send_answer}<li class="divider"></li>{deleting}<li class="divider"></li>{download}<li class="divider"></li>{referral}',
                'buttons' => [
                    'show_letter' => function ($url, $model) {
                        return '<li data-id="' . $model->LettersID . '" class="right_contex show_letter"><i class="right_contex_icon fa fa-eye"></i>مشاهده نامه</li>' . PHP_EOL;
                    },

                    'send_answer' => function ($url, $model) {
                        if ($model->SendLettersReadType == 2) {
                            return '<li data-id="' . $model->LettersID . '" class="right_contex send_answer"><i class="right_contex_icon fa fa-reply"></i>پاسخ به نامه</li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-reply"></i>پاسخ به نامه </li>' . PHP_EOL;
                        }
                    },

                    'deleting' => function ($url, $model) {
                        return '<li data-id="' . $model->LettersID . '" class="right_contex deleting"><i class="right_contex_icon fa fa-trash"></i>حذف نامه</li>' . PHP_EOL;
                    },


                    'download' => function ($url, $model) {
                        if ($model->LettersAttachmentType == 2) {

                            return '<li data-id="' . $model->LettersID . '" class="right_contex download"><i class="right_contex_icon fa fa-download"></i>دانلود پیوست </li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-download"></i>دانلود پیوست </li>' . PHP_EOL;
                        }
                    },
                    'referral' => function ($url, $model) {
                        if ($model->SendLettersReadType == 2) {
                            return '<li data-id="' . $model->LettersID . '" class="right_contex referral"><i class="right_contex_icon fa fa-reply-all"></i>ارجاع نامه</li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-reply-all"></i>ارجاع نامه</li>' . PHP_EOL;
                        }
                    },
                ],
            ],



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
            'PersianSendLettersReadType',
            'PersianLettersArchiveType',


        ],
    ]); ?>
    <?php
    $refrralAction = Yii::$app->getUrlManager()->createUrl('recieveletter/lunch-referral');
    $showLetter = Yii::$app->getUrlManager()->createUrl('recieveletter/show-letter');
    $sendAnswer = Yii::$app->getUrlManager()->createUrl('recieveletter/send-answer');
    $deleting = Yii::$app->getUrlManager()->createUrl('recieveletter/deleting');
    $sending = Yii::$app->getUrlManager()->createUrl('letters/sending');


    $this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/sweetalert.css');
    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/js/sweetalert.min.js');

    $script = <<<JS

$('.show_letter').click(function(){
    let id = $(this).data('id');
    NProgress.start();

    $.post('$showLetter',{id:id},function(data){
        $('#show_letter').modal('show').find('#show_letter_box').html(data);
        NProgress.done();
    })
});

$('.send_answer').click(function(){
    let id = $(this).data('id');
    swal({
  title: "پاسخ به نامه",
  text: "ایا ادامه می دهید",
  type: "info",
  showCancelButton: true,
  confirmButtonText: "بله",
  cancelButtonText: "خیر",
  closeOnConfirm: true,
  confirmButtonClass: "btn-info confirm-btn",
  cancelButtonClass: "btn-danger cancel-btn",
  allowEscapeKey:true,
  focusConfirm:false,
  focusCancelButton:true,
  allowEnterKey:false

}, function(){
   NProgress.start();
   $.post('$sendAnswer',{id:id},function(data){
    $('#send_answer').modal('show').find('#send_answer_box').html(data);
        NProgress.done();
    })
    
});
});
$('.referral').click(function(){
    let id = $(this).data('id');
    swal({
  title: "ارجاع نامه",
  text: "ایا ادامه می دهید",
  type: "info",
  showCancelButton: true,
  confirmButtonText: "بله",
  cancelButtonText: "خیر",
  closeOnConfirm: true,
  confirmButtonClass: "btn-info confirm-btn",
  cancelButtonClass: "btn-danger cancel-btn",
  allowEscapeKey:true,
  focusConfirm:false,
  focusCancelButton:true,
  allowEnterKey:false

}, function(){
   NProgress.start();
   $.post('$refrralAction',{id:id},function(data){
    $('#referral').modal('show').find('#referral_box').html(data);
        NProgress.done();
    })
    
});


});

$('.deleting').click(function(){

    let id = $(this).data('id');
    swal({
  title: "حذف نامه",
  text: "ایا ادامه می دهید",
  type: "error",
  showCancelButton: true,
  confirmButtonText: "بله",
  cancelButtonText: "خیر",
  closeOnConfirm: true,
  confirmButtonClass: "btn-danger",
  allowEscapeKey:true,
  focusConfirm:false,
  focusCancelButton:true,
  allowEnterKey:false

}, function(){
   NProgress.start();
   $.post('$deleting',{id:id},function(data){
        $.pjax.reload({container:"#vw-recieveletter-index",async:false});
        swal("موفقیت", "حذف  با موفقیت انجام شد!", "success");
        NProgress.done();
    })
    
});
});

$('.sending').click(function(){
    let id = $(this).data('id');
    NProgress.start();

    $.post('$sending',{id:id},function(data){
        $('#sending').modal('show').find('#sending_box').html(data);
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