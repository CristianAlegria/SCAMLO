<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */

$this->title = 'Tabla de solicitudes';
$this->params['breadcrumbs'][] = ['label' => 'Ver tareas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Asignar tareas';
?>
<div class="asignacion-solicitud-create">

     <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
		'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
