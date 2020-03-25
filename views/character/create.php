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
	<?php
	$userId = Yii::$app->user->id;
	$races = Race::getUserAvailableRacesArray($userId);
    $classes = CharacterClass::getUserAvailableClassesArray($userId);
	echo $form->field($model,'race_id')->dropDownList($races)->label('Race');?>
	<div class="form-group field-character-race_id required has-success">
		<label class="col-lg-1 control-label" for="class_relation-class_id">Class</label>
		<div class="col-lg-3">
            <?= HTML::dropDownList('ClassRelation[class_id]',[],$classes,['class'=>'form-control']) ?>
		</div>
		<div class="col-lg-8"><p class="help-block help-block-error "></p></div>
	</div>
    <?= $form->field($model, 'background')->textarea() ?>
	<?= $form->field($model,'player_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false) ?>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>