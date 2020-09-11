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
<body>
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
            <a href="/Orders"  <?php echo $user ?>>
                <li class="active">
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
    <div class="middle">
        <div class="tablewrap">

            <table>
                <tr class="tr">
                    <td>
                        Product name:
                    </td>
                    <td>
                        Product quantity:
                    </td>
                    <td>
                        Customer:
                    </td>

                </tr>
                <?php foreach ($items as $item): ?>
                    <tr class="tr">
                        <td><?= $item->product_name ?></td>
                        <td>
                            <?=   $item->quantity ?>
                        </td>
                        <td>
                            <?= $item->user ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>

</div>
</body>
</html>
