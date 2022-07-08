<?php


namespace App\Http;

class Route
{

    public static array $routes = [];

    public static function resolve()
    {

        // the full url
        $url = $_SERVER['PHP_SELF'];

        $e_url = explode("index.php",$url,2);


        $url = trim($e_url[1],"/");

        $url = $url === ""?"/":$url;

        $method = strtolower($_SERVER['REQUEST_METHOD']);


        if (self::$routes[$method] === null) {
            return "method doesn't exists";
        }

        if (!key_exists($url, self::$routes[$method])) {
            return "the request url is not found!";
        }

        $action = self::$routes[$method][$url];

        if (is_array($action)) {

            $controller = new $action[0];
            $method = $action[1];
            return call_user_func_array([$controller, $method], []);
        } else {
            return call_user_func_array($action, []);
        }
    }


    public static function get($url, $handler)
    {
        $method = "get";
        self::addRoute($url, $handler, $method);
    }
    public static function post($url, $handler)
    {   
        $method = "post";
        self::addRoute($url,$handler,$method);
    }

    private static function addRoute($url,$handler,$method){
        $url = trim($url, "/") == "" ? "/" : trim($url, "/");
        self::$routes[$method][$url] = $handler;
    }
}
