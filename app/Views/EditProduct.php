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
<style>
    <?php
    require ('/var/www/html/Web_Shop/app/CSS/EditProduct.css');
    ?>

    @font-face {
        font-family: blanka;
        src: url("Blanka-Regular.ttf");
    }

</style>
<html>
<body>
<link href="/var/www/html/Web_Shop/app/CSS/EditProduct.css" media="all" rel="stylesheet" type="text/css">
<div class="main">
    <div class="header">
        <div class="welcome">WELCOME</div>
        <a href="/login" <?= $login ?>><button class="login"><b>LOG IN</b></button></a>
        <a href="/signup" <?= $login ?>><button class="signup"><b>SIGN UP</b></button></a>
        <a href="login/logout" <?php echo $logout ?>><button class="signup"><b>LOGOUT</b></button></a>
    </div>
    <div class="menu">
        <ul <?php echo $ul ?>>
            <a href="/Home" >
                <li style="border-left: 4px solid white"; >
                    Home
                </li>
            </a>
            <a href="/Store">
                <li>
                    Store
                </li>
            </a>
            <a href="/Inputproducts" <?php echo $user ?>>
                <li>
                    Input products
                </li>
            </a>
            <a href="/SelectEditProduct" <?php echo $user ?>>
                <li class="active">
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
        <form action="editProduct" method="post" enctype="multipart/form-data">
            <?php foreach ($items as $item): ?>
                <h3>Product name:</h3>
                <input class="text" type="text" name="product_name" value="<?= $item->getProductname(); ?>">
                <br>
                <br>
                <h3>Product price:</h3>
                <input class="text" type="number" name="product_price" value="<?= $item->getProductprice(); ?>">
                <br>
                <br>
                <h3>Product quantity:</h3>
                <input class="text" type="number" name="product_quantity" value="<?= $item->getProductquantity(); ?>">
                <br>
                <br>
                <h3>Product description:</h3>
                <input class="text" type="text" name="product_description" value="<?= $item->getProductdescription(); ?>">
                <br>
                <br>
                <input type="file" name="image" style="border:none;">
                <input type="hidden" name="id" value="<?=  isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                <br>
                <br>

                <input class="submit" type="submit" value="Submit" name="submit">
            <?php
            endforeach;
            ?>
            <?php
                if(isset($_POST['submit'])):
            ?>
            <button class="return"><a href="/SelectEditProduct" style="color: black">Return</a></button>
            <?php
                endif;
            ?>
        </form>
    </div>
</div>
</body>
</html>

