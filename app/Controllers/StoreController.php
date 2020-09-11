<?php

namespace Controllers;
use http\Header;
use Models\Product;
use Models\ProductStorage;
use Models\View;
use Models\UserStorage;
use Models\User;
use PDO;

            class StoreController extends View {


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
                    require ('CSS/Store.css');
                    echo "</style>";
                    echo parent::render('Store',['items'=>$this->items]);
                }
                public function getItems()
                {
                    $statement = $this->db->prepare("
                    SELECT * FROM products
                    WHERE visibility=1;
                    ");
                    $statement->setFetchMode(PDO::FETCH_CLASS, Product::class);
                    $statement->execute();
                    return $statement->fetchAll();
                }

                public function buy()
                {
                    $id=isset($_GET['id'])?$_GET['id']:'';
                    $statement=new ProductStorage($this->db);
                    $statement->cart($id);
                }




            }

?>