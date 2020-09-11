<?php
        namespace Views;
        $cart="";
        if(!isset($_SESSION['user']))
        {
            $cart="style='display:none;';";
        }
$logout="";
$user="";
$ul="";
$login="";
$buy="";

if(!isset($_SESSION['user']))
{
    $logout="style='display:none';";
    $user="style='display:none';";
    $ul="style='position:absolute;left:50%;transform:translateX(-50%);'";
}

if(isset($_SESSION['role']))

{
    if($_SESSION['role']==='user')
    {
        $user="style='display:none';";
        $ul="style='position:absolute;left:50%;transform:translateX(-50%);'";
    }

}
if(isset($_SESSION['user']))
{
    $login="style='display:none';";
}
?>
<html>
<body>
<div class="main">
    <div class="header">
        <div class="welcome">WELCOME</div>
        <a href="/login" <?php echo $login ?>><button class="login"><b>LOG IN</b></button></a>
        <a href="/signup" <?php echo $login ?>><button class="signup"><b>SIGN UP</b></button></a>
        <a href="login/logout" <?php echo $logout ?>><button class="signup"><b>LOGOUT</b></button></a>
    </div>
    <div class="menu">
        <ul <?php echo $ul ?>>
            <a href="/Home" >
                <li style="border-left: 4px solid white;">
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
                <li class="active">
                    Cart
                </li>
            </a>



        </ul>
    </div>

        <div class="tablewrap">
            <table <?= $cart ?>>
                <tr class="tr">
                    <td>
                        Product name:
                    </td>
                    <td>
                        Product price:
                    </td>
                    <td>
                        Stock quantity:
                    </td>
                    <td>
                    </td>
                    <td>
                        Order quantity:
                    </td>

                </tr>
                <?php foreach ($this->items as $item): ?>
                <?php
                $style="";
                if($item->product_quantity==0)
                {
                    $style="style=display:none;";
                }


                ?>
                <tr <?php echo $style ?>>
                    <td style="border-left:5px solid #194670"><?= $item->product_name ?></td>
                    <td><?= $item->product_price?></td>
                    <td><?= $item->product_quantity ?></td>

                    <td>
                        <div class="imagewrap">
                            <img src="<?= $item->image ?>" >
                        </div>
                    </td>
                    <form action="Cart/checkout" method="post">
                        <td><input type="number" min="1" value="<?= $item->quantity
                            ?>" name="quantity[]"></td>
                        <input type="hidden" value="<?= $item->id ?>" name="id[]">
                        <td style="border-right:5px solid #194670"><a href="Cart/remove?id=<?= $item->id ?>" style="color:red;">REMOVE</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <input type="submit" name="submit" value="CHECKOUT" class="checkout">
            </form>
        </div>

</div>
</body>
</html>
