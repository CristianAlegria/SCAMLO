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
<div class="asignacion-solicitud-form-modificar">
       
     <?php $form = ActiveForm::begin([
        'id' => 'asignacion-solicitud-form-modificar',
        'enableAjaxValidation' => true,
        'enableClientScript' => true,
        'enableClientValidation' => true,
        ]); ?>
   

    <?php $time = time();?>

    <?php date_default_timezone_set('America/Bogota');  ?>    
     
    <?php $fecha = date('Y-m-d (H:i:s)', $time);?>


    <?= $form->field($model, 'estado_id')->dropDownList($model->estadoList,[ 'prompt' => 'Elige el nuevo Estado de su tarea']);?>

    <?= $form->field($model, 'fecha_hora_fin')->hiddenInput (['value'=>$fecha])->label(false);?>   

    <?= $form->field($model, 'equipo_reparado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_inventario')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textArea(['rows' => 4])?> 
    
    

    <div class="form-group">
        <p>
            <?= Html::submitButton($model->isNewRecord ? Icon::show('floppy-o').'Guardar' : Icon::show('pencil').'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::button(Icon::show('times-circle-o ').'Salir', ['class' => 'btn btn-default', 'id' => 'salir',]) ?>
        </p>
    </div>

    <?php ActiveForm::end(); ?>

</div>
