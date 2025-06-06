<?php
namespace app\components;

use Yii;
use yii\web\AssetManager;
// use app\components\AssetManagerComponent;

class AssetManagerComponent extends AssetManager
{
    public $linkAssets = true;
    public $basePath = "@webroot/assets";
    public $baseUrl = "@web/assets";
    public $appendTimestamp = true;
    public $bundles = [
        "yii\web\JqueryAsset" => [
            "js" => ["https://code.jquery.com/jquery-3.6.0.min.js"],
        ],
        "yii\bootstrap5\BootstrapAsset" => [
            "css" => [
                "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css",
            ],
            "js" => [
                "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js",
            ],
        ],
    ];
}
