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

                var_dump(parse_url($_SERVER['REQUEST_URI'],PHP_URL_QUERY));
                $url=trim($_SERVER['REQUEST_URI'],"/");
                $parts=explode('/',$url);
                $controller=$parts[0];
                $controllerfile='Controllers/'.ucfirst($controller).'Controller.php';
                $controllerclass='Controllers\\'.ucfirst($controller).'Controller';
                var_dump($controllerclass);
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
