<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\icons\Icon;
?>

<div class="user-cambiar-clave">

	<?php $form = ActiveForm::begin([
        'id' => 'user-cambiar-clave',
        'enableAjaxValidation' => true,
        'enableClientScript' => true,
        'enableClientValidation' => true,
        ]); ?>
	
	<div class="form-group">
	<?= $form->field($model, 'passwordActual')->passwordInput() ?>

	<p id="mensaje-clave"></p>
	</div>

	<?= $form->field($model, 'passwordNueva')->passwordInput() ?>

	<?= $form->field($model, 'passwordConfirmada')->passwordInput() ?>

	<div class="form-group">
	    <p>
		<?= Html::submitButton($model->isNewRecord ? Icon::show('floppy-o').'Guardar' : Icon::show('unlock-alt').'Cambiar contraseña', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => $model->isNewRecord ? 'guardar' : 'actualizar-clave']) ?>
		<?= Html::button(Icon::show('times-circle-o ').'Salir', ['class' => 'btn btn-default', 'id' => 'salir',]) ?>
		</p>
	</div>

</div>

<?php ActiveForm::end(); ?>