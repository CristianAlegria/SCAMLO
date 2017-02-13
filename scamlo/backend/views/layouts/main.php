
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\ValueHelpers;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\widgets\Pjax;
use conquer\momentjs\MomentjsAsset;

AppAsset::register($this);
Icon::map($this);//Impotante tambien para que muestre el icono
MomentjsAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class = "header">
   <p class="pull-left"><?=Html::img('@web/images/logo.jpg')?></p>  
   <br> 
   <p class="pull-right"><?=Html::img('@web/images/icono-mantenimiento.png')?></i></p> 
   <h2 id="header">
    <small><br></br></small>

      <!--Universidad del Valle <br>
      <small>Sede - Yumbo</small> -->     
   </h2>
</div>


<div class="wrap">    
    <?php

    $es_administrador = ValueHelpers::getRoleValue('Administrador');      
    $es_administrativo = ValueHelpers::getRoleValue('Administrativo'); 
    $es_mantenimientoLogistica = ValueHelpers::getRoleValue('MantenimientoLogistica');  
    $es_usuario = ValueHelpers::getRoleValue('Usuario');  

    NavBar::begin([
            'brandLabel' => Icon::show('home',['class'=>'fa-lg']).'Inicio',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
            'class' => 'navbar-fixed',],
    ]); 
    

    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == $es_administrador) {   
        
        $menuItems [] = ['label' => Icon::show('users', ['class'=>'fa-lg']).'Usuarios',
            'items' => [
                ['label' => 'Gestión de Usuarios', 'url' => ['/user/index']],  
            ],
        ]; 

         $menuItems [] = ['label' => Icon::show('life-ring', ['class'=>'fa-lg']).'Servicios',
            'items' => [
                ['label' => 'Gestión de Servicios', 'url' => ['/servicio/index']],  
            ],
        ];
        $menuItems [] = ['label' => Icon::show('building-o', ['class'=>'fa-lg']).'Espacios',  
            'items' => [
                ['label' => 'Edificios', 'url' => ['/edificio/index']],                
                ['label' => 'Tipos de Espacio', 'url' => ['/tipo-espacio/index']],
                ['label' => 'Gestión de Espacios', 'url' => ['/espacio/index']],                
            ],
        ]; 
        $menuItems [] = ['label' => Icon::show('address-card-o', ['class'=>'fa-lg']).'Dependencias',  
            'items' => [
                ['label' => 'Gestionar Dependencia', 'url' => ['/dependencia/index']],                
                               
            ],
        ]; 

        $menuItems [] = ['label' => Icon::show('list-alt', ['class'=>'fa-lg']).'Gestionar Solicitud de servicio',  
            'items' => [
                ['label' => 'Ver solicitudes', 'url' => ['/solicitud/index']],  
                ['label' => 'Ver tareas', 'url' => ['/asignacion-solicitud/index']],                           
            ],
        ];      
    }
    
    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == $es_administrativo) {
        
        $menuItems [] = ['label' => Icon::show('list-alt', ['class'=>'fa-lg']).'Gestionar Solicitud de servicio',  
            'items' => [
                ['label' => 'Mis solicitudes', 'url' => ['/solicitud/index']],                                 
            ],
        ];      
    }

    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == $es_mantenimientoLogistica) {
        
        $menuItems [] = ['label' => Icon::show('list-alt', ['class'=>'fa-lg']).'Gestionar mis tareas',  
            'items' => [                  
                ['label' => 'Ver mis tareas', 'url' => ['/asignacion-solicitud/index2']],                     
            ],
        ];      
    }
    

    if (Yii::$app->user->isGuest) {        
       
        $menuItems[] = ['label' => Icon::show('sign-in', ['class'=>'fa-lg']).'Ingresar', 'url' => ['/site/login']];

    } else {

        $menuItems [] = ['label' => Icon::show('user',['class'=>'fa-lg']).Yii::$app->user->identity->nombre_completo,
            'items' => [
                ['label' => Icon::show('power-off').'Cerrar sesión','url' => ['/site/logout']],
                ['label' => Icon::show('user').'Mi perfil','url' => ['/user/mi-perfil']], 
            ],
        ];        
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);

    NavBar::end();

    ?>


    <div class="container" id="main-content">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?php Pjax::begin(); ?> 
        <?= $content ?>
        <?php Pjax::end(); ?>
    
    </div>
</div>

<footer class="footer">   

    <div class="container">
        <div class="footer-logo">
            
           <ul class="list-inline">
                <li>
                   <p class="pull-left"><?=Html::img('@web/images/logoUnivalle-footer.png')?></i></p>
                </li>
                <li>
                    <p>UNIVERSIDAD DEL VALLE <br> Sede Yumbo</i></p>
                </li>
                <li>
                    <p >Dirección:<br>Calle 3N 2N-17 Barrio las vegas<br> Yumbo, Colombia</i></p>
                </li>
                <li>
                     <p>PBX: <br>+57 2 6699323</i></p>
                </li>                
                              
            </ul>            
        </div>
    </div> 
</footer>
<!--<footer class="footer2">  

    <div class="container">
        <div class="footer-logo">        
                              
                      
        </div>
    </div> 
</footer>-->
<footer class="footer3">  

    <div class="container">
        <div class="footer-logo">               
            <p align="center">Derechos reservados por: AlegriaSoft Corporation</i></p>                     
        </div>
    </div> 
</footer>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>