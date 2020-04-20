<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Ammunition */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Ammunitions';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="ammunition-wrapper">
    <?= HTML::a('+ Add a new ammunition', ['ammunition/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/ammunition/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>