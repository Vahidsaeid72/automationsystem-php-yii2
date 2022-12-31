<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VwUsersjobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vw Usersjobs';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$script = <<<JS
    document.title = 'مشاغل';
    JS;
$this->registerJs($script);
?>
<div class="vw-usersjob-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UsersJobID',
            'UsersJobStartDate',
            'UsersJobEndDate',
            'UsersJobStatus',
            'UsersID_FK',
            //'JobsID_FK',
            //'JobsID',
            //'JobsName',
            //'JobsDescription',
            //'JobsLevel',
            //'JobsParentID',
            //'JobsStatus',
            //'FullName',
            //'PersianJobsStatus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>