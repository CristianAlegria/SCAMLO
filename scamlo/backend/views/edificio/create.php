<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Edificio */

$this->title = 'Nuevo Edificio';
$this->params['breadcrumbs'][] = ['label' => 'Edificios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edificio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [    	
        'model' => $model,
    ]) ?>

</div>
