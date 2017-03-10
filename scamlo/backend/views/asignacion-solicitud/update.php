<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */

$this->title = 'Actualizar Asignacion: ';
$this->params['breadcrumbs'][] = ['label' => 'Ver tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->asignacion_id, 'url' => ['view', 'id' => $model->asignacion_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="asignacion-solicitud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_modificarAsignacion', [
        'model' => $model,
    ]) ?>
    

</div>
