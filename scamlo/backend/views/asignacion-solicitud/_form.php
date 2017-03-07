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

<div class="asignacion-solicitud-form">
    <div class="form-group" id="primero">

        <hr/>
            <h4>Asigne los trabajadores a cada solicitud con la opcion "asignar trabajador" de la columna trabajadores.</h4>
        <hr/>       
   </div>  
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $this->render('_solicitudes'); ?>

    <?= $form->field($model, 'estado_id')->hiddenInput (['value'=> 3])->label(false); //textInput('hidden'=>true) ?>

    <?php $time = time();?>

    <?php date_default_timezone_set('America/Bogota');  ?>    
     
    <?php $fecha = date('Y-m-d (H:i:s)', $time);?>

    <?= $form->field($model, 'fecha_hora_inicio')->hiddenInput (['value'=>$fecha])->label(false);?>           

    <?= $form->field($model, 'fecha_hora_fin')->hiddenInput (['value'=>''])->label(false);?>    

    <?= $form->field($model, 'equipo_reparado')->hiddenInput(['value'=>''])->label(false);?> 

    <?= $form->field($model, 'numero_inventario')->hiddenInput(['value'=>''])->label(false);?> 

    <?= $form->field($model, 'observaciones')->hiddenInput(['value'=>''])->label(false);?> 
    

    <!-- <?= $form->field($model, 'usuario_id')->dropDownList($model->userList,[ 'prompt' => 'Elige Trabajador']);?>-->

    <!--<?//= $form->field($model, 'usuario_id')->textInput() ?> -->

    <!--  <?= $form->field($model, 'solicitud_id')->dropDownList($model->solicitudList,[ 'prompt' => 'Elige Solicitud']);?>    -->   

    <!--  <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Icon::show('floppy-o').'Guardar Asignación' : Icon::show('pencil').'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'guardar-reserva']) ?>
    </div>  -->

    <?php ActiveForm::end(); ?>    

</div>
