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
                echo parent::render('Login');

            }

            public function logIn () {


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
                        header('location: /AdminHome');
                    }
                    else if ($check->adminbool==false && $check->bool==true)
                    {
                        header('location: /');
                    }
                    var_dump($check);


                }



            }


        }
?>