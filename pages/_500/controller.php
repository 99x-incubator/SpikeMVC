<?php
    class Controller_500 extends SpikeController {
        
        public function get($request){
            return $this->view();
        }
        
    }

    return new Controller_500();
?>