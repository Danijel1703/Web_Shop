<?php
namespace Views;

?>
<html>

<body>

    <table>
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
                            <?=   $item->getId(); ?>
                        </td>
                        <td>
                        <a>
                            <a name="id"  href="EditProduct/editProduct?id=<?=  $item->getId(); ?>">EDIT</a>
                        </td>
            </tr>
        <?php
        endforeach;
        ?>

    </table>
<h1>
</h1>
</body>
</html>