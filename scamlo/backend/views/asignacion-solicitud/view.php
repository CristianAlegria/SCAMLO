<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */

$this->title = $model->asignacion_id;
$show_this_nav = PermissionHelpers::requireMinimumRole('Administrativo');
$this->params['breadcrumbs'][] = ['label' => 'Asignar trabajadores a solicitudes de mantenimiento y logistica', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignacion-solicitud-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
         <?php if (!Yii::$app->user->isGuest && $show_this_nav) {

            echo Html::a( Icon::show('trash').'Eliminar', ['delete', 'id' => $model->asignacion_id], [
            'class' => 'btn btn-danger',
            'data' => [
            'confirm' => Yii::t('app', 'Seguro que quieres eliminar este registro de solicitud?'),
            'method' => 'post',
            ],
        ]);
        }
    ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'asignacion_id',
            'nombreEstado',
            //'solicitud_id',
            'nombreSolicitud',
           // 'estado_id',
            //'usuario_id',
            'nombreUser',            
            'equipo_reparado',
            'numero_inventario',
            'observaciones',
            'fecha_hora_inicio',
            'fecha_hora_fin',
        ],
    ]) ?>

</div>
