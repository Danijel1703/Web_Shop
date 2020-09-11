<?php

            namespace Controllers;
            use Models\App;
            use Models\View;

            class HomeController extends View
            {

                   public function __construct()
                   {

                   }
                   public function display()
                   {
                       echo "<style>";
                       require ('CSS/Home.css');
                       echo "</style>";

                       echo parent::render('Home');
                   }



            }

    ?>
