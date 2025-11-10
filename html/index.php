<?php

use Slim\Factory\AppFactory;
use app\database\builder\InsertQuery;

require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require __DIR__ . '/../app/helper/setting.php';

require __DIR__ . '/../app/route/route.php';



$app->run();

/*$Values = [
    'nome_fantasia' => 'Gambiarra & CIA',
    'cpf_cnpj' => '123',
    'rg_ie' => '321'
];*/

/*InsertQuery::table('empresa')->save($Values);
die;*/

/*$dir = __DIR__ . '/../app/route/route.php';
if (file_exists($dir)) {
    echo "o arquivo de rotas existe";
} else {
    echo "o arquivo de rotas nao existe";
}
var_dump($dir);
die;*/