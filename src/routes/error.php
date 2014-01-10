<?php
class ErrorHandler
{
    public function __construct()
    {
        $self = $this;
        $app = Slim\Slim::getInstance();
        $app->error(function (\Exception $e) use ($app, $self)
        {
            // log error message
            echo "Something went wrong";
        });
        $app->notFound(function () use ($app, $self) {
            echo "404";
        });
    }
    public static function invalidRequest($status)
    {
        echo "Invalid request";
    }
}
$ErrorHandler = new ErrorHandler();