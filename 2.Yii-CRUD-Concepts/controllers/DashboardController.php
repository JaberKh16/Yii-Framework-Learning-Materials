<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;


class DashboardController extends Controller{
    
    public $enableCsrfValidation = false; #  to disable csrf token 
    public $layout = 'dashboard';
    
    public function actionIndex(){
        return $this->render("index");
    }
}