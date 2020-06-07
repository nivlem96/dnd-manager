<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Choice */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Choices';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="choice-wrapper">
    <?= HTML::a('+ Add a new choice', ['choice/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/choice/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>