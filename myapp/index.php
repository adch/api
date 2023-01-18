<?php

declare(strict_types=1);

//autoload all classes in the src folder
require dirname(__DIR__) . "/vendor/autoload.php"; 

//errorHandlerr Class
set_exception_handler("ErrorHandler::handleException"); 

//use Dotenv\Dotenv;
//db connection
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$path = PARSE_URL($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$parts = explode("/", $path);

//print_r($parts)

$resource = $parts[3];

$id = $parts[4] ?? null;

//echo $resource, ", ", $id;

//echo "<br>" . $_SERVER["REQUEST_METHOD"], "\n";

if ($resource != "tasks"){

    //header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
    http_response_code(404);
    exit;
}

//require dirname(__DIR__) . "/src/TaskController.php";

//set header returned type to json format
header("Content-type: application/json; charset=UTF-8"); 

//DATABASE connection 
// instead install an env file with composer from https://packagist.org/packages/vlucas/phpdotenv
$database = new Database($_ENV["DB_HOST"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASS"]);

//way to check the connection with getConnection call
//$database->getConnection();
$task_gateway = new TaskGateway($database);

//create object of the class from TaskController.php
$controller = new TaskController($task_gateway);

//call the procceRequest method
$controller->proccessRequest($_SERVER['REQUEST_METHOD'], $id); 

