<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $choices array */
/* @var $skills array */
/* @var $id int */

/* @var $model app\models\Character */

use app\models\Race;
use app\models\CharacterClass;
use app\models\User;
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

	<?php foreach ($choices as $choice_id => $choice): ?>
		<div class="form-group field-character-race_id required has-success">
			<div class="col-lg-3">
                <?= HTML::dropDownList('Inventory[' . $choice_id . ']',[],$choice,['class'=>'form-control']) ?>
			</div>
			<div class="col-lg-9"><p class="help-block help-block-error "></p></div>
		</div>
	<?php endforeach; ?>
	<div class="form-group field-character-race_id required has-success">
        <?= HTML::checkboxList('Skills[]',[],$skills,['class'=>'form-control']) ?>
	</div>
	<input type="hidden" name="characterId" value="<?= $id ?>">

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>

<script>
    var limit = <?= $model->getClassRelations()->one()->class->skill_choices ?>;
    $('input[type=checkbox]').on('change', function (e) {
        if ($('input[type=checkbox]:checked').length > limit) {
            $(this).prop('checked', false);
            alert("allowed only "+limit);
        }
    });
</script>