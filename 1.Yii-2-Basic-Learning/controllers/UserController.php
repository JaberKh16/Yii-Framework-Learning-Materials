<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\debug\models\search\UserSearchInterface;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class UserController extends Controller
{
    public $layout = "main";

    public function behaviors()
    {
        return [
            "access" => [
                "class" => AccessControl::class,
                "rules" => [
                    [
                        "actions" => ["index", "view"],
                        "allow" => true,
                        "roles" => ["@"],
                    ],
                ],
            ],
            "verbs" => [
                "class" => VerbFilter::class,
                "actions" => [
                    "delete" => ["POST"],
                ],
            ],
        ];
    }

    public function hello()
    {
        return "Hello World";
    }

    public function actionCheckInput()
    {
        return $this->view();
    }

    public function actionIndex()
    {
        $searchModel = new UserSearchInterface();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render("index", [
            "searchModel" => $searchModel,
            "dataProvider" => $dataProvider,
        ]);
    }
}
