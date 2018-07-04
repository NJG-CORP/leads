<?php

/**
 * @var $user \common\models\User
 * @var $this yii\web\View
 */

$this->title = 'Личный кабинет';
$user = Yii::$app->user->identity;
?>
<div class="site-index">
    <a href="#">API</a> key:
    <div class="hidden-field" data-display-type="inline-block"><?= $user->api_key ?></div>
    <br>
    Изменить логин
    <br>
    <?= $this->renderFile("@forms/changeUser.php", [
        "model" => $model,
        "user" => $user
    ]); ?>
    <pre>
        Примеры запросов
            <b>PUT</b> <?= Yii::$app->params['apiPath']?>/balance
                @params
                {
                    "key" : <b class="hidden-field" data-display-type="inline-block"><?= $user->api_key ?></b>,
                    "to"  : <один из списка ["test","test2"]>,
                    "amount" : <число от 0.00 до суммы Вашего баланса>
                }
                @response
                {
                    "errors" : <Описание ошибки> | "",
                    "data" :
                    {
                        "amount" : <число, сумма Вашего баланса>
                    }
                }
            <b>GET</b> <?= Yii::$app->params['apiPath']?>/balance
                @params
                {
                    "key" : <b class="hidden-field" data-display-type="inline-block"><?= $user->api_key ?></b>
                }
                @response
                {
                    "errors" : <Описание ошибки> | "",
                    "data" :
                    {
                        "amount" : <число, сумма Вашего баланса>
                    }
                }
    </pre>
</div>
