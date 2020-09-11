<?php
namespace Views;
$logout="";
$user="";
$ul="";
$login="";
if(!isset($_SESSION['user']))
{
    $logout="style='display:none';";
    $user="style='display:none';";
    $ul="style='position:absolute;left:50%;transform:translateX(-50%);'";
}
if(isset($_SESSION['user']))
{
    $login="style='display:none';";
}
if(isset($_SESSION['role']))

{
    if($_SESSION['role']=='user')
    {
        $user="style='display:none';";
        $ul="style='position:absolute;left:50%;transform:translateX(-50%);'";
    }

}


?>


<html>
<style>
    td {
        border: 2px solid black;
    }
</style>
<div class="wrapper">
    <body>
    <div class="header">
        <div class="welcome">WELCOME</div>
        <a href="/login" <?= $login ?>><button class="login"><b>LOG IN</b></button></a>
        <a href="/signup" <?= $login ?>><button class="signup"><b>SIGN UP</b></button></a>
        <a href="login/logout" <?php echo $logout ?>><button class="signup"><b>LOGOUT</b></button></a>
    </div>
    <div class="menu">
        <ul <?php echo $ul ?>>
            <a href="/Home" >
                <li style="border-left: 4px solid white" >
                    Home
                </li>
            </a>
            <a href="/Store">
                <li>
                    Store
                </li>
            </a>
            <a href="/Inputproducts"  <?php echo $user ?>>
                <li class="active">
                    Input products
                </li>
            </a>
            <a href="SelectEditProduct" <?php echo $user ?>>
                <li>
                    Edit products
                </li>
            </a>
            <a href="/AddNewAdmin"<?php echo $user ?>>
                <li>
                    Add admin
                </li>
            </a>
            <a href="/Orders" <?php echo $user ?>>
                <li>
                    View orders
                </li>
            </a>
            <a href="/Cart">
                <li>
                    Cart
                </li>
            </a>



        </ul>
    </div>
    <div class="formwrap">
        <form action="Inputproducts/inputProducts" method="post" enctype="multipart/form-data">
            <h3>Product name:</h3>
            <input type="text" name="product_name" class="text" placeholder="Product name..." required="required">
            <br>
            <br>
            <h3>Product price:</h3>
            <input type="number" name="product_price" class="text" placeholder="Product price..." required="required">
            <br>
            <br>
            <h3>Product quantity:</h3>
            <input type="number" name="product_quantity" class="text" placeholder="Product quantity..." required="required">
            <br>
            <br>
            <h3>Product description:</h3>
            <input type="text" name="product_description" class="text" placeholder="Product description..." required="required">
            <br>
            <br>
            <input type="file" name="image" style="border:none">
            <br>
            <br>
            <input type="submit" value="Submit" name="submit" class="submit">

        </form>
    </div>
    </body>
</div>
</html>
