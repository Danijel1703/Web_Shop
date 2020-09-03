<?php


namespace Controllers;

use Models\Product;
use Models\ProductStorage;
use Models\View;
use Models\UserStorage;
use Models\User;
use PDO;

class EditProductController extends View
{

    protected $db;
    protected $items = [];

    public function __construct(PDO $db)
    {
        $this->db = $db;
        echo parent::render('EditProduct', ['items' => $this->items]);


    }
    public function editProduct()
    {

        if(isset($_POST['submit']))
        {

           $update=new Product();
           $update->setProductname($_POST['product_name']);
           $update->setProductprice($_POST['product_price']);
           $update->setProductquantity($_POST['product_quantity']);
           $update->setProductdescription($_POST['product_description']);
           $update->setId($_POST['id']);
           $storage=new ProductStorage($this->db);
           $storage->updateItems($update);
           //header('location: /SelectEditProduct');
       }
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