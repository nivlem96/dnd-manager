<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ChoiceOption */
/* @var $options array */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Constants;

$this->title = 'Create choice';
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

    <?= $form->field($model, 'options')->checkboxList($options) ?>
    <?= $form->field($model,'step')->hiddenInput(['value'=>2])->label(false); ?>
    <?= $form->field($model,'choice_id')->hiddenInput()->label(false); ?>
    <?= $form->field($model,'equipment_type')->hiddenInput()->label(false); ?>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>