<?php

namespace Controllers;
use Models\App;
use Models\View;

class TotalController extends View
{

    public function __construct()
    {

    }
    public function display()
    {

        echo parent::render('Total');

    }



}

?>
