<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Dependencia */

$this->title = 'Nueva Dependencia';
$this->params['breadcrumbs'][] = ['label' => 'Dependencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
