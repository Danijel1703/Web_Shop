<?php


namespace Controllers;

use Models\Product;
use Models\ProductStorage;
use Models\View;
use Models\UserStorage;
use Models\User;
use PDO;

class EditProductController extends View
{

    protected $db;
    protected $items = [];

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->items=$this->productinfo();
        $this->display();
    }
    public function display()
    {

    }
    public function editProduct()
    {
        echo parent::render('EditProduct', ['items' => $this->items]);

        if(isset($_POST['submit']))
        {
            $update=new Product();
           $update->setProductname($_POST['product_name']);
           $update->setProductprice($_POST['product_price']);
           $update->setProductquantity($_POST['product_quantity']);
           $update->setProductdescription($_POST['product_description']);
           $update->setId($_POST['id']);
           if($_FILES['image']['error']!==UPLOAD_ERR_NO_FILE)
           {
               $image = $_FILES['image'];
               $extensions_arr = ["jpg","jpeg","png"];
               $imagename=$_FILES['image']['name'];
               $imgext=explode('.',$imagename);
               $myext=strtolower(end($imgext));
               if(in_array($myext,$extensions_arr))
               {
                   $upload_destination = "/var/www/html/Web_Shop/app/images/" . $image['name'];
                   move_uploaded_file($image['tmp_name'], $upload_destination);
                   $update->setImage("/images/" . $image['name']);
                   $storage=new ProductStorage($this->db);
                   $storage->updateItems($update);
               }
               else {
               }
           }
           else
           {
               $statement=$this->db->prepare("
                    SELECT image FROM products
                    WHERE id=:id
               ");
               $statement->bindValue('id',$_POST['id']);
               $statement->execute();
               $statement->setFetchMode(PDO::FETCH_OBJ);
               $image=$statement->fetch()->image;
               $update->setImage($image);
               $storage=new ProductStorage($this->db);
               $storage->updateItems($update);
           }
        }

    }
    public function productinfo()
    {
        $id= isset($_GET['id'])? $_GET['id'] :'';
        $productinfo=new ProductStorage($this->db);
        return $productinfo->get($id);

    }
}


?>