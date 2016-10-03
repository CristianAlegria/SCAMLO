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
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;

$show_this_nav = PermissionHelpers::requireMinimumRole('Auxiliar');
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Icon::show('plus').'Nuevo usuario', '#', [
            'id' => 'activity-index-link',
            'class' => 'btn btn-success',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'data-url' => Url::to(['create']),
            'data-pjax' => '0',
        ]); ?>

        <?php if (!Yii::$app->user->isGuest && $show_this_nav) {  

        echo Html::a( Icon::show('upload').'Cargar archivo de usuarios', '#', [
            'id' => 'activity-index-link',
            'class' => 'btn btn-primary',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'data-url' => Url::to(['upload']),
            'data-pjax' => '0',
        ]);

        }?>  
    </p>      

<?php Pjax::begin(); ?>    

    <?= GridView::widget([
        'id' => 'user-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre_completo',
            'cedula',
            'telefono',
            //'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            //'role_id',
            [
            'attribute' => 'role_id',
            'value' => 'role.role_name',
            'filter' => Html::activeDropDownList($searchModel, 'role_id', ArrayHelper::map(Role::find()->asArray()->all(), 'role_name', 'role_name'), ['class' => 'form-control', 'prompt' => '']),
            ],
            [
            'attribute' => 'estatus_id',
            'value' => 'status.status_name',
            'filter' => Html::activeDropDownList($searchModel, 'status_id', ArrayHelper::map(Status::find()->asArray()->all(), 'status_name', 'status_name'), ['class' => 'form-control', 'prompt' => '']),
            ],
            // 'status_id',
            // 'created_at',
            // 'updated_at',

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
                        'title' => Yii::t('app', 'Actualizar usuario'),
                        'class'=>'btn btn-danger btn-xs',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['update', 'id' => $model->id]),
                        'data-pjax' => '0',
                        ]);
                },

                'view' => function ($url, $model){
                            return Html::a(Icon::show('eye'), $url, [
                                'title' => Yii::t('app', 'Ver usuario'),
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
            'header' => '<h3>Gestión de usuarios</h3>',
            ]);

        echo "<div></div>";

        Modal::end();
    ?>

</div>



