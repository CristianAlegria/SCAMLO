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

   <div class="asignacion-solicitud-trabajadores-form">
    <div class="form-group" id="primero">

<!--<hr/> Se encarga de hacer las lineas punteadas  --------------------   -->

    <h4>Tabla de trabajadores</h4>

<hr/>

    <?php Pjax::begin(); ?> 

    <?= $this->render('view-trabajadores', ['model' => $searchModel]); ?>

    <?php Pjax::end(); ?>

    <p id="mensaje-solicitudes"></p>
   
</div>
   
    <?php $form = ActiveForm::begin(); ?>
   

    <?= $form->field($model, 'estado_id')->hiddenInput (['value'=> 3])->label(false); //textInput('hidden'=>true) ?>

    <?php $time = time();?>

    <?php date_default_timezone_set('America/Bogota');  ?>    
     
    <?php $fecha = date('Y-m-d (H:i:s)', $time);?>

    <?= $form->field($model, 'fecha_hora_inicio')->hiddenInput (['value'=>$fecha])->label(false);?>           

    <?= $form->field($model, 'fecha_hora_fin')->hiddenInput (['value'=>''])->label(false);?>    

    <?= $form->field($model, 'equipo_reparado')->hiddenInput(['value'=>''])->label(false);?> 

    <?= $form->field($model, 'numero_inventario')->hiddenInput(['value'=>''])->label(false);?> 

    <?= $form->field($model, 'observaciones')->hiddenInput(['value'=>''])->label(false);?>      

    

    <?= $form->field($model, 'usuario_id')->dropDownList($model->userList,[ 'prompt' => 'Elige Trabajador']);?>
    <!--<?//= $form->field($model, 'usuario_id')->textInput() ?> -->

    <?= $form->field($model, 'solicitud_id')->dropDownList($model->solicitudList,[ 'prompt' => 'Elige Solicitud']);?>

    <!--<?//= $form->field($model, 'solicitud_id')->textInput() ?> -->
    <!--<?//= $form->field($model, 'solicitud_id')->textInput(['readonly' => true]) ?>-->

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
