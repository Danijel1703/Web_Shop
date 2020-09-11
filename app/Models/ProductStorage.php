<?php


namespace Models;
use Controllers\InputproductsController;
use PDO;

class ProductStorage
{
    public $db;
    protected $cartitems=[];
    protected $data=[];
    protected $data2=[];
    public function __construct(PDO $db)
    {
            $this->db=$db;
    }
    public function StoreItems($product)
    {
            $statement=$this->db->prepare("
                    SELECT * FROM products
                    ");
            $statement->setFetchMode(PDO::FETCH_CLASS,Product::class);
            $statement->execute();
            $items=$statement->fetchAll();

            $namebool=false;
            foreach ($items as $item)
            {

                if($item->product_name==$product->getProductname())
                {
                    $namebool=true;
                    header('location: /Inputproducts');
                }
            }

            if($namebool==false)
            {
                $statement=$this->db->prepare("
            
            INSERT INTO products (product_name,product_price,product_quantity,product_description,image)
            VALUES (:product_name,:product_price,:product_quantity,:product_description,:image)
            
            ");

                $statement->execute([

                    'product_name' => $product->getProductname(),
                    'product_price' => $product->getProductprice(),
                    'product_quantity' => $product->getProductquantity(),
                    'product_description' => $product->getProductdescription(),
                    'image' => $product->getImage(),

                ]);


            }


    }

    public function updateItems($update)
    {

        $statement=$this->db->prepare("
            
            UPDATE products 
            SET product_name=:product_name, 
                product_price=:product_price,
                product_quantity=:product_quantity,
                product_description=:product_description,
                image=:image
            WHERE id=:id
            ");
        $statement->bindValue(':product_name',$update->getProductname());
        $statement->bindValue(':product_price',$update->getProductprice());
        $statement->bindValue(':product_quantity',$update->getProductquantity());
        $statement->bindValue(':product_description',$update->getProductdescription());
        $statement->bindValue(':image',$update->getImage());
        $statement->bindValue(':id',$update->getId());
        $statement->execute();


    }
     public function get()
    {
        $id=isset($_GET['id'])? $_GET['id']:'';
        $statement=$this->db->prepare("
                    SELECT * FROM products
                    WHERE id= :id
                    ");
        $statement->bindValue(':id',$id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS,Product::class);
        return $statement->fetchAll();

    }

    public function trueVisibility($id)
    {
        $statement=$this->db->prepare("
                    UPDATE products
                    SET visibility=0
                    WHERE id= :id
                    ");
        $statement->bindValue(':id',$id);
        $statement->execute();

    }
    public function falseVisibility($id)
    {
        $statement=$this->db->prepare("
                    UPDATE products
                    SET visibility=1
                    WHERE id= :id
                    ");
        $statement->bindValue(':id',$id);
        $statement->execute();

    }
    public function delete($id)
    {
        $statement=$this->db->prepare("
                SELECT product_name 
                FROM products
                WHERE id=:id
        ");
        $statement->bindValue(':id',$id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $items1=$statement->fetchAll();
        foreach($items1 as $item1)
        {
            $data2[$item1->product_name]=$item1;
        }
        $statement=$this->db->prepare("
                SELECT product_name 
                FROM cart
        ");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $items2=$statement->fetchAll();
        foreach($items2 as $item2)
        {
            foreach($data2 as $dat2)
            {
                if($item2->product_name == $dat2->product_name)
                {
                    $statement=$this->db->prepare("
                        DELETE FROM cart
                        WHERE product_name=:product_name
                         ");
                    $statement->bindValue('product_name',$dat2->product_name);
                    $statement->execute();

                }
            }
        }
        $statement=$this->db->prepare("
            DELETE FROM products
            WHERE id=:id
        ");
        $statement->bindValue(':id',$id);
        $statement->execute();
        header ('location: /SelectEditProduct');

    }
    public function getCart()
    {

        $cartcheck=$this->db->prepare("
            SELECT * FROM cart
        ");
        $cartcheck->execute();
        $cartcheck->setFetchMode(PDO::FETCH_OBJ);
        $cartitems=$cartcheck->fetchAll();
        foreach ($cartitems as $cartitem)
        {
            array_push($this->cartitems,$cartitem->product_name);
        }


    }
        public function getName($id)
    {
        $statement = $this->db->prepare("
            SELECT * FROM products
            WHERE id=:id
        ");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetch()->product_name;
    }
    public function cart($id)
    {

        $this->getCart();
        $name=$this->getName($id);
        $check=in_array($name,$this->cartitems);
        if(isset($_SESSION['user'])==true)
        {
        if($check==true)
        {
            header('location: /Store');
        }
        else if($check==false)
        {
            $statement = $this->db->prepare("
               SELECT * FROM products
               WHERE id=:id
           ");
            $statement->bindValue(':id', $id);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $result = $statement->fetchAll();
            $statement = $this->db->prepare("
               INSERT INTO cart (product_name,product_price,product_quantity,product_description,visibility,quantity,user,image)
               VALUES (:product_name,:product_price,:product_quantity,:product_description,:visibility,:quantity,:user,:image)
           ");

            foreach ($result as $item) {


                $statement->execute([
                    'product_name' => $item->product_name,
                    'product_price' => $item->product_price,
                    'product_quantity' => $item->product_quantity,
                    'product_description' => $item->product_description,
                    'visibility' => $item->visibility,
                    'quantity' => 1,
                    'image' => $item->image,
                    'user' => $_SESSION['user'],
                ]);
            }
            $statement=$this->db->prepare("
                SELECT * FROM cart
        ");
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $items=$statement->fetchAll();

            header('location: /Store');
        }}
        else
        {
            header('location:/Login');
        }
    }

    public function checkout($quantity,$id)
    {

        $statement = $this->db->prepare("
                            UPDATE cart
                            SET quantity=:quantity
                            WHERE id=:id
                            ");
        foreach (array_combine($id,$quantity) as $i => $q)
        {
                $statement->bindValue(':quantity',$q);
                $statement->bindValue(':id',$i);
                $statement->execute();
        }
        $getp=$this->db->prepare("
                       SELECT product_name,product_quantity
                       FROM products
                ");
        $getp->execute();
        $getp->setFetchMode(PDO::FETCH_OBJ);
        $itemsp=$getp->fetchAll();
        foreach($itemsp as $itemp)
        {
            $data[$itemp->product_name]=$itemp;
        }

        $getp=$this->db->prepare("
                       SELECT product_name,product_quantity,quantity,product_price
                       FROM cart
                ");
        $getp->execute();
        $getp->setFetchMode(PDO::FETCH_OBJ);
        $itemsc=$getp->fetchAll();
        foreach($itemsc as $itemc)
        {
           foreach($data as $dat)
           {
               if($itemc->product_name==$dat->product_name)
               {
                   $total=($dat->product_quantity)-($itemc->quantity);
                   if($total<=0)
                   {

                       $statement=$this->db->prepare("
                            UPDATE products
                            SET product_quantity=0
                            WHERE product_name=:product_name
                       ");
                       $statement->bindValue(':product_name',$dat->product_name);
                       $statement->execute();
                       $statement=$this->db->prepare("
                            UPDATE cart
                            SET product_quantity=0
                            WHERE product_name=:product_name
                       ");
                       $statement->bindValue(':product_name',$dat->product_name);
                       $statement->execute();
                       $statement=$this->db->prepare("
                            UPDATE cart
                            SET quantity=1
                            WHERE product_name=:product_name
                       ");
                       $statement->bindValue(':product_name',$dat->product_name);
                       $statement->execute();
                   }
                   else if($total>0)
                    {
                        $statement=$this->db->prepare("
                            UPDATE products
                            SET product_quantity=:product_quantity
                            WHERE product_name=:product_name
                       ");
                        $statement->bindValue(':product_name',$dat->product_name);
                        $statement->bindValue(':product_quantity',$total);
                        $statement->execute();
                        $statement=$this->db->prepare("
                            UPDATE cart
                            SET product_quantity=:product_quantity
                            WHERE product_name=:product_name
                       ");
                        $statement->bindValue(':product_name',$dat->product_name);
                        $statement->bindValue(':product_quantity',$total);
                        $statement->execute();
                        $statement=$this->db->prepare("
                            UPDATE cart
                            SET quantity=1
                            WHERE product_name=:product_name
                       ");
                        $statement->bindValue(':product_name',$dat->product_name);
                        $statement->execute();
                    }
               }
           }
                if($total<0)
                {
                    $price=($itemc->product_quantity)*($itemc->product_price);
                    $totalprice=$totalprice+$price;
                    $_SESSION['total']="Your total price is " .$totalprice."$";
                }
                else{
                    $price=($itemc->quantity)*($itemc->product_price);
                    $totalprice=$totalprice+$price;
                    $_SESSION['total']="Your total price is " .$totalprice."$";
                }
        }
        header('location: /Total');

    }

    public function getPrice()
    {
        $statement=$this->db->prepare("
                SELECT * FROM cart
        ");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $items=$statement->fetchAll();
        $total=0;
        foreach($items as $item)
        {
            $price=($item->quantity)*($item->product_price);
            $total=$total+$price;
        }
        $_SESSION['total']='Your total price is:'.$total.'$';
    }
    }



?>