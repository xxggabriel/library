<?php 

use Slim\Slim;
use Controller\Page\Page;

$app = new Slim(array(
    'debug' => false
));

$app->get('/', function(){
    $page = new Page();
    $page->setTpl("index");
});
    

