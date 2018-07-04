<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 04.07.18
 * Time: 3:17
 */

namespace backend\controllers;

use backend\models\ApiBalance;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class BalanceController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'backend\models\ApiError',
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionGet()
    {
        try {
            $key = Yii::$app->request->getBodyParam('key');
            if(empty($key)) {
                throw new Exception("Отсутствует обязательный параметр <key>");
            }
            $ApiBalance = new ApiBalance($key);
            Yii::$app->response->setStatusCode(200);

            return $ApiBalance->getBalance();
        } catch (Exception $e) {
            Yii::$app->response->setStatusCode(400);
            return [
                "errors" => $e->getMessage(),
                "data" => []
            ];
        }
    }

    public function actionSend()
    {
        try {
            $key = Yii::$app->request->getBodyParam('key');
            if(empty($key)) {
                throw new Exception("Отсутствует обязательный параметр <key>");
            }
            $to = Yii::$app->request->getBodyParam('to');
            if(empty($to)) {
                throw new Exception("Отсутствует обязательный параметр <to>");
            }
            $amount = Yii::$app->request->getBodyParam('amount');
            if(empty($amount)) {
                throw new Exception("Отсутствует обязательный параметр <amount>");
            }

            $ApiBalance = new ApiBalance($key);
            Yii::$app->response->setStatusCode(200);
            return $ApiBalance->sendBalance($to, $amount);
        } catch (Exception $e) {
            Yii::$app->response->setStatusCode(400);
            return [
                "errors" => $e->getMessage(),
                "data" => []
            ];
        }
    }

}