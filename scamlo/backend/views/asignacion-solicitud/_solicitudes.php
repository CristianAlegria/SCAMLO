<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Solicitud;
use backend\models\search\SolicitudSearch;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\search\EspacioSearch */
/* @var $form yii\widgets\ActiveForm */
$searchModel = new SolicitudSearch();
$dataProvider = $searchModel->searchParaAsignacionTrabajadores(Yii::$app->request->queryParams);
?>
<div class="solicitudes-search">
    
<?= GridView::widget([
        'id' => 'solicitud-grid',
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'fecha',
            'nombreUser',                       
          //  'nombreServicio',            
            //'nombreEdificio',
            //'numero_piso',         
            //'nombreEspacio',
           // 'codigoEspacio',
          //  'descripcion_otros',              
            'nombreEstado', 
            [
            'attribute' => 'description',
            'value' => 'description',
            ],
           /* [
            'class' => 'yii\grid\CheckboxColumn',
            // you may configure additional properties here
                //'visible' => false,
                'header' => 'Selección',
                'multiple'=> false,
                'checkboxOptions' => function ($model, $key, $index, $column) {
                return ['value' => $model->id,
                'title' => Yii::t('app', 'Selecciona un espacio'),];
                }
            ],*/
            /*['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
                //'visible' => false,
                'header' => 'Asignar trabajadores',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(Icon::show('eye').'Ver', '#', [
                            'id' => 'activity-index-link',
                            'title' => Yii::t('app', 'Ver Trabajadores'),
                            'class'=>'btn btn-danger btn-xs',
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'data-url' => Url::to(['disponibilidad', 'id' => $model->id]),
                            'data-pjax' => '0',
                        ]);
                    },                    
                ],
            ],*/
        ],
    ]); 
?>  
</div>