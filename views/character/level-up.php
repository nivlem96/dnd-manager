<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\Character */

use app\models\Race;
use app\models\CharacterClass;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Level up character';
?>
<h1><?= HTML::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-6">
        <?= HTML::a('back',['/character/view','id'=>$model->id]) ?>
    </div>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'campaign-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>
<?php
$userId = Yii::$app->user->id;
$classes = User::getUserAvailableClassArray($userId,CharacterClass::className())($userId);
$dataProvider = new ActiveDataProvider([
    'query' => $model->getClassRelations(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
$characterClasses = $model->getClassRelations()->all();
foreach ($characterClasses as $class) {
	unset($classes[$class->id]);
}
?>
<div class="form-group field-character-race_id required has-success">
	<label class="col-lg-1 control-label" for="class_relation-class_id">New Class</label>
	<div class="col-lg-3">
        <?= HTML::dropDownList('ClassRelation[class_id]',[],$classes,['class'=>'form-control']) ?>
	</div>
	<div class="col-lg-8"><p class="help-block help-block-error "></p></div>
</div>

<div class="campaign-wrapper">


    <?php


    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->class->name, ['/character-class/view', 'id' => $model->class->id]);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'level',
            ],
            [
                'label' => 'Level Up',
                'value' => function ($model) {
                    return Html::a('Level up', ['/character/level-up-class', 'classId' => $model->class->id,'characterId' => $model->character->id]);
                },
                'format' => 'raw',
            ],
        ],
    ]);
    ?>

	<div class="form-group">
		<div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'campaign-button']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
</div>