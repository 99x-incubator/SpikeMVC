<?php
    class Controller_404 extends SpikeController {
        
        public function get($request){
            return $this->view();
        }
        
    }

    return new Controller_404();
?>