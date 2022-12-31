<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">



    <div class="alert alert-danger" style="text-align: center;font-size: 18px">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
