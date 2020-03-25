<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
// Подключение автозагрузки через composer
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);


$app->get('/', function ($request, $response) {
    return $response->write('Welcome to Slim!');
});

$companies = App\Generator::generate(100);


/**
 * Example page with pagination
 */
$app->get('/companies', function ($request, $response) use ($companies) {
    $page = $request->getQueryParam('page', 1);
    $per = $request->getQueryParam('per', 5);
    $offset = ($page - 1) * $per;

    $paginated_companies = array_slice($companies, $offset, $per);
    return $response->write(json_encode($paginated_companies));
});

$app->run();
