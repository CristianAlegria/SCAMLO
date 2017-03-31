<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model backend\models\Edificio */

$this->title = $model->nombre_edificio;

$show_this_nav = PermissionHelpers::requireMinimumRole('Administrador');

$this->params['breadcrumbs'][] = ['label' => 'Edificios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edificio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if (!Yii::$app->user->isGuest && $show_this_nav) {

            echo Html::a( Icon::show('trash').'Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
            'confirm' => Yii::t('app', 'Seguro que quieres eliminar este edificio?'),
            'method' => 'post',
            ],

        ]);
        }
    ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'edificio_id',
            'nombre_edificio',
            'ubicacion',
        ],
    ]) ?>

</div>
