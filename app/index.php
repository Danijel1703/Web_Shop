<?php

    require_once('autoloader.php');

    use Controllers\HomeController;
    use Controllers\SignupController;
    use Models\App;
    use Controllers\LoginController;



    $app=new App;
    $container= $app->getContainer();
    $container['errorHandler']=function (){

    };
    $container['config']= function (){

    return [
        'db_driver'=>'mysql',
        'db_host'=>'localhost',
        'db_name'=>'UsersStorage',
        'db_user'=>'inchoo',
        'db_password'=>'password',

      ];
    };

    $container['db']= function ($c){

        return new PDO(

            $c->config['db_driver'] . ':host=' . $c->config['db_host'] . ';dbname=' . $c->config['db_name'],
            $c->config['db_user'],
            $c->config['db_password']

        );};



        /*$app->map('/signup',[new SignupController($container->db),'StoreAndCheck'],['GET','POST']);
        $app->map('/login',[new LoginController($container->db),'LogIn'],['GET','POST']);

        $app->map('/',[new HomeController,'index']);
        */
        $app->route();
        $app->run();

        ?>
