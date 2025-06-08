<?php

namespace app\controllers;

use yii\helpers\VarDumper;
use yii\web\Controller;
use app\models\Article;


class ArticleController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function beforeAction($action){
        if($action->id == 'index'){
            echo '<pre>';
            // var_dump($action); // if wanted to called the overall configuration called actions
            var_dump($action->id); // accessing requested actionId
            // var_dump($action->controller); // accessing its controller informaton
            var_dump($action->behaviors());
            echo '</pre>';
        }

        // if parent action called return parent::beforeAction() called the server info in console
        if(parent::beforeAction($action)){
            return parent::beforeAction($action);
        } else{
            return false;
        }
    }

    public function actionView($id){
        return $this->render('article/view',['model'=>$this->findModel($id)]);
    }
    

    // show the passed query string 
    public function actionParams($query_strings = null){
        
        if(is_array($query_strings)){
            if($query_strings != null){
                echo "<pre>";
                var_dump('Query strings are: ', $query_strings);
                echo "</pre>";
            } else{
                echo VarDumper::dump($query_strings);
            }
        }
    }

    public function actionCreate(){
        $model = new Article();

        $model->id = 'ID0234234';
        $model->title = 'The Book';
        $model->content = 'Book changed life provide the perception to see learned events.';

        return $this->render("view", ["model" => $model]);
    }


}
