<?php

namespace Controllers;
use Models\UserStorage;
use Models\User;
use PDO;
use Models\View;


class SignupController extends View {

        protected $db;
        protected $signup;
        public function __construct(PDO $db)
        {
            $this->db=$db;
            $this->StoreAndCheck();

        }

        public function StoreAndCheck()
        {
            echo parent::render('SignUp');
            if(isset($_POST['submit']))
            {
                $user=new User();
                $user->setUsername($_POST['username']);
                $user->setPassword($_POST['password']);
                $user->setEmail($_POST['email']);
                $user->setFirstName($_POST['firstname']) ;
                $user->setLastName($_POST['lastname']);
                $storage=new UserStorage($this->db);
                $storage->StoreUsers($user);

            }
        }




}


?>