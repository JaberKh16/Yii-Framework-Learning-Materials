<?php



namespace app\components;



use yii\base\Behavior;

use yii\db\ActiveRecord;



class ImageUploadBehavior extends Behavior

{

    public $attribute;

    public $path;

    public $url;



    public function events()

    {

        return [

            ActiveRecord::EVENT_BEFORE_VALIDATE => 'uploadImage',

        ];

    }



    public function uploadImage($event)

    {

        $file = \Yii::$app->request->post($this->attribute);

        if ($file) {

            $filePath = \Yii::getAlias($this->path) . '/' . $file->name;

            $file->saveAs($filePath);

            $this->owner->{$this->attribute} = $file->name;

        }

    }

}