<?php
namespace Views;

?>


<html>
<style>
    td {
        border: 2px solid black;
    }
</style>

<body>

<form action="Inputproducts/inputProducts" method="post">
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
    <br>
    <br>

    <input type="submit" value="Submit" name="submit">

</form>
</body>
</html>