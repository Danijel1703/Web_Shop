<?php

namespace Controllers;
use http\Exception\InvalidArgumentException;
use Models\UserStorage;
use Models\User;
use PDO;
use Models\View;


class AddNewAdminController extends View {

    protected $db;
    protected $items=[];
    public function __construct(PDO $db)
    {
        $this->db=$db;
        $this->getAll();
    }
    public function display()
    {
        echo "<style>";
        require ('CSS/AddNewAdmin.css');
        echo "</style>";
        echo parent::render('AddNewAdmin',['items'=>$this->items]);
    }

    public function Add()
    {
        if(isset($_POST['submit']))
        {
            $admin=new User();
            $admin->setUsername($_POST['username']);
            $admin->setPassword($_POST['password']);
            $admin->setEmail($_POST['email']);
            $admin->setFirstName($_POST['firstname']) ;
            $admin->setLastName($_POST['lastname']);
            $storage=new UserStorage($this->db);
            $storage->StoreAdmin($admin);

        }
    }
    public function setAdmin()
    {
        $id=$_GET['id'];
        $statement=$this->db->prepare("
            UPDATE users
            SET role=:role
            WHERE id=:id
        ");
        $statement->bindValue(':role','admin');
        $statement->bindValue(':id',$id);
        $statement->execute();
        header('location: /AddNewAdmin');
    }
    public function setUser()
    {
        $id=$_GET['id'];
        $statement=$this->db->prepare("
            UPDATE users
            SET role=:role
            WHERE id=:id
        ");
        $statement->bindValue(':role','user');
        $statement->bindValue(':id',$id);
        $statement->execute();
        header('location: /AddNewAdmin');
    }

    public function getAll()
    {
        $statement=$this->db->prepare("
               SELECT id,username,role FROM users
        ");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $this->items=$statement->fetchAll();
    }




}


?>