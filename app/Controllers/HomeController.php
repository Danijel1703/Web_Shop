<?php

            namespace Controllers;
            use Models\App;
            class HomeController
            {

                   public function __construct()
                   {


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
