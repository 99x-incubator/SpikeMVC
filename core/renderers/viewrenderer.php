<?php
    require_once (dirname(__FILE__) . "/rendarable.php");
    require_once (dirname(__FILE__) . "/abstractengine.php");

    class ViewRenderer extends Renderable {
        
        private $obj;
        private $data;

        function __construct($obj, $data){
            $this->obj = $obj;
            $this->data = $data;
        }

        public function render(){
            $engineObj = require_once (dirname(__FILE__) . "/defaultengine.php");
            $engineObj->render($this->obj,$this->data);
        }
    }

?>