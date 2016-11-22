<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\PermissionHelpers;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\icons\Icon;
use backend\models\Status;
use backend\models\Role;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\DependenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dependencias';
$this->params['breadcrumbs'][] = $this->title;
$show_this_nav = PermissionHelpers::requireMinimumRole('Auxiliar');
?>
<div class="dependencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
       <?= Html::a( Icon::show('plus').'Nueva dependencia', '#', [
            'id' => 'activity-index-link',
            'class' => 'btn btn-success',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'data-url' => Url::to(['create']),
            'data-pjax' => '0',
        ]); ?>
    </p>
    <?php Pjax::begin(); ?>  
    <?= GridView::widget([
        'id' => 'dependencia-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre_dependencia',
            ['class' => 'yii\grid\ActionColumn',
               'visibleButtons' => [

                    'view' => (PermissionHelpers::requireMinimumRole('Administrador')
                                && PermissionHelpers::requireStatus('Activo')),

                    'update' => (PermissionHelpers::requireRole('Administrador')
                                && PermissionHelpers::requireStatus('Activo')),
                ],
            'template' => '{view} {update}',
                'header' => 'Opciones',
                'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a(Icon::show('pencil'), '#', [
                        'id' => 'activity-index-link',
                        'title' => Yii::t('app', 'Actualizar dependencia'),
                        'class'=>'btn btn-danger btn-xs',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['update', 'id' => $model->id]),
                        'data-pjax' => '0',
                        ]);
                },

                'view' => function ($url, $model){
                            return Html::a(Icon::show('eye'), $url, [
                                'title' => Yii::t('app', 'Ver dependencia'),
                                'class'=>'btn btn-danger btn-xs',
                                ]);
                        },
                ], 
            ],
        ],

    ]); ?>

    <?php Pjax::end(); ?>

     <?php
        Modal::begin([
            'id' => 'modal',
            'size' => 'modal-md',
            'header' => '<h3>Gestión dependencias</h3>',
            ]);

        echo "<div></div>";

        Modal::end();
    ?>

</div>
