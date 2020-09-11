<?php
        namespace Models;

        class Product {


            public $product_name;
            public $product_price;
            public $product_quantity;
            public $product_description;
            public $id;
            public $visibility;
            public $quantity;
            public $image;
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

            public function setId($id)
            {
                $this->id=$id;
            }
            public function getId()
            {
                return $this->id;
            }
            public function setVisibility($visibility=true)
            {
                $this->visibility=$visibility;
            }
            public function getVisibility()
            {
                return $this->visibility;
            }
            public function setQuantity($quantity)
            {
                $this->quantity=$quantity;
            }
            public function getQuantity()
            {
                return $this->quantity;
            }
            public function setImage($image)
            {
                $this->image=$image;
            }
            public function getImage()
            {
                return $this->image;
            }


        }


?>