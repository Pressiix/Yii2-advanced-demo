<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;   //#295cad
$this->registerCss("
    .navbar-pink{
        background-color: #4571b7;
        border-color: #4571b7;   
    }
    .navbar-pink .navbar-brand{color:white}

    .navbar-pink .navbar-nav > li > a:hover, .navbar-pink .navbar-nav > li > a:focus {
        background-color: #295cad;
        color: #white;
    }

    .navbar-pink .navbar-nav>.active>a,.navbar-pink 
    .navbar-nav>.active>a:focus,.navbar-pink .navbar-nav>
    .active>a:hover{
        color:#fff;
        background-color:#295cad;
    }

    .navbar-pink .navbar-nav>li>a{color:white}

    .navbar-pink .navbar-nav>.open>a,.navbar-pink .navbar-nav>.open>a:focus,
    .navbar-pink .navbar-nav>.open>a:hover{
        color:#fff;background-color:#295cad;
    }

    .dropdown-menu > li > a:hover {
        background-color: #295cad;
        color:white;
        background-image: none;
    }
    
    .btn-link.logout {
        color:white;
    }
    .btn-link.logout:hover{
        background-color:#295cad;
        text-decoration:none
    }

    .panel-pink{
        border-color:#ddd
    }
    .panel-pink>.panel-heading{
        color:white;
        background-color:#6185bf;
        border-color:#ddd
    }
    .panel-pink>.panel-heading+.panel-collapse>.panel-body{
        border-top-color:#ddd
    }
    .panel-pink>.panel-heading .badge{
        color:#f5f5f5;
        background-color:#333
    }
    .panel-pink>.panel-footer+.panel-collapse>.panel-body{
        border-bottom-color:#ddd
    }
");
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode(/*$this->title*/'Admin Panel') ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => /*Yii::$app->name*/'Admin Panel',
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'container-fluid'],    // full screen Navigation bar
        'options' => [
            'class' => 'navbar-pink navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
       
    ];
    if (Yii::$app->user->isGuest) {     //if user not loged in
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Gii', 'url' => ['/gii'],'linkOptions' => ['target'=>'_blank']],
            /*[
                'label' => 'Master Data',
                'items' => [
                     ['label' => 'Product data', 'url' => ['/product/index']],
                     ['label' => 'Product types', 'url' => ['/product-type/index']],
                ],
            ],*/
            ['label' => 'Users', 'url' => ['/user/index']],
        ];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid" style="padding-top: 70px; width:99%;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
