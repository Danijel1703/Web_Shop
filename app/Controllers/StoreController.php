<?php

namespace Controllers;
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
                    echo parent::render('Store',['items'=>$this->items]);

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