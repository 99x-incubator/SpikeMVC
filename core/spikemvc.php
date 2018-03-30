<?php
    require_once (dirname(__FILE__) . "/spikecontroller.php");

    class SpikeMVC {
        
        public static $config;

        public static function handle(){
            SpikeMVC::initialize();
            SpikeMVC::dispatch();
        }


        private static function initialize(){
            $config = new stdClass();
            $config->folders = new stdClass();
            $config->folders->pwd = getcwd();
            $config->folders->pages = getcwd() . "/pages";
            SpikeMVC::$config = $config;
        }

        private static function dispatch(){
            $config = SpikeMVC::$config;
            $relativeFolder = str_replace($_SERVER["DOCUMENT_ROOT"],"", str_replace("\\","/",$config->folders->pwd));
            
            $controllerFolder = str_replace($relativeFolder, "", $_SERVER["REQUEST_URI"]);
            $fullControlFolder = $config->folders->pages . "$controllerFolder";
            SpikeMVC::executeController($fullControlFolder);
        }

        private static function executeController($fullControlFolder, $parentError = null){
            $config = SpikeMVC::$config;
            $controllerFile = "$fullControlFolder/controller.php";
            $config->viewFile = "$fullControlFolder/view.html";
            if (file_exists($controllerFile)){
                $controller = require_once ($controllerFile);
                $controllerMethod = strtolower($_SERVER["REQUEST_METHOD"]);
                $renderer = $controller->$controllerMethod(SpikeMVC::getRequest());
                
                $httpCode = http_response_code ();

                if ($httpCode == 200){
                    if (isset($renderer))
                        $renderer->render();
                    else {
                        
                    }
                }else {
                    if (isset($parentError)){
                        $renderer->render();
                    }else {
                        $errorFolder = $config->folders->pages . "/_$httpCode/";
                        if (file_exists($errorFolder))
                            SpikeMVC::executeController($errorFolder, $httpCode);
                        else 
                            SpikeMVC::displayError("HTTP Error Occured",$httpCode);
                    }
                }
            }
            else {
                $errorFolder = $config->folders->pages . "/_404/";
                if (file_exists($errorFolder))
                    SpikeMVC::executeController($errorFolder, 404);
                else
                    SpikeMVC::displayError("Resource Not Found",404);
            }   
        }

        private static function displayError($message, $code = null){
            $errorObj = new stdClass();
            $errorObj->httpCode = $code;
            $errorObj->message = $message;

            if (isset($code))
                http_response_code($code);
            else 
                http_response_code(404);
            
            header ("Content-type: application/json");
            echo json_encode($errorObj, JSON_PRETTY_PRINT);
        }

        private static function getRequest(){
            $req = new stdClass();
            $req->headers = array();
            $req->body = $_POST;

            foreach (getallheaders() as $name => $value)
                $req->headers[strtolower($name)] = $value;

            return $req;
        }
        
    }
?>