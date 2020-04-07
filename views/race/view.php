<?php
/**
 * @var $this            yii\web\View
 * @var $form            yii\bootstrap\ActiveForm
 *
 * @var $model           app\models\Race
 * @var $user            app\models\User
 * @var $featProvider    app\models\Feat
 * @var $subRaceProvider app\models\Race
 **/

use yii\grid\GridView;
use yii\helpers\Html;
use app\models\User;

$this->title = $model->name;
?>
<h1><?= !empty($model->parent) ? $model->name . ' (' . HTML::a($model->parent->name, ['/race/view', 'id' => $model->parent->id]) . ')' : $model->name ?></h1>

<div class="campaign-wrapper">
    <?php if ($model->created_by_user_id == $user->id || $user->rank >= User::RANK_MANAGER): ?>
		<div class="row">
			<div class="col-md-6">
                <?= Html::a('delete', ['/race/delete', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-6">
                <?= Html::a('edit', ['/race/edit', 'id' => $model->id]) ?>
			</div>
		</div>
    <?php endif; ?>
	<div class="row">
		<div class="col-1">
			<h4>Description</h4>
		</div>
		<div class="col-11">
            <?= $model->description ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h3>Feats</h3>
            <?php if ($model->created_by_user_id == $user->id || $user->rank >= User::RANK_MANAGER): ?>
				<div class="row">
					<div class="col-md-12">
                        <?= Html::a('add', ['/feat/create', 'race_id' => $model->id]) ?>
					</div>
				</div>
            <?php endif; ?>
            <?=
            GridView::widget([
                'dataProvider' => $featProvider,
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
                ],
            ]);
            ?>
		</div>
		<div class="col-md-6">
			<h3>Sub races</h3>
            <?php if ($model->created_by_user_id == $user->id || $user->rank >= User::RANK_MANAGER): ?>
				<div class="row">
					<div class="col-md-12">
                        <?= Html::a('add', ['/race/create', 'parent_id' => $model->id]) ?>
					</div>
				</div>
            <?php endif; ?>
            <?=
            GridView::widget([
                'dataProvider' => $subRaceProvider,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'value' => function ($model) {
                            return Html::a($model->name, ['/race/view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]);
            ?>
		</div>
	</div>
</div>