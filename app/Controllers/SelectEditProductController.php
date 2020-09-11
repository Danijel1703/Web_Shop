<?php


namespace Controllers;

use Models\Product;
use Models\ProductStorage;
use Models\View;
use Models\UserStorage;
use Models\User;
use PDO;

class SelectEditProductController extends View
{

    protected $db;
    protected $items = [];


    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->selectProduct();
    }
    public function display()
    {
        echo "<style>";
        require ('CSS/Store.css');
        echo "</style>";
        echo parent::render('SelectEditProduct', ['items' => $this->items]);
    }
    public function selectProduct()
    {
        $this->items = $this->getItems();
    }

    public function truecheckbox()
    {
        $id=isset($_GET['id'])? $_GET['id']:'';
        $change=new ProductStorage($this->db);
        $change->trueVisibility($id);
        header ('location: /SelectEditProduct');

    }
    public function falsecheckbox()
    {
        $id=isset($_GET['id'])? $_GET['id']:'';
        $change=new ProductStorage($this->db);
        $change->falseVisibility($id);
        header ('location: /SelectEditProduct');
    }
    public function deleteProduct()
    {
        $id=isset($_GET['id'])?$_GET['id']:'';
        $change=new ProductStorage($this->db);
        $change->delete($id);

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