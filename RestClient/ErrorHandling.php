<?php

namespace RestClient;

use Config\Config;

class ErrorHandling {

    private static $ignoreTraces = array(
        'RestClient\Core\errorHandling.php',
        'index.php',
        'RestClient\Core\Client.php',
        'RestClient\Route.php'
    );

    public static function display($code) {
        switch ($code) {
            case 100:
                self::throwError("Requested Method Not Allowed", false);
            case 404:
                self::throwError("Requested Resource Not Found", false);
            default:
                self::throwError("Unexpected Error Occured", false);
        }
    }

    public static function displaySystem($errno, $errstr, $errfile, $errline) {
        $temp = debug_backtrace();
        $trace = '';
        if (count(explode(Config::$baseUrl . '/', $errfile)) > 1)
            $errfile = str_replace('/', '\\', explode(Config::$baseUrl . '/', $errfile)[1]);
        $trace .='<p><i class="fa fa-bug" aria-hidden="true"></i> <b>' . $errfile . '</b> Line:' . $errline . '</p>';
        if ($temp) {
            foreach ($temp as $t) {
                if (isset($t['file'])) {
                    if (count(explode(Config::$baseUrl . '/', $t['file'])) > 1)
                    $t['file'] = str_replace('/', '\\', explode(Config::$baseUrl . '/', $t['file'])[1]);
                    if (!in_array($t['file'], self::$ignoreTraces))
                        $trace .='<p><i class="fa fa-bug" aria-hidden="true"></i> <b>' . $t['file'] . '</b> Line:' . $t['line'] . '</p>';
                }
            }
        }
        switch ($errno) {
            case E_USER_ERROR:
                self::throwError($errstr);
                break;

            default:
                self::throwError($errstr);
                break;
        }
    }

    public static function displayCustom($message, $debugMessage = '') {
        self::throwError($message, true, $debugMessage);
    }

    private static function throwError($message, $tracing = true, $debugMessage = '') {
        $temp = debug_backtrace();
        $trace = '';
        if ($debugMessage != '')
            $trace .='<p><i class="fa fa-comment-o" aria-hidden="true"></i> <b>' . $debugMessage . '</p>';
        foreach ($temp as $t) {
            if (isset($t['file'])) {
                if (count(explode(Config::$baseUrl . '/', $t['file'])) > 1)
                    $t['file'] = str_replace('/', '\\', explode(Config::$baseUrl . '/', $t['file'])[1]);
                if (!self::isTraceIgnored($t['file']))
                    $trace .='<p><i class="fa fa-file-o" aria-hidden="true"></i> <b>' . $t['file'] . '</b> Line:' . $t['line'] . '</p>';
            }
        }
        echo '<title>Error</title><link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">'
        . "<center><i style='font-size: 100px;' class='fa fa-exclamation-circle' aria-hidden='true'></i>"
        . "<div style='margin: 25px; width: 800px; height: auto;"
        . " background-color: lightgrey;padding: 20px;text-align: left;border-radius: 10px;'>"
        . "<p><i class='fa fa-align-left' aria-hidden='true'></i> " . $message . "</p>" . ($tracing ? $trace : '') . "</div></center>";
        exit;
    }

    private static function isTraceIgnored($traceString){
        for ($i=0; $i < self::$ignoreTraces; $i++) { 
            if (strpos($traceString, self::$ignoreTraces[$i]) === false)
                return TRUE;
        }
        return FALSE;
    }

}
