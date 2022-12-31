<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\JobsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'مدیریت مشاغل';
$this->params['breadcrumbs'][] = $this->title;
?>

<!---------add sub jobs----------->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="add_sub_jobs" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-mg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_sub_jobs' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="add_sub_jobs_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<!---------add sub jobs----------->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="edit-job" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-mg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_edit-job' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="edit-job_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<!---------rotation jobs----------->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="job_rotation" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-mg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_job_rotation' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="job_rotation_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<!---------add sub jobs----------->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="user_job" data-backdrop="static"
    data-keyboard="false" class="fade modal fade-scale" role="dialog" tabindex="-1"
    style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-mg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_search " id='cl_close_user_job' style="float: right"
                    data-dismiss="modal" aria-hidden="true">
                    <i style="opacity: 1;font-size: 25px;color: red" class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="user_job_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!------------------ -->
<div class="jobs-index">

    <?php Pjax::begin(['id' => 'jobs-index', 'timeout' => false]); ?>
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
            'id' => 'jobsGridView'
        ],
        'columns' => [
            [
                'class' => \liyunfang\contextmenu\SerialColumn::className(),
                'contextMenu' => true,
                'template' => ' {add-sub-jobs}<li class="divider"></li>{edit-job}<li class="divider"></li>{job-rotation}<li class="divider"></li>{user-job}<li class="divider"></li>{end-job}',
                'buttons' => [

                    'add-sub-jobs' => function ($url, $model) {

                        return '<li data-id="' . $model->JobsID . '" class="right_contex add-sub-jobs"><i class="right_contex_icon fa fa-file"></i>افزودن زیر مجموعه </li>' . PHP_EOL;
                    },
                    'edit-job' => function ($url, $model) {

                        return '<li data-id="' . $model->JobsID . '" class="right_contex edit-job"><i class="right_contex_icon fa fa-edit"></i>ویرایش شغل</li>' . PHP_EOL;
                    },
                    'job-rotation' => function ($url, $model) {

                        return '<li data-id="' . $model->JobsID . '" class="right_contex job-rotation"><i class="right_contex_icon fa fa-recycle"></i>گردش شغل</li>' . PHP_EOL;
                    },
                    'user-job' => function ($url, $model) {
                        if ($model->JobsStatus == 0) {
                            return '<li data-id="' . $model->JobsID . '" class="right_contex user-job"><i class="right_contex_icon fa fa-arrow-left"></i>انتصاب شغل</li>' . PHP_EOL;
                        } else {
                            return '<li  class="right_contex" style="color:gray; cursor: not-allowed;"><i class="right_contex_icon fa fa-arrow-left"></i>انتصاب شغل</li>' . PHP_EOL;
                        }
                    },
                    'end-job' => function ($url, $model) {
                        if ($model->JobsStatus == 1) {
                            return '<li data-id="' . $model->JobsID . '" class="right_contex end-job"><i class="right_contex_icon fa fa-remove"></i>عزل شغل</li>' . PHP_EOL;
                        } else {
                            return '<li  class="right_contex" style="color:gray; cursor: not-allowed;"><i class="right_contex_icon fa fa-remove"></i>عزل شغل</li>' . PHP_EOL;
                        }
                    },
                ],
            ],

            // 'JobsID',
            'JobsName',
            'JobsDescription',
            // 'JobsLevel',
            'SubJobs' => [
                'label' => 'زیر مجموعه شغلی',
                'attribute' => 'SubJobs',
                'value' => function ($model) {
                    if ($model->JobsParentID == 0) {
                        return "ریشه";
                    } else {
                        return $model->SubJobs;
                    }
                }

            ],
            'PersianJobsStatus',
            'Username' => [
                'label' => 'متصدی شغل',
                'attribute' => 'Username',
                'value' => function ($model) {
                    if ($model->JobsStatus == 1) {
                        $findUser = Yii::$app->db->createCommand('CALL SP_FindUserForJob(' . $model->JobsID . ')')->queryOne();
                        return $findUser['FullName'];
                    } else {
                        return 'منتصب نشده';
                    }
                }
            ]

        ],
    ]); ?>


    <?php

    $this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/sweetalert.css');
    $this->registerJsFile(Yii::$app->request->baseUrl . '/web/js/sweetalert.min.js');
    $addSubJobs = Yii::$app->urlManager->createUrl(['jobs/add-sub-job']);
    $editJob = Yii::$app->urlManager->createUrl(['jobs/edit-job']);
    $userJob = Yii::$app->urlManager->createUrl(['jobs/user-job']);
    $endJob = Yii::$app->urlManager->createUrl(['jobs/end-job']);
    $jobRotation = Yii::$app->urlManager->createUrl(['jobs/job-rotation']);

    $script = <<<JS

    document.title = 'مشاغل';

// ---------------------------
    $('.add-sub-jobs').click(function(){
    let id = $(this).data('id');
    NProgress.start();
    $.post('$addSubJobs',{id:id},function(data){
    $('#add_sub_jobs').modal('show').find('#add_sub_jobs_box').html(data);
    NProgress.done();
    }) 
    });
// ---------------------------
    $('.job-rotation').click(function(){
    let id = $(this).data('id');
    NProgress.start();
    $.post('$jobRotation',{id:id},function(data){
    $('#job_rotation').modal('show').find('#job_rotation_box').html(data);
    NProgress.done();
    }) 
    });
// ---------------------------
    $('.user-job').click(function(){
    let id = $(this).data('id');
    NProgress.start();
    $.post('$userJob',{id:id},function(data){
    $('#user_job').modal('show').find('#user_job_box').html(data);
    NProgress.done();
    }) 
    });
// ---------------------------
    $('.edit-job').click(function(){
    let id = $(this).data('id');
    NProgress.start();
    $.post('$editJob',{id:id},function(data){
    $('#edit-job').modal('show').find('#edit-job_box').html(data);
    NProgress.done();
    }) 
    });
// ---------------------------
    $('.end-job').click(function(){
        let id = $(this).data('id');
    swal({
  title: "عزل شغل",
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
    $.post('$endJob',{id:id},function(data){
        $.pjax.reload({container:"#jobs-index",async:false});
        swal("موفقیت", "عزل با موفقیت انجام شد!", "success");
        NProgress.done();
    }) 
 });
});
JS;
    $this->registerJs($script);
    ?>
    <?php Pjax::end(); ?>
</div>