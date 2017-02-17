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
<?php Pjax::begin(); 
      ['id' => 'samle', 'linkSelector' => 'a:not(.linksWithTarget)']
?> 
    
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
           ['class' => 'yii\grid\ActionColumn',
                'template' => '{crear}', /*&nbsp{view}',*/
                'header' => 'Trabajadores',
                'buttons' => [
                           'crear' => function ($url, $model, $key) {
                            return Html::a(Icon::show('male'),$url, [
                                'id' => 'activity-index-link',
                                'title' => Yii::t('app', 'asignar trabajador'),
                                'class'=>'btn btn-danger btn-xs',                                
                                ]);
                        },
                        /*'view' => function ($url, $model){
                            return Html::a(Icon::show('eye'), $url, [
                                'title' => Yii::t('app', 'Ver asignación'),
                                'class'=>'btn btn-danger btn-xs',
                                ]);
                        },*/
                ], 

            ],
        ],
    ]); 
?>  
 <?php Pjax::end(); ?>
</div>