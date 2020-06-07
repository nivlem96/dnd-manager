<?php
/* @var $this View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

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
	<title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	<script
			src="https://code.jquery.com/jquery-3.5.1.slim.js"
			integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM="
			crossorigin="anonymous"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $items = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $items[] = ['label' => 'Register', 'url' => ['/user/register']];
        $items[] = ['label' => 'Login', 'url' => ['/user/login']];
    } else {
        $items[] = [
            'label' => 'Info',
            'items' => [
                ['label' => 'Races', 'url' => ['/race']],
                ['label' => 'Classes', 'url' => ['/character-class']],
                ['label' => 'Feats', 'url' => ['/feat']],
                ['label' => 'Spells', 'url' => ['/spell']],
                ['label' => 'Items', 'url' => ['/item']],
                ['label' => 'Weapons', 'url' => ['/weapon']],
                ['label' => 'Armor', 'url' => ['/armor']],
                ['label' => 'Skills', 'url' => ['/skill']],
                ['label' => 'Ammunitions', 'url' => ['/ammunition']],
                ['label' => 'Backgrouns', 'url' => ['/background']],
            ],
        ];
        $items[] = [
            'label' => Yii::$app->user->identity->username,
            'items' => [
                ['label' => 'Profile', 'url' => ['/user/home']],
                ['label' => 'Campaigns(' . count(Yii::$app->user->identity->campaigns) . ')', 'url' => ['/campaign']],
                ['label' => 'Characters(' . count(Yii::$app->user->identity->characters) . ')', 'url' => ['/character']],
            ],
        ];
        $items[] = '<li>'
            . Html::beginForm(['/user/logout'], 'post')
            . Html::submitButton(
                'Logout',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

	<div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; My Company <?= date('Y') ?></p>

		<p class="pull-right"><?= Yii::powered() ?></p>
	</div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
