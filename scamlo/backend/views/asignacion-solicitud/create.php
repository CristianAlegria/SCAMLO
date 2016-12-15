<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */

$this->title = 'Asignacion de trabajadores a Solicitudes';
$this->params['breadcrumbs'][] = ['label' => 'Asignar trabajadores a solicitudes de mantenimiento y logistica', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignacion-solicitud-create">

     <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
		'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]) ?>

</div>
