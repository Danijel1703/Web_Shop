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
<!DOCTYPE html>
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
                   <li style="border-left: 4px solid white"; class="active">
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
                   <li>
                           Cart
                   </li>
                   </a>



               </ul>
       </div>
    <?php if(isset($_SESSION['user'])): ?>
    <div class="wraptext">
        <div class="text">
            <h3>
                Hello <?= $_SESSION['user'] ?>!
            </h3>
        </div>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
