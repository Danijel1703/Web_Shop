<?php
        namespace Controllers;
        use Models\Product;
use Models\ProductStorage;
use Models\View;
        use PDO;

        class CartController extends View{

            protected $db;
            protected $items=[];
            protected $total;
            protected $offset;
            protected $quantity=[];
            protected $id=[];
            public function __construct(PDO $db)
            {
                    $this->db=$db;
                    $this->getItems();
            }
            public function display()
            {
                if(isset($_SESSION['user'])==true)
                {
                    echo "<style>";
                    require ('CSS/Cart.css');
                    echo "</style>";
                    echo parent::render('Cart',['items'=>$this->items]);
                }
                else{
                    header('location: /login');
                }
            }

            public function getItems()
            {
                $statement=$this->db->prepare("
                    
                    SELECT id,product_name,product_price,product_quantity,quantity,image
                    FROM cart
                ");
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_OBJ);
                $this->items=$statement->fetchAll();
            }

            public function checkout()
            {
                if(isset($_POST['submit']))
                {
                    $this->quantity=array_values($_POST['quantity']);
                    $this->id=array_values($_POST['id']);
                    $storage= new ProductStorage($this->db);
                    $storage->checkout($this->quantity,$this->id);

                }
            }
            public function remove()
            {
                $id=$_GET['id'];
                $statement=$this->db->prepare("
                    DELETE FROM cart
                    WHERE id=:id
                ");
                $statement->bindValue(":id",$id);
                $statement->execute();
                header('location: /Cart');
            }


        }






?>

