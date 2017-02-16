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
<div class="solicitud-view-trabajores-search">
    
<?= GridView::widget([
        'id' => 'solicitud_trabajador-grid',
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nombre_completo',
            'cedula', 
            'telefono',                    
            [
            'attribute' => 'email',
            'value' => 'email',
            ],           

        ],
    ]); 
?>  
</div>