<?php

namespace backend\models;

use common\models\User;
use Exception;
use Yii;

class ApiBalance
{
    protected $to = [
        "test" => [],
        "test2" => []
    ];
    private $key;
    /**
     * @var $user User
     */
    private $user;

    /**
     * ApiBalance constructor.
     * @param $key
     * @throws Exception
     */
    public function __construct($key)
    {
        $this->key = $key;
        $this->checkUserKey();

        if ($this->user === null) {
            throw new Exception("Пользователь не найден");
        }
    }

    public function checkUserKey()
    {
        $this->user = User::findByApiKey($this->key);
    }

    public function getBalance()
    {
        return [
            "errors" => [],
            "data" => [
                "amount" => $this->user->balance
            ]
        ];
    }

    /**
     * @param $to
     * @param $amount
     * @return array
     * @throws Exception
     */
    public function sendBalance($to, $amount)
    {
        if(!isset($this->to[$to])) {
            throw new Exception("Метод не найден!");
        }
        if($amount > $this->user->balance) {
            throw new Exception("Ваш баланс меньше запрашиваемой суммы!");
        }

        /*
         * Логика отправления
         */

        $this->user->balance += -$amount;
        $this->user->save();

        return [
            "errors" => [],
            "data" => [
                "amount" => $this->user->balance
            ]
        ];
    }

}