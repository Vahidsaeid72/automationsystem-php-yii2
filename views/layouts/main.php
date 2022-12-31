<?php
/* @var $this \yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

\app\assets\AppAsset::register($this);


$session = \Yii::$app->session;

$logout = Yii::$app->urlManager->createUrl(['site/logout']);

$script = <<<JS
$('.navbar_header').click(function(){
    let id = $(this).data('id');
    swal({
  title: "خروج",
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
   let ok = true;
   $.post('$logout',{ok:ok},function(data){
        NProgress.done();
    })
    
});
});
JS;
$this->registerJs($script);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<style>
.loading {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 1200;
    display: none;
    background-color: transparent;
    opacity: 0.4;
}

body {
    font-size: 8px !important;
}

.container-fluid a {
    font-size: 12px !important;
}

button {
    font-size: 8px !important;
}

.panel-heading {
    color: white !important;
    background-color: #34495e !important;
    border-color: #ddd;
}

body {
    margin-top: 50px;
}

.glyphicon {
    margin-right: 10px;
}

.panel-body {
    padding: 0px;
}

.panel-body table tr td {
    padding-left: 15px
}

.panel-body .table {
    margin-bottom: 0px;
}

.navbar_header {
    color: white;
    font-size: 12px;
    cursor: pointer;
    list-style: none;
    text-decoration: none !important;
    position: absolute;
    left: 100px;
    top: 30%;
    transition: all 0.2s ease-in;
}

.navbar_header:hover {
    color: sandybrown;
}

.btn-danger {
    width: 100px;

}
</style>


<body class="bg">

    <div class="row loading  ">

    </div>


    <div class="loader">

    </div>

    <?php $this->beginBody() ?>


    <?php
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'style' => 'background-color:black;box-shadow: 0 0 20px grey, 0 0 20px grey '

        ],
    ]);

    ?>
    <a class="navbar_header">خروج</a>
    <?php
    NavBar::end();
    ?>
    <br>
    <br>




    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-3" style="min-height: 100vh !important; background-color: #EFF1F2">
                <div style=" box-shadow: 0 0 20px #2980b9, 0 0 20px #2980b9 ;" class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title" style="text-align: center">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span
                                        style="margin-left: 15px" class="fa fa-building-o">
                                    </span>عملیات</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table">

                                    <?php
                                    if ($session->get('UsersAccess14') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-star">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['/']) ?>"> مدیریت
                                                    سطوح
                                                    دسترسی
                                                </a></li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess1') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-edit">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['letters/index']) ?>">ثبت
                                                    پیشنویس</a></li>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>


                                    <?php
                                    if ($session->get('UsersAccess2') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-envelope">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['recieveletter/index']) ?>">صندوق
                                                    ورودی</a></li>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess3') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-envelope-open-o">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['readedletters/index']) ?>">نامه
                                                    های خوانده شده</a></li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess4') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-envelope-o">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['unreadletters/index']) ?>">نامه
                                                    های خوانده نشده</a></li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess5') == 1) {
                                    ?>

                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-user-secret">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['securityletters/index']) ?>">نامه
                                                    های محرمانه</a></li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess6') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-bolt">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['forceletters/index']) ?>">نامه
                                                    های اقدام فوری</a></li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess7') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-envelope-open">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['sendletters/index']) ?>">صندوق
                                                    خروجی</a></li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess8') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-arrow-right">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['receivedreferralletters/index']) ?>">ارجاعی
                                                    رسیده</a></li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess9') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-reply-all">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['sendreferralletters/index']) ?>">ارجاعی
                                                    ارسالی</a></li>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess10') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-recycle">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['followupletters/index']) ?>">نامه
                                                    های پیگیری دار</a></li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess11') == 1) {
                                    ?>

                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-users">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['users/index']) ?>">کاربران</a>
                                            </li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess12') == 1) {
                                    ?>



                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-podcast">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['jobs/index']) ?>">مدیریت
                                                    مشاغل</a></li>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($session->get('UsersAccess13') == 1) {
                                    ?>
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px" class="fa fa-trash-o">
                                            </span>
                                            <li style="list-style: none" class="active"><a style="cursor: pointer"
                                                    class="js-pjax"
                                                    data-href="<?= Yii::$app->urlManager->createUrl(['letterstrash/index']) ?>">سطل
                                                    زباله</a></li>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-sm-9 col-md-9">
                <div class="well"
                    style="box-shadow: 0 0 20px #2980b9, 0 0 20px #2980b9 ;background-color: white !important; min-height: 100vh !important;">



                    <hr style="border-color: red;box-shadow: 0 0 20px red, 0 0 20px red ;">

                    <?php \yii\widgets\Pjax::begin(['id' => 'layout-render', 'timeout' => false, 'formSelector' => false]); ?>


                    <?= $content ?>


                    <?php \yii\widgets\Pjax::end(); ?>




                </div>
            </div>


        </div>
    </div>

    <style>

    </style>





    <?php $this->endBody() ?>



</body>

<?php
$script = <<<JS


$(document)
.on('click','.js-pjax',function(e) {
      
        NProgress.start();

        var link = $(this).data('href');

        var ok = true;

        $.post(link,{ok:ok},function(data) {
          
            $('#layout-render').html(data);
            
            history.pushState(null,'',link);
      
             NProgress.done();
        });
        
})
.on('click','.js-pjax',function(e) {
    e.preventDefault();
});
    	

// function register_tab_GUID() {
//     // detect local storage available
//     if (typeof (Storage) !== "undefined") {
//         // get (set if not) tab GUID and store in tab session
//         if (sessionStorage["tabGUID"] == null) sessionStorage["tabGUID"] = tab_GUID();
//         var guid = sessionStorage["tabGUID"];
//
//         // add eventlistener to local storage
//         window.addEventListener("storage", storage_Handler, false);
//
//         // set tab GUID in local storage
//         localStorage["tabGUID"] = guid;
//     }
// }
//
// function storage_Handler(e) {
//     // if tabGUID does not match then more than one tab and GUID
//     if (e.key == 'tabGUID') {
//         if (e.oldValue != e.newValue) tab_Warning();
//     }
// }
//
// function tab_GUID() {
//     function s4() {
//         return Math.floor((1 + Math.random()) * 0x10000)
//           .toString(16)
//           .substring(1);
//     }
//     return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
//       s4() + '-' + s4() + s4() + s4();
// }
//
// function tab_Warning() {
//     location.href="/hds/site/erroring";
//     // alert("Another tab is open!");
//  
// }
// register_tab_GUID();

// $(document).on('click', '.js-pjax', function(e){
//   
//     e.preventDefault();
//     
//     var a = $(this);
//     var href = a.attr('href');
//     var pjax_id = "w0";
//   
//     $.pjax.reload({container:'#depot-form' + pjax_id, url:href});
//
//
//     return false;
// });
// $(document).keydown(function(e){
//     if(e.which === 123){
//        return false;
//     }
// });
// document.onkeydown = function(e) {
// if(event.keyCode == 123) {
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
// return false;
// }
// }
// $(document).bind("contextmenu",function(e) {
//  e.preventDefault();
// });



JS;
$this->registerJs($script);

?>

</html>

<?php $this->endPage() ?>