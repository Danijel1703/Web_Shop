<?php

        namespace Controllers;
        use Models\Product;
        use Models\ProductStorage;
        use Models\View;
        use Models\UserStorage;
        use Models\User;
        use PDO;
        class InputproductsController extends View {

                protected $db;
                protected $items=[];


                public function __construct(PDO $db)
                {
                    $this->db=$db;
                    echo parent::render('InputProducts',['items'=>$this->items]);

                }

                public function inputProducts()
                {
                    $this->items=$this->getItems();
                    if(isset($_POST['submit']))
                    {
                        $product=new Product();
                        $product->setProductname($_POST['product_name']);
                        $product->setProductprice($_POST['product_price']);
                        $product->setProductquantity($_POST['product_quantity']);
                        $product->setProductdescription($_POST['product_description']);


                        $storage=new ProductStorage($this->db);
                        $storage->StoreItems($product);


                    }
                }
                public function getItems()
                {
                    $statement=$this->db->prepare("
                    SELECT * FROM products
                    ");
                    $statement->setFetchMode(PDO::FETCH_CLASS,Product::class);
                    $statement->execute();
                    return $statement->fetchAll();
                }


        }


?>