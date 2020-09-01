<?php


namespace Controllers;

use Models\Product;
use Models\ProductStorage;
use Models\View;
use Models\UserStorage;
use Models\User;
use PDO;

class SelectEditProductController extends View
{

    protected $db;
    protected $items = [];


    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function selectProduct()
    {
        $this->items = $this->getItems();
        echo parent::render('SelectEditProduct', ['items' => $this->items]);
    }

    public function getItems()
    {
        $statement = $this->db->prepare("
                    SELECT * FROM products
                    ");
        $statement->setFetchMode(PDO::FETCH_CLASS, Product::class);
        $statement->execute();
        return $statement->fetchAll();
    }


}


?>