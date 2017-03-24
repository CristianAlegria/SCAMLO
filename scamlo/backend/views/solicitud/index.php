<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\PermissionHelpers;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\icons\Icon;
use backend\models\Status;
use backend\models\Role;
use backend\models\Dependencia;
use backend\models\Servicio;
use backend\models\Espacio;
use backend\models\Estado;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SolicitudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Mis solicitudes';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="solicitud-index">

    <h1><?= Html::encode($this->title) ?></h1>
   

     <p>
       <?= Html::a( Icon::show('plus').'Nueva Solicitud', '#', [
            'id' => 'activity-index-link',
            'class' => 'btn btn-success',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'data-url' => Url::to(['create']),
            'data-pjax' => '0',
        ]); ?>
    </p>
    
    <?php Pjax::begin(); ?> 
    <?= GridView::widget([
        'id' => 'solicitud-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'dependencia_id',
            [
            'attribute' => 'dependencia_id',
            'value' => 'dependencia.nombre_dependencia',
            'filter' => Html::activeDropDownList($searchModel, 'dependencia_id', ArrayHelper::map(Dependencia::find()->asArray()->all(), 'nombre_dependencia', 'nombre_dependencia'), ['class' => 'form-control', 'prompt' => '']),
            ],
            //'servicio_id',
             'nombreUser', 

            [
            'attribute' => 'servicio_id',
            'value' => 'servicio.nombre_servicio',
            'filter' => Html::activeDropDownList($searchModel, 'servicio_id', ArrayHelper::map(Servicio::find()->asArray()->all(), 'nombre_servicio', 'nombre_servicio'), ['class' => 'form-control', 'prompt' => '']),
            ],
            'description',
            //'espacio_id',
            [
            'attribute' => 'espacio_id',
            'value' => 'espacio.nombre',
            'filter' => Html::activeDropDownList($searchModel, 'espacio_id', ArrayHelper::map(Espacio::find()->asArray()->all(), 'nombre', 'nombre'), ['class' => 'form-control', 'prompt' => '']),
            ],
             'numero_piso',
             'fecha',
            // 'user_id',
             //'estado_id',
              [
            'attribute' => 'estado_id',
            'value' => 'estado.nombre',
            'filter' => Html::activeDropDownList($searchModel, 'estado_id', ArrayHelper::map(Estado::find()->asArray()->all(), 'nombre', 'nombre'), ['class' => 'form-control', 'prompt' => '']),
            ],            

             //'descripcion_estado',
 ['class' => 'yii\grid\ActionColumn',
               'visibleButtons' => [

                    'view' => (PermissionHelpers::requireMinimumRole('Administrativo')
                                && PermissionHelpers::requireStatus('Activo')),

                    'update' => (PermissionHelpers::requireMinimumRole('Administrativo')
                                && PermissionHelpers::requireStatus('Activo')),

                    'delete' => (PermissionHelpers::requireRole('Administrativo')
                                && PermissionHelpers::requireStatus('Activo')),
                ],
            'template' => '{view} {update}',
                'header' => 'Opciones',
                'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a(Icon::show('pencil'), '#', [
                        'id' => 'activity-index-link',
                        'title' => Yii::t('app', 'Actualizar solicitud'),
                        'class'=>'btn btn-danger btn-xs',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['update', 'id' => $model->id]),
                        'data-pjax' => '0',
                        ]);
                },

                'view' => function ($url, $model){
                            return Html::a(Icon::show('eye'), $url, [
                                'title' => Yii::t('app', 'Ver solicitud'),
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
            'header' => '<h3>Gestión de solicitud</h3>',
            ]);
        echo "<div></div>";
        Modal::end();
    ?>
</div>
