<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string|null $image
 * @property int $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Articles extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => date('Y-m-d H:i:s'), // Set the default value for created_at and updated_at
            ],
            'blameable' => [
                'class' => \yii\behaviors\BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'slug' => [
                'class' => \yii\behaviors\SluggableBehavior::class,
                'attribute' => 'title', // Automatically generate slug from title
                'ensureUnique' => false, // Ensure the slug is not unique
            ],
            // 'imageUpload' => [
            //     'class' => \app\components\ImageUploadBehavior::class, // Custom behavior for image upload
            //     'attribute' => 'image', // The attribute that holds the image file
            //     'path' => '@webroot/uploads/articles', // Path to save the uploaded images
            //     'url' => '@web/uploads/articles', // URL to access the uploaded images
            // ],
        ];
    }

    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         if ($this->isNewRecord) {
    //             $this->created_at = date('Y-m-d H:i:s');
    //             $this->created_by = Yii::$app->user->id; // Assuming you have user authentication
    //         } else {
    //             $this->updated_at = date('Y-m-d H:i:s');
    //             $this->updated_by = Yii::$app->user->id; // Assuming you have user authentication
    //         }
    //         return true;
    //     }
    //     return false;
    // }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'updated_by'], 'default', 'value' => null],
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            // [['created_by', 'updated_by'], 'integer', 'value' => Yii::$app->user->id],
            [['id'], 'integer'],
            [['id', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug',], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'content' => 'Content',
            'image' => 'Image',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCreatedByUser()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

}
