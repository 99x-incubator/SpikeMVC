<?php

    require dirname(__FILE__) . "./vendor/mustache/mustache/src/Mustache/Autoloader.php";
    Mustache_Autoloader::register();

    class MustacheTemplateEngine extends AbstractEngine {
        
        public function render($object, $file){
            $fileContents = file_get_contents($file);
            $m = new Mustache_Engine;
            $mustacheOutput = $m->render($fileContents, $object);
            echo $mustacheOutput;
        }

    }

    return new MustacheTemplateEngine();
?>