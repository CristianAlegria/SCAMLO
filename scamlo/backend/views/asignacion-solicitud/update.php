<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */

$this->title = 'Update Asignacion Solicitud: ';
$this->params['breadcrumbs'][] = ['label' => 'Asignacion Solicituds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->asignacion_id, 'url' => ['view', 'id' => $model->asignacion_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asignacion-solicitud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_solicitudes', [
        'model' => $model,
    ]) ?>

</div>
