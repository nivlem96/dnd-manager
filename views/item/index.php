<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Item */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Items';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="item-wrapper">
    <?= HTML::a('+ Add a new item', ['item/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/item/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>