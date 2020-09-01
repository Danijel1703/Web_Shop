<?php
namespace Views;
?>
<html>

<body>

    <table>
        <?php
        foreach ($items as $item):
            ?>
            <tr><td><?=   $item->getProductname(); ?></td><td><?=   $item->getProductprice(); ?></td>
                <td><?=   $item->getProductdescription(); ?></td><td><?=   $item->getProductquantity(); ?>
                <td><a href="EditProduct/editproduct?id=<?= $item->getId()?>">EDIT</a></td></tr>
        <?php
        var_dump($item->getId());
        endforeach;

        ?>
    </table>


</body>
</html>