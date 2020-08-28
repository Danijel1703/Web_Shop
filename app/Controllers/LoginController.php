<?php

namespace Controllers;
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
                    $check->getAuth();
                    var_dump($check);
                }



            }
            public function index()
            {
                $this->Login();
            }


        }
?>