<?php
    class Controller extends SpikeController {
        
        public function get($request){
            $this->dataBag->name = "supun";
            return $this->view();
        }
        
    }

    return new Controller();
?>