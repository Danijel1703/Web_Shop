<?php

            namespace Controllers;
            use Models\App;
            use Models\UserStorage;
            use Models\User;
            class AdminHomeController
            {

                   public function __construct()
                   {
                       $this->index();

                   }
                   public function index()
                   {
                       echo 'Admin';
                       if(isset($_SESSION['username']))
                       {

                           echo "<br>".$_SESSION['username'];
                       }
                   }


            }

    ?>
