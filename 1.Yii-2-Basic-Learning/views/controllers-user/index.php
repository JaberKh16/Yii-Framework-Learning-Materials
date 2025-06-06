<?php
/** @var yii\web\View $this */
?>

<?php
use yii\helpers\Html;
use yii\bootstrap5\Breadcrumbs;

$this->title = "User Details";
$this->params["breadcrumbs"][] = ["label" => "Users", "url" => ["index"]];

echo Breadcrumbs::widget([
    "links" => isset($this->params["breadcrumbs"])
        ? $this->params["breadcrumbs"]
        : [],
]);

echo $this->view();
?>
<h1>controllers-user/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__ ?></code>.
</p>
