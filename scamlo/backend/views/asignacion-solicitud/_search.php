<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\AsignacionSolicitudSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asignacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'asignacion_id') ?>

    <?= $form->field($model, 'solicitud_id') ?>

    <?= $form->field($model, 'estado_id') ?>

    <?= $form->field($model, 'usuario_id') ?>

    <?= $form->field($model, 'fecha_hora_inicio') ?>

    <?php // echo $form->field($model, 'fecha_hora_fin') ?>

    <?php // echo $form->field($model, 'equipo_reparado') ?>

    <?php // echo $form->field($model, 'numero_inventario') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
