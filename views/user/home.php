<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\User */

use yii\helpers\Html;

$this->title = $model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-home">
    <h1><?= Html::encode($this->title) ?></h1>
	<div class="user-home-list-wrapper">
		<ul class="user-home-list">
			<li><?= Html::a('Campaigns('.count($model->campaigns).')',['/campaign'])?></li>
			<li><?= Html::a('Characters('.count($model->characters).')',['/players'])?></li>
		</ul>
	</div>
</div>
