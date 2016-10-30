<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model backend\models\Espacio */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="espacio-form">

    <?php $form = ActiveForm::begin([
        'id' => 'espacio-form',
        'enableAjaxValidation' => true,
        'enableClientScript' => true,
        'enableClientValidation' => true,
        ]); ?>

    <?= $form->field($model, 'edificio_id')->dropDownList($model->edificioList,[ 'prompt' => 'Si el epacio pertenece a un edificio elige uno' ]);?>

    <?= $form->field($model, 'nombre')->dropDownList($model->tipoEspacioList,[ 'prompt' => 'Por favor elige uno' ]);?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capacidad')->textInput() ?>

    <?= $form->field($model, 'ubicacion')->textInput(['maxlength' => true])->textInput(['placeholder' => "La ubicación es opcional"])?>

    <div class="form-group">
        <p>
            <?= Html::submitButton($model->isNewRecord ? Icon::show('floppy-o').'Guardar' : Icon::show('pencil').'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::button(Icon::show('times-circle-o ').'Salir', ['class' => 'btn btn-default', 'id' => 'salir',]) ?>
        </p>
    </div>

    <?php ActiveForm::end(); ?>

</div>
