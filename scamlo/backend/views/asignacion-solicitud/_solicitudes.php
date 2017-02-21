<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Solicitud;
use backend\models\search\SolicitudSearch;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\bootstrap\Modal;

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
                           /* 'crear' => function ($url, $model, $key) {
                            return Html::a(Icon::show('male'), '#', [
                                'id' => 'activity-index-link',
                                'title' => Yii::t('app', 'asignar trabajador'),
                                'class'=>'btn btn-danger btn-xs',
                                'data-toggle' => 'modal',
                                'data-target' => '#modal',
                                'data-url' => Url::to(['crear', 'id' => $model->id]),
                                'data-pjax' => '0',
                                ]);
                },*/

                        'crear' => function ($url, $model){
                            return Html::a(Icon::show('male'), $url, [
                                'title' => Yii::t('app', 'asignar trabajador'),
                                'class'=>'btn btn-danger btn-xs',
                                ]);
                        },
                ], 
            ],
        ],
    ]); 
?>  
 <?php Pjax::end(); ?>

 <?php
   /* Modal::begin([
        'id' => 'modal',
        'size' => 'modal-md',
        'header' => '<h3>Asignar trabajadores</h3>',
        ]);

    echo "<div></div>";

    Modal::end();*/
?>
</div>