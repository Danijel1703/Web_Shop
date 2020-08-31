<?php

        namespace Controllers;
        use Models\Product;
        use Models\ProductStorage;
        use Models\View;
        use Models\UserStorage;
        use Models\User;
        use PDO;
        class AdminStoreController extends View {

                protected $db;
                public function __construct(PDO $db)
                {
                    $this->db=$db;
                    $this->InputProducts();
                }

                public function InputProducts()
                {
                    echo parent::render('AdminStore');
                    if(isset($_POST['submit']))
                    {
                        $product=new Product();
                        $product->setProductname($_POST['product_name']);
                        $product->setProductprice($_POST['product_price']);
                        $product->setProductquantity($_POST['product_quantity']);
                        var_dump($product);
                        $storage=new ProductStorage($this->db);
                        $storage->StoreItems($product);

                    }
                }


        }


?>