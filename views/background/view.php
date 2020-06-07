<?php
/**
 * @var $this           yii\web\View
 * @var $form           yii\bootstrap\ActiveForm
 *
 * @var $model          app\models\Background
 * @var $user           app\models\User
 * @var $choiceProvider app\models\Choice
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
                <?= Html::a('delete', ['/background/delete', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-6">
                <?= Html::a('edit', ['/background/edit', 'id' => $model->id]) ?>
			</div>
		</div>
    <?php endif; ?>
	<div class="row">
		<div class="col-md-1">
			<h4>Description</h4>
		</div>
		<div class="col-md-11">
            <?= $model->description ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h3>Starting Equipment</h3>
            <?php if ($model->created_by_user_id == $user->id || $user->rank >= User::RANK_MANAGER): ?>
				<div class="row">
					<div class="col-md-12">
                        <?= Html::a('add', ['/choice/create', 'relation_class' => \app\models\Background::className(), 'relation_id' => $model->id]) ?>
					</div>
				</div>
            <?php endif; ?>
            <?=
            GridView::widget([
                'dataProvider' => $choiceProvider,
                'columns' => [
                    [
                        'attribute' => 'choice_type',
                        'value' => function ($model) {
                            return Html::a($model->choice_type, ['/choice/edit', 'id' => $model->id, 'relation_class' => \app\models\CharacterClass::className(), 'relation_id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Count options',
                        'value' => function ($model) {
                            /**
                             * @var \app\models\Choice $model
                             */
                            return count($model->getChoiceOptions()->all());
                        },
                    ],
                ],
            ]);
            ?>
		</div>
	</div>
</div>