<?php

/* @var $this yii\web\View */

$this->title = 'مدیریت دسترسی';

$session = \Yii::$app->session;
?>
<?php
$script = <<<JS
document.title ='مدیریت درسترسی';

$(".cl_add_draft").click(function() {
  
    $("#users_access_box").empty();
  

    
})

JS;
$this->registerJs($script);

?>
<style>
.modal-lg {
    min-width: 80vw !important;
}

#grid-view table thead th {
    background-color: #b3f0ff;
}

.form-control {
    width: 100%;
}
</style>
<!---->
<div role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" id="users_access" data-backdrop="static"
    data-keyboard="false" class="fade modal " role="dialog" tabindex="-1" style="display: none; padding-right: 19px;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" id="close_users_access" class="close cl_add_draft"
                    style="float: right;opacity: 1 !important;" data-dismiss="modal" aria-hidden="true"><i
                        style="opacity: 1 ;font-size: 25px;color: red" class="fa fa-close"></i></button>

            </div>
            <div class="modal-body">

                <div id="users_access_box">



                </div>


            </div>

        </div>
    </div>
</div>
<!---->



<?php
// if($session->get('UsersAccess14')==1)
// {
?>

<div class="row">
    <div class="col-md-1">

    </div>
    <div class="col-md-3">
        <button style="font-size: 16px !important;" class="btn btn-warning btn-outline users_access">مدیریت سطوح
            دسترسی</button>
    </div>
    <div class="col-md-1">

    </div>


</div>
<?php
// }
?>
<?php
$this->registerCssFile(Yii::$app->request->baseUrl . '/web/css/sweetalert.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/web/js/sweetalert.min.js');

$UsersAccess = Yii::$app->urlManager->createUrl(['site/users-access']);




$script = <<<JS
    


$('.users_access').click(function() {
  
     NProgress.start();
   var id = true;
    
    $.post('$UsersAccess',{id:id},function(data) {
      
        $("#users_access").modal('show').find("#users_access_box").html(data);
        
         NProgress.done();
        
    });
    
    
});



JS;
$this->registerJs($script);


?>