<?php
/**
 * @var $this  yii\web\View
 * @var $form  yii\bootstrap\ActiveForm
 *
 * @var $model app\models\Ammunition
 * @var $user app\models\User
 **/

use yii\helpers\Html;
use app\models\User;

$this->title = $model->name;
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="campaign-wrapper">
    <?php if ($model->created_by_user_id == $user->id || $user->rank >= User::RANK_MANAGER): ?>
		<div class="row">
			<div class="col-md-6">
                <?= Html::a('delete', ['/ammunition/delete', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-6">
                <?= Html::a('edit', ['/ammunition/edit', 'id' => $model->id]) ?>
			</div>
		</div>
    <?php endif; ?>
	<div class="row">
		<div class="row">
			<div class="col-1">
				<h4>Description</h4>
			</div>
			<div class="col-11">
                <?= $model->description ?>
			</div>
		</div>
	</div>
</div>