<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\Feat */

use app\models\Race;
use app\models\CharacterClass;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create feat level';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="campaign-wrapper">
    <?php
    $form = ActiveForm::begin([
        'id' => 'campaign-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]);

    $userId = Yii::$app->user->id;
    echo $form->field($model, 'level')->input('number', ['min' => 1]);
    echo $form->field($model, 'counter')->input('number');
    echo $form->field($model, 'die_number')->input('number');
    ?>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>