<?php
/**
 * @var $this  yii\web\View
 * @var $form  yii\bootstrap\ActiveForm
 *
 * @var $model app\models\Race
 * @var $user app\models\User
 * @var $featProvider app\models\Feat
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
	<h3>Feats</h3>
    <?=
    GridView::widget([
        'dataProvider' => $featProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['/feat/view','id'=>$model->id]);
                },
                'format'=>'raw'
            ],
            [
                'attribute' => 'unlocked_at',
            ],
        ],
    ]);
    ?>
</div>