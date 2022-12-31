<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VwUsersjobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vw Usersjobs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-usersjob-index">

    <?php Pjax::begin(['id' => 'job-rotation', 'timeout' => false, 'formSelector' => false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'responsive' => true,
        'hover' => true,
        'resizableColumns' => false,

        'options' => [
            'id' => 'jobsRotationGridView'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'UsersJobID',
            'JobsName',
            'FullName',
            'UsersJobStartDate',
            'UsersJobEndDate',
            // 'UsersJobStatus',
            // 'UsersID_FK',
            // 'JobsID_FK',
            // 'JobsID',
            // 'JobsDescription',
            // 'JobsLevel',
            // 'JobsParentID',
            // 'JobsStatus',
            'PersianJobsStatus',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>