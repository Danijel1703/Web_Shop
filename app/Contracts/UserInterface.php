<?php

        namespace Contracts;

        interface UserInterface{
            public function setUsername($username);
            public function setPassword($password);
            public function setFirstName($firstname);
            public function setLastName($lastname);
            public function setEmail($email);
        }

?>
