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
			<h3>Events</h3>
            <?php
            $events = $model->events ?? null;
            var_dump($events);
            if (!empty($events)): ?>
				<table>
					<tr>
						<th>Title</th>
					</tr>
                    <?php foreach ($events as $event): ?>
						<tr>
							<td><?= $event->title ?></td>
						</tr>
                    <?php endforeach; ?>
				</table>
            <?php endif; ?>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-12">
					<h3>Player characters</h3>
					<table>

					</table>
				</div>
				<div class="col-12">
					<h3>NPC's</h3>
				</div>
			</div>
		</div>
	</div>
</div>