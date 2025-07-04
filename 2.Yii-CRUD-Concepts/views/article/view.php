<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Articles $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="articles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], options: [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <?php else: ?>
        <div class="alert alert-info">
            <p>You are currently viewing this article as a guest. Please log in to manage articles.</p>
        </div>
        <p>
            <?= Html::a('Login', ['site/login'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>

    <!-- <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'slug',
            'content:ntext',
            'image',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?> -->

    <div class="text-muted">
        <p><strong>Created At:</strong> <?= Yii::$app->formatter->asDatetime($model->created_at) ?> By: <?= Html::encode($model->created_by) ?> </p>
    </div>

    <div>
        <h2><?= Html::encode($model->title) ?></h2>
        <p><?= Html::encode($model->content) ?></p>
        <?php if ($model->image): ?>
            <img src="<?= Html::encode($model->image) ?>" alt="<?= Html::encode($model->title) ?>" class="img-responsive">
        <?php endif; ?>
    </div>

</div>
