<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;
use kartik\icons\Icon;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */

$this->title = $model->nombreSolicitud;
$show_this_nav = PermissionHelpers::requireMinimumRole('Administrativo');
$iniciaSesionTrabajador = Yii::$app->request->get('iniciaSesionTrabajador');
            
if ($iniciaSesionTrabajador) {
     $this->params['breadcrumbs'][] = ['label' => 'Ver mis tareas', 'url' => ['index2']];
}else{
    $this->params['breadcrumbs'][] = ['label' => 'Ver tareas', 'url' => ['index']];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignacion-solicitud-view">

    <h1><?= Html::encode($this->title); ?></h1> 
    <p>
         <?php if (!Yii::$app->user->isGuest && $show_this_nav) {

            echo Html::a( Icon::show('trash').'Eliminar', ['delete', 'id' => $model->asignacion_id], [
            'class' => 'btn btn-danger',
            'data' => [
            'confirm' => Yii::t('app', 'Seguro que quieres eliminar esta tarea?'),
            'method' => 'post',
            ],
        ]);
        }
    ?>
    </p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'asignacion_id',
            'solicitudId',
            'solicitante',
            'nombreDependencia',
            'nombreServicio',
            'description',
            'nombreEdificio',
            'nombreEspacio',
            'numeroEspacio',
            'otroEspacio',
            'fecha',
            'nombreEstado',
            
            'nombreUser',            
            'equipo_reparado',
            'numero_inventario',
            'observaciones',
            'fecha_hora_inicio',
            'fecha_hora_fin',
            
        
        ],
    ]) ?>
    
    <?php 
           /*echo  "No. de solicitud: ".$model->espacioList[0]['solicitud_id']."<br/>". 
                 "Solicitante: ".$model->espacioList[0]['solicitante']."<br/>".
                 "Dependencia: ".$model->espacioList[0]['nombre_dependencia']."<br/>".
                 "Servicio: ".$model->espacioList[0]['nombre_servicio']."<br/>". 
                 "Descripcion: ".$model->espacioList[0]['description']."<br/>".
                 "Edificio: ".$model->espacioList[0]['nombre_edificio']."<br/>".
                 "Espacio: ".$model->espacioList[0]['nombre_espacio']."<br/>".
                 "Numero de espacio: ".$model->espacioList[0]['numero_espacio']."<br/>".
                 "Descripcion de otro Espacio: ".$model->espacioList[0]['otro_espacio']."<br/>".
                 "Fecha solicitud: ".$model->espacioList[0]['fecha']."<br/>".
                 "Estado de solicitud: ".$model->espacioList[0]['estado']."<br/>";*/
        ?>  

</div>
