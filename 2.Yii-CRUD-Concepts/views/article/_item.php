<?php

/** @var $model \app\models\Article */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;

?>

<div class="article-item">
   <a href="<?= Url::to(['article/view', 'id' => $model->id]) ?>">
        <h3><?= Html::encode($model->title) ?></h3>
    </a>

    <?php if ($showContent): ?>
        <div>
            <p><?= StringHelper::truncateWords(Html::encode($model->content), 40) ?></p>
        </div>
    <?php endif; ?>

</div>