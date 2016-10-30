<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model backend\models\Edificio */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="edificio-form">

    <?php $form = ActiveForm::begin([
        'id' => 'edificio-form',
        'enableAjaxValidation' => true,
        'enableClientScript' => true,
        'enableClientValidation' => true,
        ]); ?>

    <?= $form->field($model, 'nombre_edificio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ubicacion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <p>
            <?= Html::submitButton($model->isNewRecord ? Icon::show('floppy-o').'Guardar' : Icon::show('pencil').'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::button(Icon::show('times-circle-o ').'Salir', ['class' => 'btn btn-default', 'id' => 'salir',]) ?>
        </p>
    </div>

    <?php ActiveForm::end(); ?>

</div>
