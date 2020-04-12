<?php
/**
 * @var $this  yii\web\View
 * @var $form  yii\bootstrap\ActiveForm
 *
 * @var $model app\models\Character
 * @var $user  app\models\User
 **/

use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\User;

$this->title = $model->name;
?>
<h1><?= HTML::encode($this->title) . ' ('. $model->race->name . ') ' . $model->level ?></h1>

<div class="campaign-wrapper">
    <?php if ($model->player_id == $user->id || $user->rank >= User::RANK_MANAGER): ?>
		<div class="row">
			<div class="col-md-4">
                <?= Html::a('Level up', ['/character/level-up', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-4">
                <?= Html::a('edit', ['/character/edit', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-4">
                <?= Html::a('delete', ['/character/delete', 'id' => $model->id]) ?>
			</div>
		</div>
    <?php endif; ?>
	<div class="row">
		<div class="col-md-2">
			<h4>Strength</h4>
		</div>
		<div class="col-md-2">
			<h4>Dexterity</h4>
		</div>
		<div class="col-md-2">
			<h4>Constitution</h4>
		</div>
		<div class="col-md-2">
			<h4>Intelligence</h4>
		</div>
		<div class="col-md-2">
			<h4>Wisdom</h4>
		</div>
		<div class="col-md-2">
			<h4>Charisma</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
            <?= $model->strength ?>
		</div>
		<div class="col-md-2">
            <?= $model->dexterity ?>
		</div>
		<div class="col-md-2">
            <?= $model->constitution ?>
		</div>
		<div class="col-md-2">
            <?= $model->intelligence ?>
		</div>
		<div class="col-md-2">
            <?= $model->wisdom ?>
		</div>
		<div class="col-md-2">
            <?= $model->charisma ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
            <?= $model->getStatModifier($model->strength) ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier($model->dexterity) ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier($model->constitution) ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier($model->intelligence) ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier($model->wisdom) ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier($model->charisma) ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1">
			<h4>Background</h4>
		</div>
		<div class="col-md-11">
            <?= $model->background ?>
		</div>
	</div>
	<h3>Classes</h3>
    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => $model->getClassRelation(),
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->class->name, ['/character-class/view', 'id' => $model->class->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'level',
            ],
        ],
    ]);
    ?>
	<h3>Feats</h3>
    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => $model->getFeatRelation(),
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->feat->name, ['/feat/view', 'id' => $model->feat->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>
</div>