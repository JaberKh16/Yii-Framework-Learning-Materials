<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $this->title; ?>/title>
</head>
<body>
    <section class="form">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Login') ?>
            </div>

        <?php ActiveForm::end(); ?>
    </section>
</body>
</html>