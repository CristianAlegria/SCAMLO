<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PermissionHelpers;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model backend\models\Solicitud */

$this->title = $model->description;
$show_this_nav = PermissionHelpers::requireMinimumRole('Administrativo');
$this->params['breadcrumbs'][] = ['label' => 'Mis solicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-view">

    <h1><?= Html::encode($this->title) ?></h1>

     <p>

    <?php if (!Yii::$app->user->isGuest && $show_this_nav) {

            echo Html::a( Icon::show('trash').'Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
            'confirm' => Yii::t('app', 'Seguro que quieres eliminar esta solicitud?'),
            'method' => 'post',
            ],
        ]);
        }
    ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombreUser',            
            'nombreDependencia',            
            'nombreServicio',
            'description',
            'nombreEdificio',
            //'numero_piso', NOTA: SE QUITO PORQUE EL NUMERO DEL PISO ME LO DA EL PRIMER 
            //               DIGITO  DEL CODIGO DE ESPACIO      
            'nombreEspacio',
            'codigoEspacio',
            'descripcion_otros',          
            'fecha',            
            'nombreEstado',         
            'descripcion_estado',
        ],
    ]) ?>

</div>
