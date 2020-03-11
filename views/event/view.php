<?php
/**
 * @var $this  yii\web\View
 * @var $form  yii\bootstrap\ActiveForm
 *
 * @var $model app\models\Event
 **/

use yii\helpers\Html;

$this->title = $model->title;
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="campaign-wrapper">
	<div class="row">
		<div class="col-md-6">
			<h3>Encounters</h3>
		</div>
		<div class="col-md-6">
			<h3>NPC's</h3>
		</div>
	</div>
</div>