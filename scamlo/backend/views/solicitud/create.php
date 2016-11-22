<?php

use yii\helpers\Html;




/* @var $this yii\web\View */
/* @var $model backend\models\Solicitud */

$this->title = 'Nueva Solicitud';
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,        
    ]) ?>

</div>
