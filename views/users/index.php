<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'کاربران';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$script = <<<JS
    document.title = 'کاربران';
    JS;
$this->registerJs($script);
?>
<style>
.confirm-btn {
    width: 100px;
    border-radius: 5px;
}

.confirm-btn:hover {
    background: green;
}

.modal-dialog {
    min-width: 80vw !important;
}

.modal-mg {
    min-width: 30vw !important;
}

#usersGridView table thead th {
    background-color: #f9fdc0 !important;

}

.form-control {
    width: 100%;
}
</style>
<!---------add signature----------->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="add_signature" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-mg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_Signature' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="add_signature_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<div class="users-index">

    <?=
    $this->render('create', [
        'model' => $model,
    ])
    ?>
    <?php Pjax::begin(['id' => 'users-index', 'timeout' => false]); ?>
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
            'id' => 'usersGridView'
        ],
        'columns' => [
            [
                'class' => \liyunfang\contextmenu\SerialColumn::className(),
                'contextMenu' => true,
                'template' => ' {add-signature}<li class="divider"></li>{delete-signature}',
                'buttons' => [

                    'add-signature' => function ($url, $model) {
                        if ($model->UsersSignature == null) {

                            return '<li data-id="' . $model->UsersID . '" class="right_contex add-signature"><i class="right_contex_icon fa fa-file"></i>افزودن امضا </li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-file"></i>افزودن امضا </li>' . PHP_EOL;
                        }
                    },
                    'delete-signature' => function ($url, $model) {
                        if ($model->UsersSignature != null) {

                            return '<li data-id="' . $model->UsersID . '" class="right_contex delete-signature"><i class="right_contex_icon fa fa-close"></i>حذف امضا </li>' . PHP_EOL;
                        } else {
                            return '<li data-id="" style="color:gray; cursor: not-allowed;" class="right_contex"><i class="right_contex_icon fa fa-close"></i>حذف امضا </li>' . PHP_EOL;
                        }
                    },

                ],
            ],
            'UsersName',
            'UsersFamily',
            'UsersUserName',
            // 'UsersPassword',
            'PersianUsersGender' => [
                'attribute' => 'PersianUsersGender',
                'label' => 'جنسیت',
                'value' => function ($model) {
                    return $model->PersianUsersGender;
                }
            ],
            'PersianUsersActivity' => [
                'attribute' => 'PersianUsersActivity',
                'label' => 'وضعیت',
                'value' => function ($model) {
                    return $model->PersianUsersActivity;
                }
            ],
            'UsersEmail:email',
            'UsersPhone',
            'UsersMobile',
            'UsersSignature' =>
            [
                'label' => 'امضا',
                'attribute' => 'UsersSignature',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->UsersSignature != null) {
                        $src = Yii::$app->request->baseUrl . '/web/users_picture/' . $model->UsersSignature;
                        return '<img src="' . $src . '" style="width : 100px; height : 100px;" >';
                    }
                }
            ],


            ['class' => 'yii\grid\ActionColumn', "header" => "عملیات", 'template' => '{update}'],
        ],
    ]); ?>

    <?php

    $this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/sweetalert.css');
    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/js/sweetalert.min.js');
    $AddSignature = Yii::$app->urlManager->createUrl(['users/add-signature']);

    $script = <<<JS

$('.add-signature').click(function(){
let id = $(this).data('id');
NProgress.start();

$.post('$AddSignature',{id:id},function(data){
    $('#add_signature').modal('show').find('#add_signature_box').html(data);
    NProgress.done();
}) 
});

// $('.delete-signature').click(function(){
// let id = $(this).data('id');
// swal({
// title: "حذف امضا",
// text: "ایا ادامه می دهید",
// type: "warnning",
// showCancelButton: true,
// confirmButtonText: "بله",
// cancelButtonText: "خیر",
// closeOnConfirm: true,
// confirmButtonClass: "btn-danger",
// allowEscapeKey:true,
// focusConfirm:false,
// focusCancelButton:true,
// allowEnterKey:false

// }, function(){
// NProgress.start();
// $.post('users/delete-signature',{id:id},function(data){
//     $.pjax.reload({container:"#users-index",async:false});
//     let deleted = $.parseJSON(data);
//     if(deleted.del_attach == 'ok'){
//         swal("موفقیت", "حذف پیوست با موفقیت انجام شد!", "success");
//     }else if(deleted.del_attach == 'no'){
//         swal("موفقیت", " پیوست قبلا حذف شد!", "success");
//     }else if(deleted.del_attach == 'no-file'){
//         swal("موفقیت", " فایل قبلا حذف شد!", "success");
//     }
//     NProgress.done();

// })

// });
// });




JS;
    $this->registerJs($script);
    ?>
    <?php Pjax::end(); ?>
</div>