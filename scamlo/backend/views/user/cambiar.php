<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Cambiar contraseña';
$this->params['breadcrumbs'][] = ['label' => 'Mi Perfil', 'url' => ['mi-perfil']];
$this->params['breadcrumbs'][] = 'Cambiar contraseña';
?>
<div class="user-cambiar-clave">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_clave', [
        'model' => $model,
    ]) ?>

</div>