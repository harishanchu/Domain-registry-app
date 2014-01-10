<?php
require 'vendor/autoload.php';

//Start session
@session_cache_limiter(false);
@session_start();

require 'config.php';
require 'lib/views/myview.php';

$app = new \Slim\Slim(array('mode' => APP_MODE,
    'templates.path' => 'src/views',
    'view' => new myview(),
));

$app->setName(PROJECT_NAME);
myview::set_layout('layout.php');

$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'debug' => false
    ));
});

$app->configureMode('development', function () use ($app) {
    error_reporting(-1);
    ini_set('display_errors', 'On');
    ini_set('html_errors', 'On');
    $app->config(array(
        'debug' => true
    ));
});

//DB connection
try
{
    //Connect to database
    $conn = new Mongo(DB_SERVER);
    $dbname = DB_NAME;
    $db = $conn->$dbname;

    //Bind with slim
    $app->db = $db;
    $app->conn = $conn;
}
catch (MongoConnectionException $e)
{
    die('Error connecting to MongoDB server');
}
catch (MongoException $e)
{
    die('Error: ' . $e->getMessage());
}

// include routes
require 'src/routes/index.php';
require 'src/routes/error.php';
//include models
require 'src/models/app.model.php';