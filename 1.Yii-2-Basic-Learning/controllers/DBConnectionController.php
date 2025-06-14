<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class DBConnectionController extends Controller{
    /* 
        If you want to restrict access to this action (e.g., only allow logged-in users or administrators to access it), 
        you can use Yii’s access control (AccessControl) behavior.
    */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => \yii\filters\AccessControl::class,
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'actions' => ['db-test'],
    //                     'roles' => ['@'], // Only authenticated users can access this action
    //                 ],
    //             ],
    //         ],
    //     ];
    // }

    public function actionTestConnection()
    {
        $db = Yii::$app->db; // access db object
        $command = $db->createCommand("SELECT NOW()"); // SQL query to get current time from DB
        $result = $command->queryScalar(); // Execute the query and return a single value (current DB time)

        if (!empty($result)) {
            return $this->renderContent("Current DB Time: $result");
        } else {
            return $this->renderContent("Failed to fetch DB time.");
        }
    }
}