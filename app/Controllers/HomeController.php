<?php

            namespace Controllers;
            use Models\App;
            class HomeController
            {

                   public function __construct()
                   {
                       $this->index();

                   }
                   public function index()
                   {
                            echo 'Običan';

                       if(isset($_SESSION['username']))
                       {

                           echo "<br>".$_SESSION['username'];
                       }
                   }


            }

    ?>
