<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\icons\Icon;


/* @var $this yii\web\View */
/* @var $model backend\models\Solicitud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitud-form">

    <?php $form = ActiveForm::begin([
        'id' => 'solicitud-form',
        'enableAjaxValidation' => true,
        'enableClientScript' => true,
        'enableClientValidation' => true,
        ]); ?> 

    <?= $form->field($model, 'dependencia_id')->dropDownList($model->dependenciaList,[ 'prompt' => 'Elige la Dependencia a la que perteneces']);?>

    <?= $form->field($model, 'servicio_id')->dropDownList($model->ServicioList,[ 'prompt' => 'Elige el servicio que deseas' ]);?>

    <?= $form->field($model, 'description')->textArea(['rows' => 4]) ?>   

    <?= $form->field($model, 'espacio_id')->dropDownList($model->EspacioList,[ 'prompt' => 'Elige el espacio' ]);?>

    <?= $form->field($model, 'descripcion_otros')->textArea(['rows' => 3,'placeholder' => "descripción de otro espacio es opcional"])?>
    

    <!-- ***********************************************************************************
    'numero_piso', NOTA: SE QUITO PORQUE EL NUMERO DEL PISO ME LO DA EL PRIMER 
            //               DIGITO  DEL CODIGO DE ESPACIO  -->
    <!--<?= $form->field($model, 'numero_piso')->hiddenInput (['value'=>0])->label(false);?>

    ****************************************************************************************-->

    <?php $fecha = date('Y-m-d');?>
    <?= $form->field($model, 'fecha')->hiddenInput (['value'=>$fecha])->label(false); //textInput('hidden'=>true) ?>  
  
    <?= $form->field($model, 'estado_id')->hiddenInput (['value'=> 2])->label(false); //textInput('hidden'=>true) ?>
    

     <div class="form-group">
        <p>
            <?= Html::submitButton($model->isNewRecord ? Icon::show('floppy-o').'Guardar' : Icon::show('pencil').'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::button(Icon::show('times-circle-o ').'Salir', ['class' => 'btn btn-default', 'id' => 'salir',]) ?>
        </p>
    </div>

    <?php ActiveForm::end(); ?>

</div>
