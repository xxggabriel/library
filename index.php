<?php 


$app = new \Slim\Slim();

require_once "Route/site/web.php";
require_once "Route/admin/web.php";

$app->run();