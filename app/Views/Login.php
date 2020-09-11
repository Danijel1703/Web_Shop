<?php
        namespace Views;
        $style="";
        if(isset($_SESSION['user']))
        {
            $style="style='display:none';";
        }

?>
<html>
<body>
<div class="wrapper">
   <div class="formwrap">
       <form action="login/logIn" method="post" <?= $style ?>>
           <h3>Username:</h3>
           <input type="text" name="username" required="required" class="text" placeholder="Username...">
           <br>
           <br>
           <h3>Password:</h3>
           <input type="password" name="password" required="required" class="text" placeholder="Password...">
           <br>
           <br>
           <input type="submit" value="Log In" name="submit" class="submit">
           <br>
           <br>
           <?=
           isset($_SESSION['error']) ? $_SESSION['error'] : '';
           unset($_SESSION['error']);
           ?>
       </form>
       <h2 <?= !isset($_SESSION['user'])?$style="style='display:none';":'' ?>>You must log out first!</h2>
       <a href="login/logout" <?= !isset($_SESSION['user'])?$style="style='display:none';":'' ?>>LOGOUT</a>
   </div>
</div>
</body>
</html>
