<?php
        namespace Views;
?>
<html lang="">
<div class="wrapper">
    <div class="formwrap">
        <body>

        <form action="signup/signUp" method="post">

            <h3>Username:</h3><input class="text" type="text" name="username" placeholder="Username..." required="required">
            <br>
            <br>
            <h3>Password:</h3><input class="text" type="password" name="password" placeholder="Password..." required="required">
            <br>
            <br>
            <h3>Email:</h3><input class="text" type="text" name="email" placeholder="Email..." required="required">
            <br>
            <br>
            <h3>First Name:</h3><input class="text" type="text" name="firstname" placeholder="First Name..." required="required">
            <br>
            <br>
            <h3>Last Name:</h3><input class="text" type="text" name="lastname" placeholder="Last Name..." required="required">
            <br>
            <br>
            <input type="submit" value="Sign Up" name="submit" class="submit">
        </form>
        </body>

    </div>
</div>
</html>