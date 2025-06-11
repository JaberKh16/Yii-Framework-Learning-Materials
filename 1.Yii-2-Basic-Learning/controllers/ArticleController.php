<?php

namespace app\controllers;

use yii\helpers\VarDumper;
use yii\web\Controller;
use app\models\Article;
use yii\web\Request;
use yii\web\Response;
use Yii;
use app\models\RequestInput;

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

        $db = Yii::$app->db;
        var_dump($db);

        $model->id = 'ID0234234';
        $model->title = 'The Book';
        $model->content = 'Book changed life provide the perception to see learned events.';

        return $this->render("view", ["model" => $model]);
    }

    public function actionGetArticleInstanceProperty(){
        $model = new Article();
        $attributesInfo = $model->getAttributes();
        $validator_info = $model->getActiveValidators();
        $errors_info = $model->getErrors();
        var_dump("Errors: ", $errors_info, "attributes: ", $attributesInfo );
    }

    public function actionRequest()
    {
        // request info
        $request_info = Yii::$app->request;
        // get data
        $get_info = Yii::$app->request->get();
        $post_info = Yii::$app->request->post(); 
        
        var_dump($request_info);
    }

    public function actionResponse()
    {
        $response = Yii::$app->response;
        $response->content = "Content"; # showed as action page content
        $response->statusCode = 200; # default is 200

        # changing response format
        $response->format = Response::FORMAT_JSON; # formatting as json

        # set response data = $_GET 
        Yii::$app->response->data = Yii::$app->request->get();

        # redirect
        $this->redirect('about'); // redirect to /about
        $redirect_path = Yii::$app->response->redirect('about', 200);
        # return redirect_path;

        return $response;
    }

    public function actionRequestInput()
    {
        $request_info = Yii::$app->request->post();
        var_dump($request_info);
        return $this->render('input', [
            'model' => $request_info
        ]);
    }

}
