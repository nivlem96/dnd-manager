<?php
/**
 * @var $this  yii\web\View
 * @var $form  yii\bootstrap\ActiveForm
 *
 * @var $model app\models\Campaign
 * @var $event app\models\Event
 **/

use yii\helpers\Html;

$this->title = $model->name;
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="campaign-wrapper">
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-12">
					<h3>Events</h3>
                    <?= HTML::a('+ Create new event', ['/event/create', 'id' => $model->id]) ?>
                    <?php
                    $events = $model->events ?? null;
                    if (!empty($events)): ?>
						<table>
							<tr>
								<th>Title</th>
							</tr>
                            <?php foreach ($events as $event): ?>
								<tr>
									<td><?= HTML::a($event->title, ['/event/view/', 'id' => $event->id]) ?></td>
								</tr>
                            <?php endforeach; ?>
						</table>
                    <?php endif; ?>
				</div>
				<div class="col-12">
					<h3>Encounters</h3>
                    <?= HTML::a('+ Create new encounter', ['/encounter/create', 'campaign_id' => $model->id]) ?>
                    <?php
                    $encounters = $model->encounters ?? null;
                    if (!empty($encounters)): ?>
						<table>
							<tr>
								<th>Title</th>
							</tr>
                            <?php foreach ($encounters as $encounter): ?>
								<tr>
									<td><?= HTML::a($encounter->title, ['/event/view/', 'id' => $encounter->id]) ?></td>
								</tr>
                            <?php endforeach; ?>
						</table>
                    <?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-12">
					<h3>Player characters</h3>
                    <?= HTML::a('+ Create new character', ['/character/create', 'campaign_id' => $model->id]) ?>
                    <?php
                    $characters = $model->characters ?? null;
                    if (!empty($characters)): ?>
						<table>
							<tr>
								<th>Title</th>
							</tr>
                            <?php foreach ($characters as $character): ?>
								<tr>
									<td><?= HTML::a($character->title, ['/character/view/', 'id' => $character->id]) ?></td>
								</tr>
                            <?php endforeach; ?>
						</table>
                    <?php endif; ?>
				</div>
				<div class="col-12">
					<h3>NPC's</h3>
                    <?= HTML::a('+ Create new npc', ['/npc/create', 'id' => $model->id]) ?>
                    <?php
                    $npcs = $model->npcs ?? null;
                    if (!empty($npcs)): ?>
						<table>
							<tr>
								<th>Title</th>
							</tr>
                            <?php foreach ($npcs as $npc): ?>
								<tr>
									<td><?= HTML::a($npc->name, ['/npc/view/', 'id' => $npc->id]) ?></td>
								</tr>
                            <?php endforeach; ?>
						</table>
                    <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>