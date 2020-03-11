<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Campaign */
use yii\helpers\Html;

$this->title = 'Campaigns';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="campaign-wrapper">
    <?= HTML::a('+ Start a new campaign', ['campaign/create']) ?>

    <?php if(count($model) > 0) :?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $campaign): ?>
                <tr>
                    <td><?= HTML::a($campaign->name,['campaign/view/', 'id'=>$campaign->id]) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>