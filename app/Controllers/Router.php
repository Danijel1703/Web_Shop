<?php

            namespace Controllers;


        class Router{

        protected $routes=[];
        protected $path;
        protected $methods=[];

        public function setPath($path='/')
        {
            $this->path=$path;
        }

        public function addRoute($uri,$handler,$methods=['GET'])
        {
            $this->routes[$uri]=$handler;
            $this->methods[$uri]=$methods;

        }
        public function getResponse()
        {

                return $this->routes[$this->path];

        }
    }



?>
