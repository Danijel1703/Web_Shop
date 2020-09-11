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
            }
            public function display()
            {
                echo "<style>";
                require ('CSS/Login.css');
                echo "</style>";
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

                }



            }
            public function logout()
            {

                unset($_SESSION['user']);
                unset($_SESSION['logged']);

                header('location: /Home');
            }
        }
?>