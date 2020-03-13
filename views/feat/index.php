<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Feat */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Feats';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="race-wrapper">
    <?= HTML::a('+ Add a new race', ['race/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/feat/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'unlocked_at',
            ],
            [
                'attribute' => 'race_id',
	            'label' => 'Race',
                'value' => function ($model) {
                    return $model->race ? Html::a($model->race->name, ['/race/view', 'id' => $model->race_id]) : null;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'class_id',
                'label' => 'Class',
                'value' => function ($model) {
                    return $model->class ? Html::a($model->class->name, ['/class/view', 'id' => $model->class_id]) : null;
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>