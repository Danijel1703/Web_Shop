<?php
        namespace Models;

        class Product {


            public $product_name;
            public $product_price;
            protected $product_quantity;
            public $product_description;
            public $quantity;
            public $id;
            public function setProductname($product_name)
            {
                $this->product_name=$product_name;
            }
            public function getProductname()
            {
                return $this->product_name;
            }
            public function setProductprice($product_price)
            {
                $this->product_price=$product_price;
            }
            public function getProductprice()
            {
                return $this->product_price;
            }
            public function setProductquantity($product_quantity)
            {
                $this->product_quantity=$product_quantity;
            }
            public function getProductquantity()
            {
                return $this->product_quantity;
            }
            public function setProductdescription($product_description)
            {
                $this->product_description=$product_description;
            }
            public function getProductdescription()
            {
                return $this->product_description;
            }
            public function setquantityupdate($quantity)
            {
                $this->quantity=$quantity;
            }
            public function getquantityupdate()
            {
                return $this->quantity;
            }
            public function getId()
            {
                return $this->id;
            }


        }


?>