<?php

            namespace Controllers;
            use Models\App;
            use Models\View;
            class HomeController extends View
            {

                   public function __construct()
                   {
                       echo parent::render('Home');

                   }



            }

    ?>
