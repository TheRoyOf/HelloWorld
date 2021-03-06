<?php

namespace  app\controllers;

use app\models\LoginForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{

    /**
     * Login action.
     *
     * @return Response|string
     */


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
        }

        $model->password = '';
        return $this->render('/site/login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTest()
    {

        $user = User::findIdentity(1);
//        yii::$app->user->login($user);
//        yii::$app->user->logout($user);

        if(Yii::$app->user->isGuest)
        {
            return "Пользователь гость";
        }
        else
        {
            return "Пользователь авторизирован";
        }
    }

}