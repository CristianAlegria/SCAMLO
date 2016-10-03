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
   <h2 id="header">
      Universidad del Valle <br>
      <small>Sede - Yumbo</small>
   </h2>
</div>

<div class="wrap">

    <?php

    $es_administrador = ValueHelpers::getRoleValue('Administrador'); 

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
            <p class="pull-left"><?=Html::img('@web/images/logoUnivalle.jpg')?> Universidad del Valle <?= date('Y') ?></p>

            <p class="pull-right"><br> &copy; Derechos reservados por el equipo de desarrollo "SCAMLO" </p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>