<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Url;
use backend\models\Estado;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AsignacionSolicitudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis tareas';
$this->params['breadcrumbs'][] = "Ver mis tareas";
?>
<div class="asignacion-solicitud-indexTrabajador">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?php Pjax::begin(); 
       ['id' => 'samle', 'linkSelector' => 'a:not(.linksWithTarget)']
    ?>  
    <?= GridView::widget([
        'id' => 'asignacion-solicitud-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'asignacion_id',
            //'solicitud_id',           
           // 'usuario_id',             
            // 'equipo_reparado',
            // 'numero_inventario',
            // 'observaciones',

            /*[
            'attribute' => 'Solicitud',
            'value' => 'solicitud.description',
            'filter' => Html::activeDropDownList($searchModel, 'solicitud_id', ArrayHelper::map(Solicitud::find()->asArray()->all(), 'description', 'description'), ['class' => 'form-control', 'prompt' => '']),
            ],*/

            //'servicio_id',            
            'nombreSolicitud',
           //'espacio_id',         
           //  'numero_piso',
           //  'fecha',
           // 'user_id',
          'nombreUser',
          'fecha_hora_inicio',
          'fecha_hora_fin', 

            

            [
            'attribute' => 'Estado',
            'value' => 'estado.nombre',
            'filter' => Html::activeDropDownList($searchModel, 'estado_id', ArrayHelper::map(Estado::find()->asArray()->all(), 'nombre', 'nombre'), ['class' => 'form-control', 'prompt' => '']),
            ],  

           ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} &nbsp{update}',
                'header' => 'Opciones',
                'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a(Icon::show('pencil'),$url, [
                                'id' => 'activity-index-link',
                                'title' => Yii::t('app', 'Actualizar asignación'),
                                'class'=>'btn btn-danger btn-xs',                                
                                ]);
                        },
                        'view' => function ($url, $model){
                            return Html::a(Icon::show('eye'), $url, [
                                'title' => Yii::t('app', 'Ver asignación'),
                                'class'=>'btn btn-danger btn-xs',
                                ]);
                        },
                ], 

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
