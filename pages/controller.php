<?php

class Controller extends SpikeController {
        
    public function get($request){
        http_response_code(500);
        $this->dataBag->name = "supun";
        return $this->view();
    }
    
}

return new Controller();
?>