<?php

class Controller extends SpikeController {
        
    public function get($request){
        return $this->view();
    }
    
}

return new Controller();
?>