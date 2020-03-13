<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Spell */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Spells';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="spell-wrapper">
    <?= HTML::a('+ Add a new spell', ['spell/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/spell/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>