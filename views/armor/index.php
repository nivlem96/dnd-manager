<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Armor */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Armors';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="armor-wrapper">
    <?= HTML::a('+ Add a new armor', ['armor/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/armor/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>