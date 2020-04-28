<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Proficiency */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Proficiencys';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="proficiency-wrapper">
    <?= HTML::a('+ Add a new proficiency', ['proficiency/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/proficiency/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>