<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\Background */
/* @var $user app\models\User */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create background';
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
    <?= $form->field($model, 'language_choices')->input('number') ?>
    <?= $form->field($model, 'default_languages')->checkboxList(\app\models\User::getUserAvailableClassArray($user->id,\app\models\Language::className(),false))->label('Languages') ?>
    <?= $form->field($model, 'skills_to_choose')->checkboxList(\app\models\User::getUserAvailableClassArray($user->id,\app\models\Skill::className(),false))->label('Skills') ?>
    <?= $form->field($model, 'proficiencies')->checkboxList(\app\models\User::getUserAvailableClassArray($user->id,\app\models\Proficiency::className(),false))->label('Proficiencies') ?>
    <?= $form->field($model, 'choice_proficiencies_number')->input('number') ?>
    <?= $form->field($model, 'choice_proficiencies')->checkboxList(\app\models\User::getUserAvailableClassArray($user->id,\app\models\Proficiency::className(),false))->label('Choice Proficiencies') ?>
    <div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>