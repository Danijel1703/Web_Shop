<?php

namespace Controllers;
use Models\UserStorage;
use Models\User;
use PDO;
use Models\View;

        class LoginController extends View {

            protected $db;


            public function __construct(PDO $db)
            {
                $this->db=$db;
                $this->index();

            }

            public function Login () {
                echo parent::render('Login');


                if(isset($_POST['submit']))

                {
                    $user=new User();
                    $user->setUsername($_POST['username']);
                    $user->setPassword($_POST['password']);
                    $check=new UserStorage($this->db);
                    $check->authentication($user);
                    $check->getUserBool();
                    $check->getAdminBool();
                    $check->bool;
                    echo '<br>';
                    echo $check->adminbool;
                    if($check->adminbool==true)
                    {
                        header('location: AdminHome');
                    }
                    else if ($check->adminbool==false && $check->bool==true)
                    {
                        header('location: Home');
                    }
                    var_dump($check);


                }



            }
            public function index()
            {
                $this->Login();
            }


        }
?>