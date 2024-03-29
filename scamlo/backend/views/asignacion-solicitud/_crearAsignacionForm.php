<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\PermissionHelpers;
use yii\helpers\Url;
use kartik\icons\Icon;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;



/* @var $this yii\web\View */
/* @var $model backend\models\AsignacionSolicitud */
/* @var $form yii\widgets\ActiveForm */


?>

   <div class="asignacion-solicitud_crearAsignacionForm">
   

<!--<hr/> Se encarga de hacer las lineas punteadas  --------------------   -->   

    <hr/>

    <?php $form = ActiveForm::begin([
        'id' => 'asignacion-solicitud_crearAsignacionForm-form',
        'enableAjaxValidation' => true,
        'enableClientScript' => true,
        'enableClientValidation' => true,
        ]); ?>


    <!--<?= $this->render('view-trabajadores'); ?>-->
    

    <?php $time = time();?>
    <?php $solicitud_id = Yii::$app->request->get('id');?>
    <?php $estado_id = Yii::$app->request->get('estado_id');?>

    <?php date_default_timezone_set('America/Bogota');  ?>    
     
    <?php $fecha = date('Y-m-d (H:i:s)', $time);?>
    
    <?= $form->field($model, 'estado_id')->hiddenInput (['value'=> $estado_id])->label(false); //textInput('hidden'=>true) ?>

    <?= $form->field($model, 'fecha_hora_inicio')->hiddenInput (['value'=>$fecha])->label(false);?>           

    <?= $form->field($model, 'fecha_hora_fin')->hiddenInput (['value'=>''])->label(false);?>    

    <?= $form->field($model, 'equipo_reparado')->hiddenInput(['value'=>''])->label(false);?> 

    <?= $form->field($model, 'numero_inventario')->hiddenInput(['value'=>''])->label(false);?> 

    <?= $form->field($model, 'observaciones')->hiddenInput(['value'=>''])->label(false);?>      

     <!--  /* *-*-*-*-**-*-*-*-**-*-*-*-*-**-*-**-*-OJO. ESTE CODIGO FUNCIONA PARA ASIGNAR SOLO UN TRABAJADOR */ ?> -->
   
    <?= $form->field($model, 'usuario_id')->dropDownList($model->userList,[ 'prompt' => 'Elige Trabajador']);?>
    <?= $form->field($model, 'solicitud_id')->hiddenInput (['value'=>$solicitud_id])->label(false);?>   

    <!--<?//= $form->field($model, 'usuario_id')->textInput() ?> -->

    <!--<?= $form->field($model, 'solicitud_id')->dropDownList($model->solicitudList,[ 'prompt' => 'Elige Solicitud']);?>-->
     <!--  /* *-*-*-*-**-*-*-*-**-*-*-*-*-**-*-**-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*- */-->

    <!--<?//= $form->field($model, 'solicitud_id')->textInput() ?> -->
    <!--<?//= $form->field($model, 'solicitud_id')->textInput(['readonly' => true]) ?>-->

   <!-- <div class="form-group">
        <?//= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>-->

    <div class="form-group">
        <p>
            <?= Html::submitButton($model->isNewRecord ? Icon::show('floppy-o').'Guardar' : Icon::show('pencil').'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => $model->isNewRecord ? 'guardar' : 'actualizar']) ?>
            <?= Html::button(Icon::show('times-circle-o ').'Salir', ['class' => 'btn btn-default', 'id' => 'salir',]) ?>
        </p>
    </div>    

    <?php ActiveForm::end(); ?>

</div>
