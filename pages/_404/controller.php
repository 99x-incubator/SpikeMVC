<?php
    class Controller_404 extends SpikeController {
        
        public function get($request){
            $this->dataBag->name = "supun";
            return $this->view();
        }
        
    }

    return new Controller_404();
?>