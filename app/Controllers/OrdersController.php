<?php

namespace Controllers;
use http\Header;
use Models\Product;
use Models\ProductStorage;
use Models\View;
use Models\UserStorage;
use Models\User;
use PDO;

class OrdersController extends View {


    protected $db;
    protected $items=[];


    public function __construct(PDO $db)
    {
        $this->db=$db;
        $this->items = $this->getItems();
    }
    public function display()
    {
        echo "<style>";
        require ('CSS/Orders.css');
        echo "</style>";
        echo parent::render('Orders',['items'=>$this->items]);
    }
    public function getItems()
    {
        $statement = $this->db->prepare("
                    SELECT product_name,user,quantity,image FROM cart
                    ");
        $statement->setFetchMode(PDO::FETCH_CLASS, Product::class);
        $statement->execute();
        return $statement->fetchAll();
    }





}

?>