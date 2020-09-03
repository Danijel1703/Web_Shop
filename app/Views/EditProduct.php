<?php
namespace Views;
?>
<html>
<style>

</style>

<body>

<form action="editProduct" method="post">
    <h3>Product name:</h3>
    <input type="text" name="product_name">
    <br>
    <br>
    <h3>Product price:</h3>
    <input type="number" name="product_price">
    <br>
    <br>
    <h3>Product quantity:</h3>
    <input type="number" name="product_quantity">
    <br>
    <br>
    <h3>Product description:</h3>
    <input type="text" name="product_description">
    <input type="hidden" name="id" value="<?=  isset($_GET['id']) ? $_GET['id'] : ''; ?>">
    <br>
    <br>
    <input type="submit" value="Submit" name="submit">


</form>
</body>
</html>

