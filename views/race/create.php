<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\Race */

use app\models\Race;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create race';
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
    <?php
    $userId = Yii::$app->user->id;
    $races = User::getUserAvailableClassArray($userId,Race::className());
    echo $form->field($model,'parent_id')->dropDownList($races)->label('Parent');?>
    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'speed')->input('number',['min'=>5,'step'=>5]) ?>
    <?= $form->field($model, 'size')->textInput() ?>
    <?= $form->field($model, 'alignment')->textInput() ?>
    <?= $form->field($model, 'language_choice')->input('number') ?>
	<div class="form-group">
		<table style="width: 100%">
			<tr>
				<th>Strength Modifier</th>
				<th>Dexterity Modifier</th>
				<th>Constitution Modifier</th>
			</tr>
			<tr>
				<td><?= $form->field($model,'ability_score_strength')->input('number',['min'=>0])->label(false) ?></td>
				<td><?= $form->field($model,'ability_score_dexterity')->input('number',['min'=>0])->label(false) ?></td>
				<td><?= $form->field($model,'ability_score_constitution')->input('number',['min'=>0])->label(false) ?></td>
			</tr>
			<tr>
				<th>Intelligence Modifier</th>
				<th>Wisdom Modifier</th>
				<th>Charisma Modifier</th>
			</tr>
			<tr>
				<td><?= $form->field($model,'ability_score_intelligence')->input('number',['min'=>0])->label(false) ?></td>
				<td><?= $form->field($model,'ability_score_wisdom')->input('number',['min'=>0])->label(false) ?></td>
				<td><?= $form->field($model,'ability_score_charisma')->input('number',['min'=>0])->label(false) ?></td>
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