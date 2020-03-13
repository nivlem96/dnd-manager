<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $dataProvider app\models\Race */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Races';
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
                    return Html::a($model->name, ['/race/view','id'=>$model->id]);
                },
                'format'=>'raw'
            ],
            [
                'attribute' => 'description',
            ],
        ],
    ]);
    ?>
</div>