<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Race */
use yii\helpers\Html;

$this->title = 'Races';
?>
<h1><?= HTML::encode($this->title) ?></h1>

<div class="campaign-wrapper">
    <?= HTML::a('+ Add a new race', ['race/create']) ?>

    <?php if(count($model) > 0) :?>
        <table>
            <thead>
            <tr>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $race): ?>
                <tr>
                    <td><?= HTML::a($race->name,['race/view/', 'id'=>$race->id]) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>