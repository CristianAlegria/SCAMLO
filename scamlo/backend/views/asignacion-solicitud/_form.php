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

    <h4>Selecciona la solicitud y presiona el boton ver para seleccionar los trabajadores</h4>

<hr/>

    <?php Pjax::begin(); ?> 

    <?= $this->render('_solicitudes', ['model' => $searchModel]); ?>

    <?php Pjax::end(); ?>

    <p id="mensaje-solicitudes"></p>
   
</div>
    
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'asignacion_id')->textInput() ?>

    <?= $form->field($model, 'solicitud_id')->textInput() ?>

    <?= $form->field($model, 'estado_id')->textInput() ?> 

    <?= $form->field($model, 'usuario_id')->textInput() ?>

    <?= $form->field($model, 'fecha_hora_inicio')->textInput() ?>

    <?= $form->field($model, 'fecha_hora_fin')->textInput() ?>

    <?= $form->field($model, 'equipo_reparado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_inventario')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true]) ?> 

   <!-- <div class="form-group">
        <?//= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Icon::show('floppy-o').'Guardar Asignación' : Icon::show('pencil').'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'guardar-reserva']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php

        Modal::begin([
            'id' => 'modal',
            'size' => 'modal-lg',
            'header' => '<h3>Asignacion de trabajadores a Solicitud</h3>',
            ]);

        echo "<div></div>";

        Modal::end();
    ?>

</div>
