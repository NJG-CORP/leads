<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 04.07.18
 * Time: 2:43
 */

namespace frontend\models;


use common\models\User;
use Yii;
use yii\base\Model;

class ChangeUserForm extends Model
{
    public $username;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username
            [['username'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => "Логин"
        ];
    }

    /**
     *
     */
    public function update()
    {
        if(!$this->validate()) {
            return null;
        }

        $user = User::findIdentity(Yii::$app->user->id);

        $user->username = $this->username;

        return $user->save() ? $user : null;
    }


}