<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\Character */
/* @var $availableFeats */

use app\models\Race;
use app\models\CharacterClass;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Pick your feats';
?>
<h1><?= HTML::encode($this->title) ?></h1>


<div class="campaign-wrapper">
    <h3>New feats</h3>
	<table>
		<?php foreach ($availableFeats as $feat) :?>
			<tr><td><?= $feat->name ?></td></tr>
		<?php endforeach; ?>
	</table>

    <?php $form = ActiveForm::begin([
        'id' => 'campaign-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>




	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>