<?php

use frontend\models\ChangeUserForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$model = $model ?? new ChangeUserForm();
$model->username = $user->username;
$form = ActiveForm::begin(['id' => 'form-signup']);
?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
    </div>

<?php ActiveForm::end(); ?>