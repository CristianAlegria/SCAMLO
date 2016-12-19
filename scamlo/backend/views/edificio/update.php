<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Edificio */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Edificios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->edificio_id, 'url' => ['view', 'id' => $model->edificio_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="edificio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
