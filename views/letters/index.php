<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'پیش نویس ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
#add_deraft {
    width: 200px;
}

#lettersGridView table thead th {
    background-color: #f9fdc0 !important;
}
</style>
<!---------create modal--------- -->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="add_deraft_modal"
    data-backdrop="static" data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_deraft' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="add_deraft_modal_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<!---------update modal----------->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="updating" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_Update' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="updating_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<!---------add attachment----------->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="add_attach" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-mg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_Attach' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="add_attach_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->

<!---------send----------->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="sending" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-mg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_sending' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="sending_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<div class="letters-index">

    <button id="add_deraft" style="font-size:15px !important" class="btn btn-danger btn-outline center-block">ایجاد پیش
        نویس</button>
    <?php Pjax::begin(['id' => 'letters-index', 'timeout' => false]); ?>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'hover' => true,
        'resizableColumns' => false,
        'rowOptions' => function ($model, $key, $index, $gird) {
            if ($model->LettersType == 2) {

                $contextMenuId = $gird->columns[0]->contextMenuId;
                return ['data' => ['toggle' => 'context', 'target' => "#" . $contextMenuId], 'style' => 'background-color:#ffe6b3'];
            }
            $contextMenuId = $gird->columns[0]->contextMenuId;
            return ['data' => ['toggle' => 'context', 'target' => "#" . $contextMenuId]];
        },
        'options' => [
            'id' => 'lettersGridView'
        ],
        'columns' => [
            [
                'class' => \liyunfang\contextmenu\SerialColumn::className(),
                'contextMenu' => true,
                'template' => ' {sending}<li class="divider">{updating}<li class="divider"></li>{deleting}<li class="divider"></li>{add-attach}<li class="divider"></li>{delete-attach}<li class="divider"></li>{download}',
                'buttons' => [
                    'sending' => function ($url, $model) {
                        if ($model->LettersType == 1) {
                            return '<li data-id="' . $model->LettersID . '" class="right_contex sending"><i class="right_contex_icon fa fa-send"></i>ارسال پیشنویس</li>' . PHP_EOL;
                        } elseif ($model->LettersType == 2 && $model->LettersResponseID != null) {
                            $reciver = Yii::$app->db->createCommand("CALL SP_FindUsersForSendAnswer('.$model->LettersResponseID.')")->queryOne();
                            return '<li data-name="' . $reciver['FullName'] . '" data-rid="' . $model->LettersResponseID . ' " data-id="' . $model->LettersID . ' " class="right_contex sending_answer"><i class="right_contex_icon fa fa-send"></i>ارسال به ' . $reciver['FullName'] . '</li>' . PHP_EOL;
                        }
                    },
                    'updating' => function ($url, $model) {
                        return '<li data-id="' . $model->LettersID . '" class="right_contex updating"><i class="right_contex_icon fa fa-edit"></i>بروزرسانی</li>' . PHP_EOL;
                    },
                    'deleting' => function ($url, $model) {
                        return '<li data-id="' . $model->LettersID . '" class="right_contex deleting"><i class="right_contex_icon fa fa-trash"></i>حذف </li>' . PHP_EOL;
                    },
                    'add-attach' => function ($url, $model) {
                        if ($model->LettersAttachmentType == 1) {

                            return '<li data-id="' . $model->LettersID . '" class="right_contex add-attach"><i class="right_contex_icon fa fa-file"></i>افزودن پیوست </li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-file"></i>افزودن پیوست </li>' . PHP_EOL;
                        }
                    },
                    'delete-attach' => function ($url, $model) {
                        if ($model->LettersAttachmentType == 2) {

                            return '<li data-id="' . $model->LettersID . '" class="right_contex delete-attach"><i class="right_contex_icon fa fa-close"></i>حذف پیوست </li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-close"></i>حذف پیوست </li>' . PHP_EOL;
                        }
                    },
                    'download' => function ($url, $model) {
                        if ($model->LettersAttachmentType == 2) {

                            return '<li data-id="' . $model->LettersID . '" class="right_contex download"><i class="right_contex_icon fa fa-download"></i>دانلود پیوست </li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-download"></i>دانلود پیوست </li>' . PHP_EOL;
                        }
                    }
                ],
            ],
            'LettersID',
            'LettersSubject',
            // 'LettersText:ntext',
            'LettersAbstract',
            'LettersCreateDate',
            'LettersNumber',
            'persianLettersDraftType',
            'persianLettersType',
            'persianLettersTypeOfAction',
            'persianLettersSecurity',
            'persianLettersFollowType',
            'persianLettersResponseType',
            'persianLettersAttachmentType',
            'LettersResponseDate',
            'LettersAttachmentFileName',
            'persianLettersArchiveType',

        ],
    ]); ?>

    <?php
    $lunchModal = Yii::$app->getUrlManager()->createUrl('letters/lunch-modal');
    $sending = Yii::$app->getUrlManager()->createUrl('letters/sending');
    $sending_answer = Yii::$app->getUrlManager()->createUrl('letters/sending-answer');
    $updating = Yii::$app->getUrlManager()->createUrl('letters/updating');
    $add_attach = Yii::$app->getUrlManager()->createUrl('letters/add-attach');
    $delete_attach = Yii::$app->getUrlManager()->createUrl('letters/delete-attach');
    $deleting = Yii::$app->getUrlManager()->createUrl('letters/deleteing');

    $this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/sweetalert.css');
    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/js/sweetalert.min.js');

    $script = <<<JS
    document.title = 'پیش نویس ها';


    $('#add_deraft').click(function(){
        NProgress.start();
    var ok = true;
    $.post('$lunchModal',{ok:ok},function(data){
        $('#add_deraft_modal').modal('show').find('#add_deraft_modal_box').html(data);
        NProgress.done();
    })
});
// --------------------------------------------------
$('.download').click(function(){
    let id = $(this).data('id');
    MyWindow=window.open('/automationsystem/letters/download-file?id='+id+'','MyWindow','toolbar=yes,location=yes,directories=yes,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=500,height=500,left=500,top=170');
    return false;
});
// --------------------------------------------------
$('.sending').click(function(){
    let id = $(this).data('id');
    NProgress.start();

    $.post('$sending',{id:id},function(data){
        $('#sending').modal('show').find('#sending_box').html(data);
        NProgress.done();
    })
});
// --------------------------------------------------
$('.sending_answer').click(function(){
    let id = $(this).data('id');
    let rid = $(this).data('rid');
    let name =$(this).data('name');
    swal({
  title: "ارسال پاسخ",
  text: "ایا مایل به ارسال پاسخ به "+name+" "+"هستید؟",
  type: "info",
  showCancelButton: true,
  confirmButtonText: "بله",
  cancelButtonText: "خیر",
  closeOnConfirm: true,
  confirmButtonClass: "btn-success confirm-btn",
  cancelButtonClass: "btn-danger",
  allowEscapeKey:true,
  focusConfirm:false,
  focusCancelButton:true,
  allowEnterKey:false

}, function(){
    NProgress.start();
    $.post('$sending_answer',{id:id,rid:rid},function(data){
        $.pjax.reload({container:"#letters-index",async:false});
        NProgress.done();
    })})
});
// --------------------------------------------------
    $('.updating').click(function(){
    let id = $(this).data('id');
    NProgress.start();

    $.post('$updating',{id:id},function(data){
        $('#updating').modal('show').find('#updating_box').html(data);
        NProgress.done();
    })
});
// --------------------------------------------------
    $('.add-attach').click(function(){
    let id = $(this).data('id');
    NProgress.start();

    $.post('$add_attach',{id:id},function(data){
        $('#add_attach').modal('show').find('#add_attach_box').html(data);
        NProgress.done();
    })
});
// --------------------------------------------------
$('.delete-attach').click(function(){
    let id = $(this).data('id');
    swal({
  title: "حذف پیوست",
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
   $.post('$delete_attach',{id:id},function(data){
        $.pjax.reload({container:"#letters-index",async:false});
        let deleted = $.parseJSON(data);
        if(deleted.del_attach == 'ok'){
            swal("موفقیت", "حذف پیوست با موفقیت انجام شد!", "success");
        }else if(deleted.del_attach == 'no'){
            swal("موفقیت", " پیوست قبلا حذف شد!", "success");
        }else if(deleted.del_attach == 'no-file'){
            swal("موفقیت", " فایل قبلا حذف شد!", "success");
        }
        NProgress.done();

    })
    
});
});
// --------------------------------------------------
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
        $.pjax.reload({container:"#letters-index",async:false});
        NProgress.done();
        swal("موفقیت", "حذف با موفقیت انجام شد!", "success");
    })
    
});

});
JS;
    $this->registerJs($script);
    ?>
    <?php Pjax::end(); ?>
</div>