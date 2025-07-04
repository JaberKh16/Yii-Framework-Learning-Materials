<?php

use app\models\Articles;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\ArticleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Create Articles', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php else: ?>
        <div class="alert alert-info">
            <p>You are currently viewing articles as a guest. Please log in to create or manage articles.</p>
        </div>

        <p>
            <?= Html::a('Login', ['site/login'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'slug',
            'content:ntext',
            'image',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Articles $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?> -->


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item', // specifying view file 
        'layout' => "{items}\n{pager}",
        'itemOptions' => ['class' => 'article-item'],
        'options' => ['class' => 'article-list'],
        'pager' => [
            'class' => \yii\widgets\LinkPager::class,
            'options' => ['class' => 'pagination'],
        ],
        'viewParams' => [
            'showContent' => true,
        ],
        'emptyText' => 'No articles found.',
        'emptyTextOptions' => ['class' => 'text-muted'],
        'summary' => 'Showing {count} articles out of {totalCount}.',
        'summaryOptions' => ['class' => 'summary text-muted'],

        // Optional sorter section — works only if sorting is set up in your dataProvider
        // If ListViewSorter is not a custom class, remove this section or replace with a custom dropdown
        /*
        'sorter' => [
            'class' => \yii\widgets\ListViewSorter::class,
            'attributes' => ['title', 'created_at'],
            'options' => ['class' => 'sorter'],
        ],
        */
    ]); ?>



</div>
