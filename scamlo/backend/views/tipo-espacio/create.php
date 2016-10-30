<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TipoEspacio */

$this->title = 'Nuevo Tipo de Espacio';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Espacios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-espacio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
