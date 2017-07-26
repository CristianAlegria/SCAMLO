<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use backend\models\Estado;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\date\DatePicker;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AsignacionSolicitudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ver tareas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignacion-solicitud-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a( Icon::show('plus').'Asignar tareas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <div class="form-group" id="reporte">
            <hr>
              <h4>
                 <label>Generar reporte</label>  
              </h4>
              
               <table>
                   <tr>
                       <td><label>De:</label></td>
                       <td>
                          <?php // usage without model
                          
                            echo DatePicker::widget([
                            	'name' => 'check_issue_date_De', 
                            	 'value' => date('Y-M-d'),
                            	//'value' => date('Y-M-d', strtotime('+2 days')),
                            	'options' => ['placeholder' => 'Seleccione fecha...'],
                            	'pluginOptions' => [
                            	    'format' => 'yyyy-MM-dd',
                            	    'autoclose'=>true,
                            		'todayHighlight' => true
                            	]
                            ]);
                           
                          ?>
                        </td>
                       <td><label>Hasta:<?php echo ['check_issue_date_De']['value']  ?></label></td>
                       <td>
                           <?php // usage without model
                                echo DatePicker::widget([
                                	'name' => 'check_issue_date_hasta', 
                                	'value' => date('Y-M-d', strtotime('+2 days')),
                                	'options' => ['placeholder' => 'Seleccione fecha ...'],
                                	'pluginOptions' => [
                                		'format' => 'yyyy-MM-dd',
                                		'autoclose'=>true,
                                		'todayHighlight' => true
                                	]
                                ]);
                                
                            ?>  
                        </td>
                       
                        <td>
                            <?php
                                echo Html::a(Icon::show('file-pdf-o').'Generar  PDF', ['/asignacion-solicitud/report'], [
                                    'class'=>'btn btn-danger linksWithTarget', 
                                    'target'=>'_blank', 
                                    
                                 ]);
                            ?>
                        </td>
                   </tr>
               </table>
           </hr>
           <hr>
           </hr>
       </div>
    </p>
    
    
    <?php Pjax::begin(
        ['id' => 'samle', 'linkSelector' => 'a:not(.linksWithTarget)']
       );
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
            'filter' => Html::activeDropDownList($searchModel, 'estado_id', ArrayHelper::map(Estado::find()->asArray()->all(), 'id', 'nombre'), ['class' => 'form-control', 'prompt' => '']),/* 'id', 'nombre'-> son las columnas como se llaman en la base de datos*/
            ],  

           ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'header' => 'Opciones',
                'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a(Icon::show('pencil'), '#', [
                        'id' => 'activity-index-link',
                        'title' => Yii::t('app', 'Actualizar asignación'),
                        'class'=>'btn btn-danger btn-xs',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['update', 'id' => $model->id,'solicitud_id' => $model->solicitud_id,'iniciaSesionTrabajador' => false]),
                        'data-pjax' => '0',
                        ]);
                },
                'view' => function ($url, $model){
                            return Html::a(Icon::show('eye'), Url::to(['view', 'id' => $model->id,'iniciaSesionTrabajador' => false]), [
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
