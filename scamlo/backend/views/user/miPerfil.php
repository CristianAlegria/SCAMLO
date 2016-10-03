<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('app', 'Mi Perfil');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'id' => 'perfil',
        'model' => $model,
        'options' => [
            'class' => 'table table-striped table-bordered detail-view',
        ],
        'attributes' => [
            'nombre_completo',
            'cedula',
            'telefono',
            'email:email',
            'statusName',     
            'created_at',
            'updated_at',
            [
            'attribute'=>'password_hash',
            'format'=>'raw',
            'value'=> Html::a(Yii::t('app', Icon::show('unlock-alt').'Cambiar contraseña'), '#', [
                        'id' => 'activity-index-link',
                        'class' => 'btn btn-primary',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['cambiar-clave']),
                        'data-pjax' => '0',
                        ]),
            ],
        ],
    ]) ?>

    <?php
        Modal::begin([
            'id' => 'modal',
            'size' => 'modal-md',
            'header' => '<h3>Gestión de usuarios</h3>',
            ]);

        echo "<div></div>";

        Modal::end();
    ?>

</div>