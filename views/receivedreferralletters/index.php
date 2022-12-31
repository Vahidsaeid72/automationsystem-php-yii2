<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReceivedReferrallettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ارجاعی رسیده';
$this->params['breadcrumbs'][] = $this->title;


$script = <<<JS

    document.title = 'ارجاعی رسیده';

JS;
$this->registerJs($script);
?>



<style>
#referrallettersGridView table thead th {
    background-color: #f9fdc0 !important;
}

.confirm-btn,
.cancel-btn {
    width: 100px;
}
</style>
<!---------referral--------- -->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="referral" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_receivedReferral' style="float: right"
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
<div class="vw-referralletters-index">


    <?php Pjax::begin(['id' => 'vw-referralletters-index', 'timeout' => false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'hover' => true,
        'resizableColumns' => false,
        'rowOptions' => function ($model, $key, $index, $gird) {
            if ($model->ReferralLettersReadType == 1) {
                $contextMenuId = $gird->columns[0]->contextMenuId;
                return ['data' => ['toggle' => 'context', 'target' => "#" . $contextMenuId], 'style' => 'background-color:#ffb6b6'];
            }
            $contextMenuId = $gird->columns[0]->contextMenuId;
            return ['data' => ['toggle' => 'context', 'target' => "#" . $contextMenuId], 'style' => 'background-color:#b6ffdd'];
        },
        'options' => [
            'id' => 'referrallettersGridView'
        ],
        'columns' => [
            [
                'class' => \liyunfang\contextmenu\SerialColumn::className(),
                'contextMenu' => true,
                'template' => ' {show_letter}<li class="divider">{download}<li class="divider"></li>{referral}',
                'buttons' => [
                    'show_letter' => function ($url, $model) {
                        return '<li data-id="' . $model->ReferralLettersID . '" class="right_contex show_letter"><i class="right_contex_icon fa fa-eye"></i>مشاهده نامه</li>' . PHP_EOL;
                    },

                    'download' => function ($url, $model) {
                        if ($model->LettersAttachmentType == 2) {

                            return '<li data-id="' . $model->LettersID . '" class="right_contex download"><i class="right_contex_icon fa fa-download"></i>دانلود پیوست </li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-download"></i>دانلود پیوست </li>' . PHP_EOL;
                        }
                    },
                    'referral' => function ($url, $model) {

                        return '<li data-id="' . $model->LettersID . '" data-referral="' . $model->ReferralLettersID . '" class="right_contex referral"><i class="right_contex_icon fa fa-reply-all"></i>ارجاع نامه</li>' . PHP_EOL;
                    },
                ],
            ],

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
    <?php
    $refrralAction = Yii::$app->getUrlManager()->createUrl('receivedreferralletters/lunch-referral');
    $showLetter = Yii::$app->getUrlManager()->createUrl('receivedreferralletters/show-letter');
    $this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/sweetalert.css');
    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/js/sweetalert.min.js');

    $script = <<<JS

$('.referral').click(function(){
    let id = $(this).data('id');
    let referral=$(this).data('referral');

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
   $.post('$refrralAction',{id:id,referral:referral},function(data){
    $('#referral').modal('show').find('#referral_box').html(data);
        NProgress.done();
    })
    
});


});


$('.show_letter').click(function(){
    let id = $(this).data('id');
    NProgress.start();

    $.post('$showLetter',{id:id},function(data){
        $('#show_letter').modal('show').find('#show_letter_box').html(data);
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