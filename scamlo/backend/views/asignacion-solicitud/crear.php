<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */

$this->title = 'Tabla de Trabajadores';
//$this->params['breadcrumbs'][] = ['label' => 'Ver tareas', 'url' => ['index']];
/*$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];*/
$this->params['breadcrumbs'][] = 'Asignar trabajadores';
//$this->params['breadcrumbs'][] = 'Asignar trabajador';
?>
<div class="asignacion-trabajador-crear">

     <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_crearAsignacionForm', [
		'model' => $model,
        
    ]) ?>

</div>
