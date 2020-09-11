<?php
namespace Views;
use Controllers\StoreController;
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
<!DOCTYPE html>
<html>
<style>
</style>
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
    <div class="middle">
        <div class="tablewrap">
            <table>
                <tr class="tr">
                    <td>
                        Product name:
                    </td>
                    <td>
                        Product price:
                    </td>
                    <td>
                        Product description:
                    </td>
                    <td>
                        Product quantity:
                    </td>
                    <td>
                        Product ID:
                    </td>
                    <td>

                    </td>
                    <td>
                        Product visibility:
                    </td>
                </tr>

                <?php
                foreach ($items as $item):
                    ?>
                    <tr>
                        <td style="border-left:5px solid #194670">
                            <?=  $item->getProductname(); ?>
                        </td>
                        <td>
                            <?=   $item->getProductprice(); ?>

                        </td>
                        <td>
                            <?=   $item->getProductdescription(); ?>
                        </td>
                        <td>
                            <?=   $item->getProductquantity(); ?>
                        </td>
                        <td>
                            <?=   $item->getId(); ?>
                        </td>
                        <td>
                            <div class="imagewrap">
                                <img src="<?= $item->getImage(); ?>" width="20%">
                            </div>
                        </td>
                        <td>
                            <?php
                            $visibility=$item->getVisibility();
                            if($visibility==true):
                                ?>
                                <a href="SelectEditProduct/truecheckbox?id=<?= $item->getId();?>">
                                    <input type='checkbox' name='visibility' checked='checked'>
                                </a>
                            <?php
                            else:
                                ?>
                                <a href='SelectEditProduct/falsecheckbox?id=<?= $item->getId();?>'>
                                    <input type='checkbox' name='visibility'>
                                </a>
                            <?php endif; ?>

                        </td>
                        <td>
                            <a name="id" href="EditProduct/editProduct?id=<?=  $item->getId(); ?>" class="selecte" style="color:green">EDIT</a>
                        </td>
                        <td style="border-right:5px solid #194670" >
                            <a  href="SelectEditProduct/deleteProduct?id=<?=  $item->getId(); ?>" class="selectd" style="color:red">DELETE</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>

            </table>

        </div>
    </div>
</div>
</body>
</html>




