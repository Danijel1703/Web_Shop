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
                }
                public function display()
                {
                    echo "<style>";
                    require ('CSS/InputProducts.css');
                    echo "</style>";
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
                        $image = $_FILES['image'];
                        $extensions_arr = ["jpg","jpeg","png"];
                        $imagename=$_FILES['image']['name'];
                        $imgext=explode('.',$imagename);
                        $myext=strtolower(end($imgext));
                        if(in_array($myext,$extensions_arr))
                        {
                            $upload_destination = "/var/www/html/Web_Shop/app/images/" . $image['name'];
                            move_uploaded_file($image['tmp_name'], $upload_destination);
                            $product->setImage("/images/" . $image['name']);
                            $storage=new ProductStorage($this->db);
                            $storage->StoreItems($product);
                            header('location: /Inputproducts');
                        }
                        else {
                            header('location: /Store');
                        }
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