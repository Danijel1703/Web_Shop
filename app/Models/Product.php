<?php
        namespace Models;

        class Product {


            protected $product_name;
            protected $product_price;
            protected $product_quantity;

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



        }


?>