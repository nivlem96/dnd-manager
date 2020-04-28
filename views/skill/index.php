<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Skill */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Skills';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="skill-wrapper">
    <?= HTML::a('+ Add a new skill', ['skill/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/skill/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>