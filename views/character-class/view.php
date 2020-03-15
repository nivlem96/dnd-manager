<?php
/**
 * @var $this  yii\web\View
 * @var $form  yii\bootstrap\ActiveForm
 *
 * @var $model app\models\CharacterClass
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
                <?= Html::a('delete', ['/character-class/delete', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-6">
                <?= Html::a('edit', ['/character-class/edit', 'id' => $model->id]) ?>
			</div>
		</div>
    <?php endif; ?>
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