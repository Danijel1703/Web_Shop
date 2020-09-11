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
                $parts=explode('/',$url);
                $controller=$parts[0];
                $controllerfile='Controllers/'.ucfirst($controller).'Controller.php';
                $controllerclass='Controllers\\'.ucfirst($controller).'Controller';
                if(file_exists($controllerfile))
                {
                    $controllerclass=new $controllerclass($this->container->db);
                    if(isset($parts[1]))
                    {
                        $method=$parts[1];
                        $idparts=explode('?',$method);
                        if(isset($idparts[1]))
                        {
                            $fullid='?'.$idparts[1];
                            $fullidint=explode('=',$idparts[1]);

                            if(isset($fullid))
                            {
                                $method=rtrim($method,$fullid);
                            }

                        }
                        $controllerclass->$method();


                    }
                    else
                    {
                        $controllerclass->display();
                    }

                }
               else if($controller=='' || $controller==='Home')
               {
                   $home= new HomeController();
                   return $home->display();
               }
      }
      public function run()
      {
        return $this->route();
      }


  }

 ?>
