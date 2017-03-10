<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use backend\models\Estado;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AsignacionSolicitudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ver tareas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignacion-solicitud-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
      
    <p>
        <?= Html::a('Asignar tareas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
    <?php
        echo Html::a(Icon::show('file-pdf-o').'Click aqui. REPORTE EN PDF', ['/asignacion-solicitud/report'], [
            'class'=>'btn btn-xs linksWithTarget', 
            'target'=>'_blank', 
        ]);
    ?>
</p>
    <?php Pjax::begin();       
    ?>  

    <?= GridView::widget([
        'id' => 'asignacion-solicitud-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'asignacion_id',
            //'id',
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
                    return Html::a(Icon::show('pencil'), '#', [
                        'id' => 'activity-index-link',
                        'title' => Yii::t('app', 'Actualizar asignación'),
                        'class'=>'btn btn-danger btn-xs',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['update', 'id' => $model->id,'solicitud_id' => $model->solicitud_id]),
                        'data-pjax' => '0',
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

     <?php
        Modal::begin([
            'id' => 'modal',
            'size' => 'modal-md',
            'header' => '<h3>Actualizar asignacion</h3>',
            ]);

        echo "<div></div>";

        Modal::end();
    ?>
</div>
