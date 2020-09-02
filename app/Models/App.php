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
                $url=trim($_SERVER['REQUEST_URI'],"/");
                //$parseurl=parse_url($_SERVER['REQUEST_URI']);

                $parts=explode('/',$url);
                $controller=$parts[0];
                $controllerfile='Controllers/'.ucfirst($controller).'Controller.php';
                var_dump($controllerfile);
                $controllerclass='Controllers\\'.ucfirst($controller).'Controller';
                if(file_exists($controllerfile))
                {
                    $controllerclass=new $controllerclass($this->container->db);
                    if(isset($parts[1]))
                    {
                        $method=$parts[1];
                        $controllerclass->$method();

                    }
                    else {
                        return $controllerclass;
                    }


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
