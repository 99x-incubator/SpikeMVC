<?php
    require_once (dirname(__FILE__) . "/rendarable.php");
    
    class JsonRenderer extends Renderable {
        private $obj;
        private $data;

        function __construct($obj,$data){
            $this->obj = $obj;
            $this->data = $data;
        }

        public function render(){
            header ("Content-type: application/json");
            echo json_encode($this->obj, JSON_PRETTY_PRINT);
        }
    }
?>