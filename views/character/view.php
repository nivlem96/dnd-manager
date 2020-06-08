<?php
/**
 * @var $this  yii\web\View
 * @var $form  yii\bootstrap\ActiveForm
 *
 * @var $model app\models\Character
 * @var $user  app\models\User
 **/

use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\User;
use yii\helpers\Url;

$this->title = $model->name;
?>
<h1><?= HTML::encode($this->title) . ' (' . Html::a($model->race->name, ['/race/view', 'id' => $model->race->id]) . ') ' . $model->level ?></h1>

<div class="campaign-wrapper">
    <?php if ($model->player_id == $user->id || $user->rank >= User::RANK_MANAGER): ?>
		<div class="row">
			<div class="col-md-4">
                <?= Html::a('Level up', ['/character/level-up', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-4">
                <?= Html::a('edit', ['/character/edit', 'id' => $model->id]) ?>
			</div>
			<div class="col-md-4">
                <?= Html::a('delete', ['/character/delete', 'id' => $model->id]) ?>
			</div>
		</div>
    <?php endif; ?>
    <?php $classRelations = $model->getClassRelations()->all() ?>
	<div class="row">
        <?php foreach ($classRelations as $relation): ?>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2">
                        <?= Html::a($relation->class->name, ['/character-class/view', 'id' => $relation->class->id]) . ' ' . $relation->level ?>
					</div>
				</div>
			</div>
        <?php endforeach; ?>
	</div>
	<div class="row">

		<div class="row">
			<div class="col-md-4">
				<div class="col-md-6">
					Hitpoints:
				</div>
				<div class="col-md-6">
                    <?= $model->current_hitpoints . '/' . $model->max_hitpoints ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="col-md-6">
					Armor Class:
				</div>
				<div class="col-md-6">
                    <?= $model->getArmorClass() ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="col-md-6">
					Speed:
				</div>
				<div class="col-md-6">
                    <?= $model->speed ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
			<h4>Strength</h4>
		</div>
		<div class="col-md-2">
			<h4>Dexterity</h4>
		</div>
		<div class="col-md-2">
			<h4>Constitution</h4>
		</div>
		<div class="col-md-2">
			<h4>Intelligence</h4>
		</div>
		<div class="col-md-2">
			<h4>Wisdom</h4>
		</div>
		<div class="col-md-2">
			<h4>Charisma</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
            <?= $model->strength ?>
		</div>
		<div class="col-md-2">
            <?= $model->dexterity ?>
		</div>
		<div class="col-md-2">
            <?= $model->constitution ?>
		</div>
		<div class="col-md-2">
            <?= $model->intelligence ?>
		</div>
		<div class="col-md-2">
            <?= $model->wisdom ?>
		</div>
		<div class="col-md-2">
            <?= $model->charisma ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
            <?= $model->getStatModifier('strength') ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier('dexterity') ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier('constitution') ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier('intelligence') ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier('wisdom') ?>
		</div>
		<div class="col-md-2">
            <?= $model->getStatModifier('charisma') ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1">
			<h4>Background</h4>
		</div>
		<div class="col-md-11">
            <?= $model->backstory ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<h3>Skills</h3>
            <?php
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getSkillRelation(),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'value' => function ($model) {
                            return Html::a($model->skill->name, ['/skill/view', 'id' => $model->skill->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'modifier',
                        'value' => function ($model) {
                            return $model->getModifier();
                        },
                    ],
                ],
            ]);
            ?>
		</div>
		<div class="col-md-4">
			<h3>Feats</h3>
            <?php
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getFeatRelation(),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'value' => function ($model) {
                            return Html::a($model->feat->name, ['/feat/view', 'id' => $model->feat->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'counter',
                    ],
                    [
                        'attribute' => 'counter_type',
                    ],
                ],
            ]);
            ?>
		</div>
		<div class="col-md-4">
			<h3>Inventory</h3>
            <?php
            echo Html::a('Add item', ['/inventory/add', 'characterId' => $model->id]) . '<br/>';
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getInventories(),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'value' => function ($model) {
                            /**
                             * @var \app\models\Inventory $model
                             */
                            return $model->getEquipment()->one()->name;
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'quantity',
                        'value' => function ($model) {
                            /**
                             * @var \app\models\Inventory $model
                             */
                            return $model->quantity;
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'equip',
                        'value' => function ($model) {
                            /**
                             * @var \app\models\Inventory $model
                             */
                            return Html::checkbox('Equipped', $model->equipped, ['class' => 'equip-checkbox', 'data-inventory-id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'delete',
                        'value' => function ($model) {
                            /**
                             * @var \app\models\Inventory $model
                             */
                            return Html::a('X', ['/inventory/delete', 'id' => $model->id, 'characterId' => $model->character->id]);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]);
            ?>
		</div>
	</div>
	<script type="text/javascript">
        $('.equip-checkbox').change(function () {
            let id = $(this).data('inventory-id');
            let value = 0;
            if($(this). is(":checked")){
                value = 1;
            }
            else if($(this). is(":not(:checked)")){
                value = 0;
            }
            $.ajax({
                type: "POST",
                url: "<?= Url::to(['/inventory/toggle-equipment']) ?>",
                data: { 'id' : id,'equipped':value },
                success: function (data) {
                    //do something
                    location.reload();
                },
                error: function (errormessage) {

                    //do something else
                    console.log(errormessage)

                }
            });
        });
	</script>
</div>