<?php require("content/top.php"); ?>

<?php
if(isset($_GET["id"])) {
    $category = $item->menu_categories_where_mid($_GET["id"]);
    ?>

<style>
    td {
       padding: 5px;
    }

    table {
        margin: auto 2.5%;
        width: 95%;
    }
</style>
<script>
    <?php

    ?>
    $(document).ready(function() {
        $(document).on("swipeleft", function(){
            window.location = "products.php?id=<?php echo htmlspecialchars($item->products_nextpage($_GET["id"])); ?>";
        });

        $(document).on("swiperight", function(){
            window.location = "products.php?id=<?php echo htmlspecialchars($item->products_lastpage($_GET["id"])); ?>";
        })
    });
</script>
<?php require("content/top2.php"); ?>

    <main>
        <h1 class="superduperheadline"><?php echo $category["title"]; ?></h1>
        <table>
            <tr>
                <th></th>
                <th class="center">Anz</th>
                <th class="center">Preis</th>
                <th class="center">Best.</th>
            </tr>
        <?php
            $products = $item->products_where_mid_by_pos($_GET["id"]);
            if(empty($products[0]["p_id"]))
                header("Location: index.php");

            foreach($products as $dsatz)
            { ?>
                <tr>
                    <td><?php echo $dsatz["title"]; ?></td>
                    <td class="center" style="width:77px;"><input type="text" name="anz-<?php echo $dsatz["p_id"]; ?>" maxlength="1" size="1" placeholder="1" class="center" /></td>
                    <td class="center" style="width:137px;">€ <?php echo $dsatz["price"]; ?></td>
                    <td class="center" style="width:88px;"><input type="button" name="add" value=" + " /></td>
                </tr>
            <?php }
        ?>
            </table>
    </main>

<?php
}
else
    header("Location: index.php");
?>

<?php require("content/bottom.php"); ?>