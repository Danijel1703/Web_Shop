<?php


namespace Models;
use Controllers\InputproductsController;
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
            $product_quantity=$product->getProductquantity();
            $quantity_update=$product->getquantityupdate();
            //$total= $quantity_update + $product_quantity;

            $namebool=false;
            foreach ($items as $item)
            {

                if($item->product_name==$product->getProductname())
                {
                    die('Postoji');
                }


            }

            if($namebool==false)
            {
                $statement=$this->db->prepare("
            
            INSERT INTO products (product_name,product_price,product_quantity,product_description)
            VALUES (:product_name,:product_price,:product_quantity,:product_description)
            
            ");

                $statement->execute([

                    'product_name' => $product->getProductname(),
                    'product_price' => $product->getProductprice(),
                    'product_quantity' => $product->getProductquantity(),
                    'product_description' => $product->getProductdescription(),

                ]);


            }


    }

    public function updateItems($update)
    {
        $statement=$this->db->prepare("
            
            UPDATE products 
            SET product_name=:product_name, 
                product_price=:product_price,
                product_quantity=:product_quantity,
                product_description=:product_description
            WHERE id=:id
            ");
        $statement->bindValue(':product_name',$update->getProductname());
        $statement->bindValue(':product_price',$update->getProductprice());
        $statement->bindValue(':product_quantity',$update->getProductquantity());
        $statement->bindValue(':product_description',$update->getProductdescription());
        $statement->bindValue(':id',$update->getId());
        $statement->execute();


    }
    public function get($id)
    {
        $statement=$this->db->prepare("
                    SELECT * FROM products
                    WHERE id= :id
                    ");

        $statement->setFetchMode(PDO::FETCH_OBJ);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->fetchAll();
    }



}


?>