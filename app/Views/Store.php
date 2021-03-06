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
                <li class="active">
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
                <li>
                    Cart
                </li>
            </a>



        </ul>
    </div>
   <div class="middle">
       <div class="tablewrap"><table>
               <form action="Store" method="post">
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

                      </tr>

                   <?php
                   foreach ($items as $item):
                       ?>
                       <?php
                       $style="";
                       $q=$item->getProductquantity();
                       if($q==0)
                       {
                           $style="style=display:none;";
                       }
                       ?>
                           <tr <?= $style ?>>
                               <td style="border-left:5px solid #194670">
                                   <?=  $item->getProductname() ?>
                               </td>
                               <td>
                                   <?=   $item->getProductprice() ?>
                               </td>
                               <td>
                                   <?=   $item->getProductdescription() ?>
                               </td>
                               <td>
                                   <?=   $item->getProductquantity() ?>
                               </td>
                               <td><div class="imagewrap">

                                       <img src="<?= $item->getImage() ?>">
                                   </div>
                               </td>
                               <td style="border-right:5px solid #194670">
                                   <a  href="Store/buy?id=<?=$item->getId()?>" class="buy">BUY</a>
                               </td>
                           </tr>

                   <?php
                   endforeach;
                   ?>
           </table>
           <a href="Cart" class="checkout"><b>CHECKOUT</b></a>
       </div>
   </div>
</div>
</body>
</html>
