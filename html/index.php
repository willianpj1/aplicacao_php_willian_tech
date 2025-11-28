<?php

use Slim\Factory\AppFactory;

use app\database\builder\DeleteQuery;

require __DIR__ . '/../vendor/autoload.php';

/*DeleteQuery::table('cliente')->where('id', '=', '1')->delete();
DeleteQuery::table('cliente')->where('id', '=', '2')->delete();
DeleteQuery::table('cliente')->where('id', '=', '3')->delete();
DeleteQuery::table('cliente')->where('id', '=', '4')->delete();
DeleteQuery::table('cliente')->where('id', '=', '5')->delete();
DeleteQuery::table('cliente')->where('id', '=', '6')->delete();
DeleteQuery::table('cliente')->where('id', '=', '7')->delete();
DeleteQuery::table('cliente')->where('id', '=', '8')->delete();
DeleteQuery::table('cliente')->where('id', '=', '9')->delete();
DeleteQuery::table('cliente')->where('id', '=', '10')->delete();*/

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require __DIR__ . '/../app/helper/settings.php';
require __DIR__ . '/../app/route/route.php';

$app->run();
