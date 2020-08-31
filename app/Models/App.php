<?php

        namespace Models;



use Controllers\HomeController;

  class App {

    protected $container;

    public function __construct()
    {

        $this->container=new Container();

    }

    public function getContainer()
    {
      return $this->container;
    }

    public function route()
      {
                $url=$_SERVER['REQUEST_URI'];
                $parts=explode('/',$url);
                $controller=$parts[1];
                $controllerfile='Controllers/'.ucfirst($controller).'Controller.php';
                var_dump($controllerfile);
                $controllerclass='Controllers\\'.ucfirst($controller).'Controller';
                if(file_exists($controllerfile))
                {

                    return new $controllerclass($this->container->db);

                }
               if($controller=='' || $controller=='Home')
               {
                   return new HomeController();

               }



      }
             public function run()
            {

            return $this->route();
            }


  }

 ?>
