<?php
   use yii\bootstrap\ActiveForm;
   use yii\helpers\Html;
   use kartik\file\FileInput;
   use kartik\icons\Icon;

$this->title = 'Cargar usuarios';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-upload">

   <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'id' => 'user-upload',]) ?>

      <h1><?= Html::encode($this->title) ?></h1>

      <p>Indique el archivo del personal de Mantenimiento y Logística o del área administrativa que desea cargar</p>

      <?= $form->field($model,'excelFile')->widget(FileInput::classname(), ['options' => ['multiple' => true]]) ?> 
      

      <? // nota : como saber que boton piso el usuario segun el caso: docentes o administrativos?
      ?>

    <?php ActiveForm::end() ?>

</div>

 