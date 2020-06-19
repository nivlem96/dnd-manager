<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\Armor */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create armor';
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
    ]);
    $proficiencies = \app\models\User::getUserAvailableClassArray(Yii::$app->user->id, \app\models\Proficiency::className(), false);
    ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'type')->textInput() ?>
    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'cost')->input('number') ?>
    <?= $form->field($model, 'weight')->input('number') ?>
    <?= $form->field($model, 'proficiency_id')->dropDownList($proficiencies) ?>
    <?= $form->field($model, 'armor_class')->input('number', ['min' => 0]) ?>
    <?= $form->field($model, 'armor_class_modifier')->dropDownList([
        null => '',
        'strength' => 'Strength',
        'dexterity' => 'Dexterity',
        'constitution' => 'Constitution',
        'intelligence' => 'Intelligence',
        'wisdom' => 'Wisdom',
        'charisma' => 'Charisma',
    ]); ?>
    <?= $form->field($model, 'armor_class_modifier_max')->input('number') ?>
    <?= $form->field($model, 'strength_requirement')->input('number') ?>
    <?= $form->field($model, 'stealth_disadvantage')->checkbox() ?>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>