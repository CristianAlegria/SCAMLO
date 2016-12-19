<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Espacio */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Espacios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->espacio_id, 'url' => ['view', 'id' => $model->espacio_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="espacio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
