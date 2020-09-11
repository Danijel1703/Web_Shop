<?php
        namespace Views;
?>
<style>
    body{
        background-color: #2974BA;
        position: relative;
    }
    h3
    {
        font-size: 2vw;
        font-family: Arial;
    }
    .main
    {
        width: 100%;
        height: 100%;
        position: relative;
    }
    .text{
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
    }
    .return{
        font-size: 1vw;
        padding-top: 15px;
        padding-bottom: 15px;
        padding-left: 35px;
        padding-right: 35px;
        background-color:#7DB8F0;
        border:5px solid #194670;
        color: #194670;
        cursor: pointer;
        font-family: "Arial";
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }
    a{
        text-decoration: none;
    }
    .return:hover{
        background-color: white;
        transition: 0.3s;
    }
</style>
<html>
<body>
<div class="main">
    <div class="text">
        <h3>
            &nbsp&nbsp&nbsp&nbsp<?= isset($_SESSION['total'])?$_SESSION['total']:""; ?>
            <br>
            Thank you for your purchase!
        </h3>
        <button class="return"><a href="/Store" style="color: black">Return</a></button>
    </div>
</div>
</body>
</html>