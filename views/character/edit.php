<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\Character */

use app\models\Race;
use app\models\CharacterClass;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create character';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="campaign-wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'campaign-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'background')->textarea() ?>
	<?= $form->field($model,'player_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false) ?>
	<div class="form-group">
		<table style="width: 100%">
			<tr>
				<th>Strength</th>
				<th>Dexterity</th>
				<th>Constitution</th>
			</tr>
			<tr>
				<td><?= $form->field($model,'strength')->input('number',['min'=>0])->label(false) ?></td>
				<td><?= $form->field($model,'dexterity')->input('number',['min'=>0])->label(false) ?></td>
				<td><?= $form->field($model,'constitution')->input('number',['min'=>0])->label(false) ?></td>
			</tr>
			<tr>
				<th>Intelligence</th>
				<th>Wisdom</th>
				<th>Charisma</th>
			</tr>
			<tr>
				<td><?= $form->field($model,'intelligence')->input('number',['min'=>0])->label(false) ?></td>
				<td><?= $form->field($model,'wisdom')->input('number',['min'=>0])->label(false) ?></td>
				<td><?= $form->field($model,'charisma')->input('number',['min'=>0])->label(false) ?></td>
			</tr>
		</table>
	</div>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>