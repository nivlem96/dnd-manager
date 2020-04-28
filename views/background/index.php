<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Background */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Backgrounds';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="background-wrapper">
    <?= HTML::a('+ Add a new background', ['background/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/background/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>