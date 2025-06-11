<?php

/*
    Yii Models
    ----------
    Model are part of MVC architecture that are objects business data, logic and rules.

    Model can be created via extending - yii/base/Model or its child classes which supports features like -
        a. Attributes           - represent the business data: access like - normal object or array
        b. Attributes Label     - specify the display labels for attributes
        c. Massive Assignment   - supports populating multiple attributes in a single step
        d. Rules(Validation)    - ensure input data based on the defined rules
        e. Data Exporting       - allow model data to be exported in terms of array with customizable formats

    Example:
        <?php
            namespace app\models; # under app 
            use yii\base\Model;

            class ModelName extends Model{
                # properties
                public static $id;
                public $title = null;
                public $content = null;

                # rules
                public function rules(): array{
                    return [
                        [['title'], 'required', 'string', 'max' => 200],
                        [['content'], 'required']
                    ]
                }

                # attributes label
                public function attributesLabel(): array{
                    return [
                        'id' => 'ID,
                        'content' => 'Content'
                    ]
                }

                # relation
                public function getID(): void {
                    return $this->hasOne(Article::class, []);
                }
            }

    Attributes
        - publicly accessible property of a model
        - method: yii\base\Model::attributes() specifies what attribute a model class has.

            # instance 
            $model = new \app\models\Article;

            # set properties value
            $model->title = 'The Book',
            $model->content = 'Book changed life provide the perceptio to see learned events.'

            # accessing 
            foreach($model as $key => $value){
                echo "$key: $value\n";
            }

            # access via set
    
*/

namespace app\models;

use yii\base\Model; 


class Article extends Model{
    public $id;
    public $title;
    public $content;
    public $content_type;
    public $created_at;
    public $updated_at;
    public $deleted_at;


    public static function tableName()
    {
        return 'articles'; // Your table name here
    }

    # custom setter
    public  function setValue(){
        $this->content_type ? $this->content_type : null;
        $this->content = $this->content ? $this->content : null;
        $this->title = $this->title ? $this->title : null;
        
        $this->created_at = time();
        $this->updated_at = time();
        $this->deleted_at = time();
        $this->content = $this->content ? $this->content : null;
    }

    # custom getter
    public function getValue(): array{
        $result = [
            "id"=> $this->id,
            "title"=> $this->title,
            "content"=> $this->content,
            "content_type" => $this->content_type,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->created_at,
        ];
        return $result;
    }
    public function rules(){
        return [
            [["title","content"],"required"],
            [["content"],"string"],
            [["content"],"string","max"=> 0],
            [["title"],"string","max"=> 0],
        ];
    }

    public function attributeLabels(){
        return [
            "id"=> "ID",
            "title"=> "Title",
            "content"=> "Content"
        ];
    }

    # relation 
    public function getArticle(){
        return $this->hasOne(Article::class, ["id"=> ""]);
    }

    public function getArticleContent(){
        return $this->hasOne(Article::class, []);
    }
}