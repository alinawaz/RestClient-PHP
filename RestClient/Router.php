<?php

namespace RestClient;

class Router extends ErrorHandling {

    private static $routes = array();
    private static $params = array();

    public static function get($path, $target) {
        Router::$routes[$path] = $target;
    }

    public static function extend($routeFileName){
        require 'Config/'.$routeFileName.'.php';
    }

    public static function run($url) {
        if (self::isRoute($url)) {
            if (self::isString($url)) {
                self::handleString($url);
            } else {
                self::handleCallback($url);
            }
        }
        echo errorHandling::display(404);
        exit;
    }

    private static function isRoute($url) {
        self::handleParameters($url);
        if (isset(self::$routes[$url])) {
            return true;
        }
        if (isset(self::$params[$url])) {
            return true;
        }
        return false;
    }

    private static function isString($url) {
        //echo "URL: ".$url.'<br/> ROUTES: ';
        //var_dump(self::$routes);
        //echo '<br/> PARAMS: ';
        //var_dump(self::$params);
        //if (isset(self::chooseUrlProvider($url))) {
        if (is_string(self::chooseUrlProvider($url))) {
            return true;
        }
        //}
        return false;
    }

    private static function handleCallback($url) {
        $parameterizedCallbackOrSimpleCallback = (isset(self::$params[$url]['orignal'])?self::$routes[self::$params[$url]['orignal']]:self::$routes[$url]);
        if (is_callable($parameterizedCallbackOrSimpleCallback)) {
            $func = $parameterizedCallbackOrSimpleCallback;
            $GLOBALS['current_route'] = $url;
            unset(self::$params[$url]['orignal']);            
            if(isset(self::$params[$url])){
                echo call_user_func_array($func, self::$params[$url]);
            }else{
                echo call_user_func_array($func,Array());
            }
            exit;
        } else {
            echo errorHandling::display(404);
            exit;
        }
    }

    private static function handleString($url) {
        //var_dump(self::$routes[self::$params[$url]['orignal']]);
        //d($url);
        //dd(self::$params);
        //echo self::$routes[$url];
        $args = explode('@', self::chooseUrlProvider($url));
        if (count($args) > 1) {
            $controllerName = '\\Controllers\\' . $args[0];
            $methodName = $args[1];
            $controller = new $controllerName();
            $GLOBALS['current_route'] = $url;
            unset(self::$params[$url]['orignal']); //Fix: Removing undeed Params
            if (self::$params)
                echo call_user_func_array(array($controller, $methodName), self::$params[$url]);
            if (!self::$params)
                echo call_user_func(array($controller, $methodName));
            exit;
        } else {
            echo errorHandling::display(404);
            exit;
        }
    }

    private static function chooseUrlProvider($url) {
        //d(self::$params);
        //d($url);
        //dd(self::$params[$url]['orignal']);
        return (self::$params ? self::$routes[self::$params[$url]['orignal']] : self::$routes[$url]);
    }

    private static function handleParameters($url) {
        self::matchRoutes($url);
    }

    private static function matchRoutes($url) {
        $parsedUrl = self::parseUrl($url);
        $routes = self::parseRouteUrls();
        for ($i = 0; $i < count($routes['parsed']); $i++) {
            if (is_array($routes['parsed'][$i]) && is_array($parsedUrl)) {
                if (self::isRouteBalanced($routes['orignal'][$i],$url)) {
                    self::mapUrlBlocks($parsedUrl, $url, $routes['parsed'][$i], $routes['orignal'][$i], count($parsedUrl));
                }
            }            
        }
    }

    private static function isRouteBalanced($givenUrl, $expectedUrl){
        $given = explode('/',$givenUrl);
        $expected = explode('/',$expectedUrl);
        for ($i=0; $i < count($expected); $i++) {
            if(isset($given[$i])){
                if(match($given[$i],'{*}')){
                    // Ignore
                }else{
                    if($expected[$i]!=$given[$i])
                        return FALSE;
                }
            }
        }
        return TRUE;
    }

    private static function mapUrlBlocks($urlBlock, $urlBlockOrignal, $routeUrlBlock, $routeUrlBlockOrignal, $blockCount) {
        $optionalParamNumber = 0;
        if(count($urlBlock)==count($routeUrlBlock)){ // Fix: Parsing Matching
            for ($i = 0; $i < count($routeUrlBlock); $i++) {
                /* Hanlding Optional Params */
                //echo "Checking optional for ".$routeUrlBlock[$i]." <br/>";
                if(self::checkOptionalParam($routeUrlBlock[$i])){
                    //echo "ADDED: ".$routeUrlBlock[$i].' = '.' '.'<br/>';
                    self::$params[$urlBlockOrignal]['OP'.$optionalParamNumber ] = (isset($urlBlock[$i])?$urlBlock[$i]:'');
                    self::$params[$urlBlockOrignal]['orignal'] = $routeUrlBlockOrignal;
                    $optionalParamNumber ++;
                }else{
                    /* Proper Matching */
                    //$urlBlock[$i] = (isset($urlBlock[$i])?$urlBlock[$i]:'');
                    if (self::matchUrlBlock($urlBlock[$i], $routeUrlBlock[$i]) == 2) {
                        //echo "ADDED: ".$routeUrlBlock[$i].' = '.$urlBlock[$i].'<br/>';
                        self::$params[$urlBlockOrignal][$routeUrlBlock[$i]] = $urlBlock[$i];
                        self::$params[$urlBlockOrignal]['orignal'] = $routeUrlBlockOrignal;
                        //echo "Add Complete ... <br/>";
                    }
                }
            }
        }

        //var_dump(self::$params[$urlBlockOrignal]);echo '<br/>';
    }

    private static function checkOptionalParam($param){
        if (strpos($param, '{?}') !== false)
            return TRUE;
        return FALSE;
    }

    private static function matchUrlBlock($urlBlock, $routeUrlBlock) {
        if ($urlBlock == $routeUrlBlock)
            return 1;
        if (strpos($routeUrlBlock, '{') !== false)
            return 2;
        return false;
    }

    private static function parseRouteUrls() {
        $routeUrlArray = array();
        $routeUrlOrignal = array();
        foreach (self::$routes as $key => $value) {
            $routeUrlArray[] = self::parseUrl($key);
            $routeUrlOrignal[] = $key;
        }
        return [
            'parsed' => $routeUrlArray,
            'orignal' => $routeUrlOrignal
        ];
    }

    private static function parseUrl($url) {
        return explode('/', $url);
    }

}
