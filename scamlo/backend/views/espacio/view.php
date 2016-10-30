<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model backend\models\Espacio */

$this->title = $model->nombre." ".$model->codigo;

$show_this_nav = PermissionHelpers::requireMinimumRole('Administrador');

$this->params['breadcrumbs'][] = ['label' => 'Espacios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="espacio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if (!Yii::$app->user->isGuest && $show_this_nav) {

            echo Html::a( Icon::show('trash').'Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
            'confirm' => Yii::t('app', 'Seguro que quieres eliminar este espacio?'),
            'method' => 'post',
            ],

        ]);
        }
    ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'espacio_id',
            'nombre',
            'codigo',
            'capacidad',
            'ubicacion',
            'nombreEdificio',        
        ],
    ]) ?>

</div>
