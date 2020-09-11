<?php
namespace Views;
$stylea="";
$styleu="";
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
<html lang="">
<div class="main">
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
                <li class="active">
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
        <form action="AddNewAdmin/Add" method="post">

            <h3>Username:</h3><input class="text" type="text" name="username" required="required">
            <br>
            <br>
            <h3>Password:</h3><input class="text" type="password" name="password" required="required">
            <br>
            <br>
            <h3>Email:</h3><input  class="text" type="text" name="email" required="required">
            <br>
            <br>
            <h3>First Name:</h3><input class="text" type="text" name="firstname" required="required">
            <br>
            <br>
            <h3>Last Name:</h3><input  class="text" type="text" name="lastname" required="required">
            <br>
            <br>
            <input type="submit" value="Add" name="submit" class="submit">
        </form>
    </div>
    <div class="tablewrap">
        <table>
            <tr>
            <td style="font-family:'Arial';font-size:1.5vw;">Username:</td>
            <td style="font-family:'Arial';font-size:1.5vw;">Role:</td>
            </tr>
                <?php foreach ($items as $item): ?>
                <tr>
                    <?php
                    if($item->role=='admin')
                    {
                        $stylea= "style='display:none'";
                    }
                    if($item->role=='user')
                    {
                        $styleu= "style='display:none'";
                    }
                    if($item->role=='head admin')
                    {
                        $styleu= "style='display:none'";
                        $stylea= "style='display:none'";
                    }
                    ?>
                    <td style="font-family:'Arial';font-size:1.5vw;"><?= $item->username; ?></td>
                    <td style="font-family:'Arial';font-size:1.5vw;"><?= $item->role; ?></td>
                    <td>
                        <a href="AddNewAdmin/setAdmin?id=<?= $item->id ?>" <?php echo $stylea;$stylea="";
                        ?> style="color:green;"><b>SET AS ADMINISTRATOR</b></a>
                    </td>
                    <td>
                        <a href="AddNewAdmin/setUser?id=<?= $item->id ?>" <?php echo $styleu;$styleu="";
                        ?> style="color:green;" s><b>SET AS USER</b></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    </body>
</div>
</html>