<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */

$this->title = 'Tareas a realizar: ';
$this->params['breadcrumbs'][] = ['label' => 'Tareas a realizar', 'url' => ['index2']];
$this->params['breadcrumbs'][] = ['label' => $model->asignacion_id, 'url' => ['view', 'id' => $model->asignacion_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="asignacion-solicitud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_modificaTrabajador', [
        'model' => $model,
    ]) ?>

</div>
