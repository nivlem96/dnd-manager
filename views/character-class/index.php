<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\CharacterClass */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Classes';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="class-wrapper">
    <?= HTML::a('+ Add a new class', ['character-class/create']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/character-class/view','id'=>$model->id]);
                },
                'format'=>'raw'
            ],
        ],
    ]);
    ?>
</div>