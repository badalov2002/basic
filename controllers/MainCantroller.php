<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
class MainCantroller extends Controller
{
    public function beforeAction($action) {

        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        }
        return true;
    }
}