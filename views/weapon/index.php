<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Weapon */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Weapons';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="weapon-wrapper">
    <?= HTML::a('+ Add a new weapon', ['weapon/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/weapon/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>