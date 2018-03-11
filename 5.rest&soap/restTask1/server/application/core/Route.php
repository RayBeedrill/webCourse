<?php

class Route
{
    /**
     *    * inits routing explodes request on parts and includes 
     *       * need files
     *           * 
     *               */
    public static function start()
    {
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        list($server, $user, $dir, $serverDir , $apiDir, $className, $data) = explode('/', $url, 7);
               
        switch($method)
        {
        case 'GET':
            $obj = new $className;
            $obj->hello($data); 
            break;
        case 'DELETE':
            break;
        case 'POST':
            break;
        case 'PUT':
            break;
        default:
            return false;
        } 

    } 
    /**
     *    * redirects user on 404 screen
     *        */
    public static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}

Route::start();
