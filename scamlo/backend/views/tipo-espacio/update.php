<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TipoEspacio */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Espacios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo_espacio_id, 'url' => ['view', 'id' => $model->tipo_espacio_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tipo-espacio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
