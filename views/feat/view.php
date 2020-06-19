<?php
/**
 * @var $this                 yii\web\View
 * @var $form                 yii\bootstrap\ActiveForm
 *
 * @var $model                app\models\Feat
 * @var $featLevelProvider    app\models\FeatLevel
 * @var $user                 app\models\User
 **/

use yii\grid\GridView;
use yii\helpers\Html;
use app\models\User;

$this->title = $model->name;
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="campaign-wrapper">
    <?php if ($model->created_by_user_id == $user->id || $user->rank >= User::RANK_MANAGER): ?>
		<div class="row">
			<div class="col-md-6">
                <?= Html::a('delete', ['/feat/delete', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-6">
                <?= Html::a('edit', ['/feat/edit', 'id' => $model->id]) ?>
			</div>
		</div>
    <?php endif; ?>
	<div class="row">
		<div class="row">
			<div class="col-md-1">
				<h4>Description</h4>
			</div>
			<div class="col-md-11">
                <?= $model->description ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h3>Feats</h3>
            <?php if ($model->created_by_user_id == $user->id || $user->rank >= User::RANK_MANAGER): ?>
				<div class="row">
					<div class="col-md-12">
                        <?= Html::a('add level condition', ['/feat-level/create', 'feat_id' => $model->id]) ?>
					</div>
				</div>
            <?php endif; ?>
            <?=
            GridView::widget([
                'dataProvider' => $featLevelProvider,
                'columns' => [
                    [
                        'attribute' => 'level',
                    ],
                    [
                        'attribute' => 'counter',
                    ],
                    [
                        'attribute' => 'die_number',
                    ],
                    [
                        'value' => function ($model) {
                            return Html::a('edit', ['/feat-level/create', 'id' => $model->id, 'feat_id' => $model->feat_id]) . ' ' . Html::a('delete', ['/feat-level/delete', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]);
            ?>
		</div>
	</div>
</div>