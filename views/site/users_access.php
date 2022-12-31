<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersAccess */
/* @var $form ActiveForm */
?>
<style>
.form-control {
    width: 100%;
}
</style>

<?php
$script = <<<JS

$(document).off('change','#access_drop');

$("#frm-users-access").on('beforeSubmit',function(e) {
     NProgress.start();
    var form = $(this);
    
    var formData = form.serialize();
    
    $.ajax
    ({
    
    url:form.attr('action'),
    type:form.attr('method'),
    data:formData,
    
    success:function(data) {
        
    
    $('#close_users_access').click();
    
    NProgress.done();
        
    }
    
    
    })
    
}).on('submit',function(e) {
  
    
    
    $(document).off('submit','#users-access form[data-pjax]');
  
    e.preventDefault();
    
});


JS;
$this->registerJs($script);
?>
<div class="site-users_access">

    <?php \yii\widgets\Pjax::begin(['id' => 'users-access', 'timeout' => false, 'enablePushState' => false]); ?>

    <?php $form = ActiveForm::begin([

        'options' => ['data-pjax' => 0],
        //        'enableAjaxValidation'=>true,
        //        'validationUrl'=>['jobs/check'],
        'action' => ['site/show-users-access'],
        'id' => 'frm-users-access',


    ]); ?>




    <div class="form-group " align="center">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-info btn-outline register', 'style' => 'font-size:15px !important']) ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'UsersID_FK')->dropDownList($Users, ['prompt' => 'کاربر را انتخاب نمایید', 'id' => 'access_drop']) ?>

        </div>

    </div>

    <div class="row" id="access_form">

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess1')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess2')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess3')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess4')->checkbox() ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess5')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess6')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess7')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess8')->checkbox() ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess9')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess10')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess11')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess12')->checkbox() ?>

            </div>
        </div>


        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess13')->checkbox() ?>

            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'UsersAccess14')->checkbox() ?>

            </div>

        </div>

    </div>


    <?php ActiveForm::end(); ?>

    <?php
    $Access = Yii::$app->urlManager->createUrl(['site/show-users-access']);
    $script = <<<JS

$('#access_form').css('opacity','0');
$(".register").hide();

$(document).on('change','#access_drop',function() {
  
     
    var id  =$(this).find('option:selected').val();
    
    if(id=='')
        {
            $('#access_form').css('opacity','0');
            $(".register").hide();
        }
        else 
            {
                NProgress.start();
        $.post('$Access',{id:id},function(data) {
      
        $('#users-access').html(data);
        
        $('#access_form').css('opacity','1');
        
        $(".register").show();
        
         NProgress.done();
    });
}
    

});
// .on('change',function(e) {
//  
//    
//    
//     $(document).off('change','#access_drop');
//    
//     // e.preventDefault();
//    
// })
JS;
    $this->registerJs($script);

    ?>

    <?php \yii\widgets\Pjax::end(); ?>
</div><!-- site-users_access -->