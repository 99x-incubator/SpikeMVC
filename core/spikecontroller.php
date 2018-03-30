<?php

class SpikeController {

    public $dataBag;

    function __construct(){
        $this->dataBag = new stdClass();
    }

    protected function view($fileName = null){
        require_once(dirname(__FILE__) . "/renderers/viewrenderer.php");
        return new ViewRenderer($this->dataBag, $fileName == null ? SpikeMVC::$config->viewFile : $fileName);
    }

    protected function json(){
        require_once(dirname(__FILE__) . "/renderers/jsonrenderer.php");
        return new JsonRenderer($this->dataBag, null);
    }

    public function get($request){

    }

    public function post($request){

    }

    public function put($request){

    }

    public function delete($request){

    }
}

?>