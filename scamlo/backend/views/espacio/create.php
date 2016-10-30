<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Espacio */

$this->title = 'Nuevo espacio';
$this->params['breadcrumbs'][] = ['label' => 'Espacios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="espacio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
