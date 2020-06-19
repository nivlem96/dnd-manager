<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Tools */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Tools';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="tools-wrapper">
    <?= HTML::a('+ Add a new tools', ['tools/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/tools/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>