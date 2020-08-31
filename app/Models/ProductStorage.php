<?php


namespace Models;
use Controllers\AdminStoreController;
use PDO;

class ProductStorage
{
    public $db;
    public function __construct(PDO $db)
    {
            $this->db=$db;
    }
    public function StoreItems($product)
    {

            $statement=$this->db->prepare("
                    SELECT * FROM products
                    ");
            $statement->setFetchMode(PDO::FETCH_CLASS,Product::class);
            $statement->execute();
            $items=$statement->fetchAll();
            $statement=$this->db->prepare("
            
            INSERT INTO products (product_name,product_price,product_quantity)
            VALUES (:product_name,:product_price,:product_quantity)
            
            ");
            $statement->execute([

            'product_name' => $product->getProductname(),
            'product_price' => $product->getProductprice(),
            'product_quantity' => $product->getProductquantity(),

            ]);



    }



}


?>