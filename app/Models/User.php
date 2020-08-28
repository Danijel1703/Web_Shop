<?php

            namespace Models;
            use Contracts\UserInterface;

            class User implements UserInterface {

                public $username;
                public $password;
                public $firstname;
                public $lastname;
                public $email;

                public function setUsername($username){

                    $this->username=$username;

                }
                public function getUsername(){

                    return $this->username;
                }
                public function setPassword($password)
                {
                    $this->password=$password;
                }
                public function getPassword()
                {
                    return $this->password;
                }
                public function setFirstName($firstname){

                    $this->firstname=$firstname;

                }
                public function getFirstName(){

                    return $this->firstname;
                }
                public function setLastName($lastname)
                {
                    $this->lastname=$lastname;
                }
                public function getLastName()
                {
                    return $this->lastname;
                }
                public function setEmail($email){

                    $this->email=$email;

                }
                public function getEmail(){

                    return $this->email;
                }



            }


?>
