<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Language */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Languages';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="language-wrapper">
    <?= HTML::a('+ Add a new language', ['language/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/language/view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>