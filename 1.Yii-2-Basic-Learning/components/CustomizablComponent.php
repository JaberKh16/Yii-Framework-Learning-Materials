<?php

/*
    Components
    ==========
    Components are the main building blocks of Yii applications. Components are instances of yii\base\Component, or an extended class - yii\base\BaseObject. 
    The three main features that components provide to other classes  are:

        a. Properties
        b. Events
        c. Behaviors

    Separately and combined, these features make Yii classes much more customizable and easier to use. For example, the included yii\jui\DatePicker, 
    a user interface component, can be used in a view to generate an interactive date picker:

    use yii\jui\DatePicker;
    echo DatePicker::widget([
        'language' => 'ru',
        'name'  => 'country',
        'clientOptions' => [
            'dateFormat' => 'yy-mm-dd',
        ],
    ]);

    The widget's properties are easily writable because the class extends yii\base\Component.

    While components are very powerful, they are a bit heavier than normal objects, due to the fact that it takes extra memory and CPU time to support event and behavior functionality in particular. 
    If your components do not need these two features, you may consider extending your component class from yii\base\BaseObject instead of yii\base\Component. 
    Doing so will make your components as efficient as normal PHP objects, but with added support for properties.

    When extending your class from yii\base\Component or yii\base\BaseObject, it is recommended that you follow these conventions:

    If you override the constructor, specify a $config parameter as the constructor's last parameter, and then pass this parameter to the parent constructor.
    Always call the parent constructor at the end of your overriding constructor.
    If you override the yii\base\BaseObject::init() method, make sure you call the parent implementation of init() at the beginning of your init() method.

*/

namespace app\components;


// taking BaseObject
use yii\base\BaseObject;

class CustomizablComponent extends BaseObject{
    public static  $property1 = null;
    public static $property2 = null;

    
    // constructor to setup initial values for class properties
    public function __construct($param1, $param2, $config = []){
        parent::__construct($config); // calling this parent instance
        $this->config = $config;
        $this->property1 = $param1;
        $this->property2 = $param2;    
    }

    public function init(){
        $this->initProperties();
        $this->initComponents();
        $this->initComponent();

        parent::init(); // initialize after configuration is applied
    }
}