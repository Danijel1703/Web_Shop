<?php

        namespace Models;



use Controllers\HomeController;
use Controllers\Router;

  class App {

    protected $container;

    public function __construct()
    {

        $this->container=new Container([
            'router'=>function ()
            {
              return new Router;
            },]);

    }

    public function getContainer()
    {
      return $this->container;
    }
    /*public function get($uri,$handler)
    {
        $this->container->router->addRoute($uri,$handler,['GET']);
    }
        public function post($uri,$handler)
    {
        $this->container->router->addRoute($uri,$handler,['POST']);
    }
          public function map($uri,$handler, $methods=['GET','POST'])
    {
        $this->container->router->addRoute($uri,$handler,$methods);
    }*/

      public function route()
      {
                $url=$_SERVER['REQUEST_URI'];
                $parts=explode('/',$url);
                $controller=$parts[1];
                var_dump($controller);
                $controllerfile='Controllers/'.ucfirst($controller).'Controller.php';
                var_dump($controllerfile);
                $controllerclass='Controllers\\'.ucfirst($controller).'Controller';
                if(file_exists($controllerfile))
                {

                    $this->container->router->addRoute($url,[new HomeController(),'index']);

                }
               if($controller=='' || $controller=='Home')
               {
                   $this->container->router->addRoute($url,[new HomeController(),'index']);

               }
               else
               {
                   $this->container->router->addRoute($url,[new $controllerclass($this->container->db),'index']);

               }







      }
    public function run()
    {
        $router= $this->container->router;
        $router->setPath($_SERVER['PATH_INFO'] ?? '/');

            $response = $router->getResponse();
            return $this->process($response);



    }

      public function process($callable)
      {
          if(is_array($callable))
          {
              if(!is_object($callable[0]))
              {
                  $callable[0] = new $callable[0]();
              }

              return call_user_func($callable);
          }
          return $callable;
      }
  }

 ?>
