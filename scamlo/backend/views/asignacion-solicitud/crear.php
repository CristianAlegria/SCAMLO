<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */

$this->title = 'Tabla de Trabajadores';
$this->params['breadcrumbs'][] = ['label' => 'Ver tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Asignar tareas';
$this->params['breadcrumbs'][] = 'Asignar trabajador';
?>
<div class="asignacion-solicitud-create">

     <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_crearAsignacion', [
		'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
