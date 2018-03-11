<?php
/**
 *  this class used to hide files of application
 *  and get user actions
 */
namespace application\core;
use application\controllers as controller;

class Route
{
    private $url;
    private $method;    

    /**
     *  Recives method of query and  url
     *  if CROSS_QUERR = true 
     *  allows cross domain queries
     */
    public function __construct()
    {
        if(CROSS_QUER)
        {
            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS, DELETE, PATCH');
            header("Access-Control-Max-Age: 3600");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type,token, Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
            header("Access-Control-Expose-Headers: Location");
        } 
        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Creating instanse of controller that client needs
     */
    public function start()
    {
        list($server, $user, $dir, $taskDir , $serverDir , $apiDir, $className, $input) = explode('/', $this->url, 8);
        //list($server, $dir, $serverDir,$apiDir ,$className, $input) = explode('/', $this->url, 6);
        $className[0] = strtoupper($className[0]); 
        $controllerName = 'Controller' . $className;
        $controllerClass = 'application\controllers\\Controller' . $className;

        $controllerFile = $controllerName . '.php';
        $controllerPath = "application/controllers/" . $controllerFile;
        if(!file_exists($controllerPath))
        {
            $this->ErrorPage404();	
        }
        switch($this->method)
        {
        case 'GET':
            $controller = new $controllerClass($className);
            if(method_exists($controller, 'actionGet'))
            {
                $controller->actionGet($input);
            }
            else
            {
                $this->ErrorPage404();
            }
            break;
        case 'POST':
            $controller = new $controllerClass($className);
            if(method_exists($controller, 'actionPost'))
            {
                $controller->actionPost($input);
            }
            else
            {
                $this->ErrorPage404();
            }
            break;
        case 'DELETE':
            $controller = new $controllerClass($className);
            if(method_exists($controller, 'actionDelete'))
            {
                $controller->actionDelete($input);
            }
            else
            {
                $this->ErrorPage404();
            }
            break;
        case 'PUT':
            $controller = new $controllerClass($className);
            if(method_exists($controller, 'actionPut'))
            {
                $controller->actionPut($input);
            }
            else
            {
                $this->ErrorPage404();
            }
            break;
        case 'OPTIONS':
            
            break;
        default:
            $this->ErrorPage404();
        } 

    } 

    /**
     * redirects user on 404 screen
     */
    public function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

}
