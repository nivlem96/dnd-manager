<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\Spell */

use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Add Item to inventory';
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
    $items = User::getUserAvailableClassArray(Yii::$app->user->id, \app\models\Item::className());
    $armors = User::getUserAvailableClassArray(Yii::$app->user->id, \app\models\Armor::className());
    $weapons = User::getUserAvailableClassArray(Yii::$app->user->id, \app\models\Weapon::className());
    echo $form->field($model, 'itemId')->dropDownList($items);
    echo $form->field($model, 'armorId')->dropDownList($armors);
    echo $form->field($model, 'weaponId')->dropDownList($weapons);
    ?>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>