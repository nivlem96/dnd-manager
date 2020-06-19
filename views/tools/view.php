<?php
/**
 * @var $this  yii\web\View
 * @var $form  yii\bootstrap\ActiveForm
 *
 * @var $model app\models\Tools
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
                <?= Html::a('delete', ['/tools/delete', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-6">
                <?= Html::a('edit', ['/tools/edit', 'id' => $model->id]) ?>
			</div>
		</div>
    <?php endif; ?>
	<div class="row">
		<div class="row">
			<div class="col-md-2">
				<h4>Cost</h4>
			</div>
			<div class="col-md-2">
				<h4>Weight</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
                <?= $model->cost ?>
			</div>
			<div class="col-md-2">
                <?= $model->weight ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>Description</h4>
			</div>
			<div class="col-md-12">
                <?= $model->description ?>
			</div>
		</div>
	</div>
</div>