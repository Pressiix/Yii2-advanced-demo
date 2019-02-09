<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
//use common\assets\FontawesomeAsset;
use common\widgets\Alert;
AppAsset::register($this);
//FontawesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode(/*$this->title*/'Demo') ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" style="background-color: #ededf2;">
    <?php
    NavBar::begin([
        //'brandLabel' => Html::img('https://wiki.videolan.org/images/Ubuntu-logo.png', ['alt'=>'Demo', 'class' => '','style' => 'padding: 0px;  height: 100%;']),
        'brandLabel' => 'Demo',
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'container-fluid'],    // full screen Navigation bar
        'options' => [
            'class' => 'navbar-red navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => '<span class="glyphicon glyphicon-home"></span> Home', 'url' => ['/site/index']],
        ['label' => '<span class="glyphicon glyphicon-info-sign"></span> About', 'url' => ['/site/about']],
        ['label' => '<span class="glyphicon glyphicon-envelope"></span> Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems = [
            ['label' => '<span class="glyphicon glyphicon-home"></span> Home', 'url' => ['/site/index']],
            ['label' => '<span class="glyphicon glyphicon-info-sign"></span> About', 'url' => ['/site/about']],
            ['label' => '<span class="glyphicon glyphicon-envelope"></span> Contact', 'url' => ['/site/contact']],
            [
                'label' => 'Example',
                'items' => [
                     ['label' => 'Input Form', 'url' => ['/example/example-form']],
                     ['label' => 'Chart.js', 'url' => ['/example/example-chart']],
                     ['label' => 'DataTable', 'url' => '#'],
                ],
            ],
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
        'encodeLabels' => false,
    ]);
    NavBar::end();

    ?>

    <div class="container-fluid" style="padding-top: 70px; width:99%;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
    <div class="col-md-12">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    </div>
</div>

<footer class="footer">
        <div class=" hidden-xs text-center">
        <strong>Copyright &copy;  <a href="https://www.facebook.com/pressiiz">Watcharaphon Piamphuetna</a>.</strong> All rights reserved.
        </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
