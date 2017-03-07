<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use backend\models\search\UserSearch;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\search\EspacioSearch */
/* @var $form yii\widgets\ActiveForm */
$searchModel = new UserSearch();
$dataProvider = $searchModel->searchParaAsignacionTrabajadores_tablaTrabajadores(Yii::$app->request->queryParams);

?>
<div class="solicitud-view-trabajores">
    
<?= GridView::widget([
        'id' => 'solicitud_trabajador-grid',
        'dataProvider' => $dataProvider,
        'columns' => [
            //'id',
            'nombre_completo',                       
            [
            'attribute' => 'email',
            'value' => 'email',
            ], 
            [
            'class' => 'yii\grid\CheckboxColumn',
            // you may configure additional properties here
               // 'visible' => true,
                'header' => 'Selección',
                //'multiple'=> false,
                'checkboxOptions' => function ($model, $key, $index, $column) {
                return ['value' => $model->id,
                'title' => Yii::t('app', 'Selecciona trabajador'),];
                }
            ],          

        ],
    ]); 
?>  
</div>