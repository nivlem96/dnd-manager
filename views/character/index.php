<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Character */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Characters';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="spell-wrapper">
    <?= HTML::a('+ Add a new character', ['character/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/character/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'campaign_id',
                'value' => function ($model) {
                    return $model->campaign ? $model->campaign->name : null;
                },
            ],
        ],
    ]);
    ?>
</div>