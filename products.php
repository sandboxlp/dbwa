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
    $(document).ready(function() {
        $(document).on("swipeleft", function(){
            window.location = "products.php?id=<?php echo htmlspecialchars($item->products_nextpage($_GET["id"])); ?>";
        });

        $(document).on("swiperight", function(){
            window.location = "products.php?id=<?php echo htmlspecialchars($item->products_lastpage($_GET["id"])); ?>";
        });

        $(".add").click(function(){

            var btn = $(this);
            var pid = $(this).attr("data-id");
            var count = $("#anz-" + pid).val();
            if(count == "")
                count = 1;
            //alert(pid + "," + count);

            $.ajax({
                url:"apis/order_product.api.php",
                type:"POST",
                data:"pid=" + pid + "&count=" + count,
                success: function(data){
                    //alert(data);
                    if(data == "1") {
                        btn.animate({backgroundColor: "#00A300", borderColor: "#00A300"}, 500);
                        btn.animate({backgroundColor: "#DDD", borderColor: "#DDD"}, 500);
                    }
                    else if(data == "2") {
                        if(confirm("Sie müssen sich zuerst anmelden, um etwas bestellen zu können.\nWollen Sie sich jetzt anmelden oder registrieren?"))
                        window.location.href = "login.php?redirect=" + window.location;
                    }
                    else
                        alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.");
                },
                error: function() {
                    alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.");
                }
            });
        });
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
                    <td class="center" style="width:77px;"><input type="text" id="anz-<?php echo $dsatz["p_id"]; ?>" maxlength="1" size="1" placeholder="1" class="center" /></td>
                    <td class="center" style="width:137px;">€ <?php echo $dsatz["price"]; ?></td>
                    <td class="center" style="width:88px;"><input type="button" data-id="<?php echo $dsatz["p_id"]; ?>" class="add" value=" + " /></td>
                </tr>
            <?php }
        ?>
            </table>
        <div style="float:right; width: "100%;"></div>
        <br/><br/>
        <?php include("content/nav_boxes/home.php"); ?>
        <?php include("content/nav_boxes/bill.php"); ?>
    </main>

<?php
}
else
    header("Location: index.php");
?>

<?php require("content/bottom.php"); ?>