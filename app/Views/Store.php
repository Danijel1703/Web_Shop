<?php
namespace Views;

?>


<html>
<style>

</style>

<body>

<table>
    <form action="Store/" method="post">

    <?php
    foreach ($items as $item):
        ?>
        <tr>
            <td>
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
                <input type="hidden" name="id" value="<?=  $item->getId(); ?>"><?=  $item->getId(); ?><input type="submit" name="submit" value="BUY">
            </td>

        </tr>

    <?php
    endforeach;
    ?>


</table>
</body>
</html>
