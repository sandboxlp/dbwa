<?php require("content/top.php"); ?>
<?php
    if(!$user->checkToken($_SESSION["uid"], $_SESSION["token"])) {
        header("Location: index.php");
        die();
    }
?>
<style>
    #content {
        padding: 0px 1em;
    }
    
    h2 {
        font-weight: bold;
        text-align: center;
    }

    th {
        padding: 0px 0.75em;
    }

    .add {
        padding: 4px;
    }

    .served {
        color: #AAA;
    }

    .changes {
        width: 50%;
        float:left;
    }

    p span {
        font-size: 1em;
    }
</style>
<script>
    $(document).ready(function() {
        $("#delChanges").click(function() {
            location.reload();
        });

        $("#saveChanges").click(function() {
            var classes = $(".chg");
            for(var x = 0; x < classes.length; x++) {
                var doReturn = false;
                //alert("bid=<?php echo $order->getCurrentBill($_SESSION["uid"]); ?>" + "&pid=" + $(classes[x]).data("pid") + "&count=" + $(classes[x]).val());
                $.ajax({
                    url:"apis/updateBillCount.api.php",
                    type:"POST",
                    data:"bid=<?php echo $order->getCurrentBill($_SESSION["uid"]); ?>" + "&pid=" + $(classes[x]).data("pid") + "&count=" + $(classes[x]).val(),
                    success:function(data) {
                        //alert(data);
                        if(data == "1") {
                            location.reload();
                        }
                        else {
                            doReturn = true;
                            alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut!");
                        }
                    },
                    error:function() {
                        doReturn = true;
                        alert("Ein unbekannter Fehler ist aufgetreten. Laden Sie die Seite neu oder kontaktieren Sie den Administrator!");
                    }
                });

                if(doReturn)
                    return;
            }
        });

        $("#order").click(function(){
            $.ajax({
                url:"apis/orderBill.api.php",
                success:function(data) {
                    //alert(data);
                    if(data == "1") {
                        location.reload();
                    }
                    else {
                        alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut!");
                    }
                },
                error:function() {
                    alert("Ein unbekannter Fehler ist aufgetreten. Laden Sie die Seite neu oder kontaktieren Sie den Administrator!");
                }
            });
        });

        $(".oldBill").click(function(){
            var myOldBill = $(this);
            if($("#bill" + $(myOldBill).data("bid")).html() == "")
            {
                $.ajax({
                    url: "apis/getOldBill.api.php",
                    type: "POST",
                    data: "bid=" + $(myOldBill).data("bid"),
                    success: function (data) {
                        //alert(data);
                        if (data != "false") {
                            $("#bill" + $(myOldBill).data("bid")).html(data);
                            $("#billhead" + $(myOldBill).data("bid") + " span").html("&#9660;");
                        }
                        else {
                            alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut!");
                        }
                    },
                    error: function () {
                        alert("Ein unbekannter Fehler ist aufgetreten. Laden Sie die Seite neu oder kontaktieren Sie den Administrator!");
                    }
                });
            }
            else if($("#bill" + $(myOldBill).data("bid")).is(":visible")) {
                $("#bill" + $(myOldBill).data("bid")).hide();
                $("#billhead" + $(myOldBill).data("bid") + " span").html("&#9664;");
            }
            else {
                $("#bill" + $(myOldBill).data("bid")).show();
                $("#billhead" + $(myOldBill).data("bid") + " span").html("&#9660;");
            }
        });
    });
</script>
<?php require("content/top2.php"); ?>

<main>
    <h1 class="superduperheadline">RECHNUNGEN</h1>
    <div id="content">
        <h2>Aktuelle Bestellung</h2>
        <!-- RECHNUNGSINHALTE BLA BLA BLA -->
        <table>
            <tr><th width="100%;"></th><th>Anz</th><th>Preis</th></tr>
            <?php
                $products = $order->getProducts($order->getCurrentBill($_SESSION["uid"]));
                if(!empty($products)) {
                    foreach($products as $dsatz) {
                        echo "<tr";
                        if($dsatz["served"] == 1)
                            echo ' class="served"';
                        echo "><td>" . $order->getProductName($dsatz["p_id"]) . "</td><td class=\"center\">";
                        if($dsatz["served"] == 0 && $order->getBillStatus($order->getCurrentBill($_SESSION["uid"])) != 1)
                            echo '<input type="text" data-pid="'.$dsatz["p_id"].'" value="'.$dsatz["count"].'" maxlength="1" size="1" placeholder="1" class="chg center" />';
                        else
                            echo $dsatz["count"];
                        echo "</td><td class=\"center\">&euro; " . ($webwirth->priceFormat($dsatz["count"] * $order->getProductPrice($dsatz["p_id"]))) . "</td></tr>";
                    }
                }
            ?>
        </table>

        <?php
        if($order->showOrder($_SESSION["uid"])) { ?>
            <br/><br/>
            <!-- ÄNDERUNGEN SPEICHERN -->
            <div class="changes">
                <div class="banner-text center white bold button" id="saveChanges">
                    <br/><p>&Auml;nderungen speichern</p><br/>
                </div>
            </div>

            <!-- ÄNDERUNGEN VERWERFEN -->
            <div class="changes">
                <div class="banner-text center white bold button" id="delChanges">
                    <br/><p>&Auml;nderungen verwerfen</p><br/>
                </div>
            </div>

            <!-- BESTELLEN -->
            <div class="banner-text center white bold button" id="order">
                    <br/><p>Bestellung aufgeben</p><br/>
            </div>
            <div style="height: 260px;"></div>
            <?php } ?>

        <!-- UM RECHNUNG BITTEN -->
        <?php
            if($user->showPayPlease($_SESSION["uid"]) != 0) {
                echo "<br/><br/>";
                include("content/nav_boxes/bill_please.php");
                echo '<div style="height: 130px;"></div>';
            }
        ?>

        <!-- ALTE RECHNUNGEN MIT AJAX ZUM LADEN DER DETAILS -->
        <?php
            if(($res = $order->getOldBills($_SESSION["uid"])) != false) { ?>
                <br/><br/><br/>
                <h2>Bezahlte Rechnungen</h2> <?php
                while($dsatz = mysqli_fetch_assoc($res)) {
                    $paid_arr = explode("-", explode(" ", $dsatz["paid"])[0]);
                    $paid = $paid_arr[2].". ".$paid_arr[1].". ".$paid_arr[0];
                    echo '<p class="center oldBill" data-bid="'.$dsatz["b_id"].'" id="billhead'.$dsatz["b_id"].'">Rechnung vom '.$paid.' &nbsp; <span>&#9664;</span></p><div id="bill'.$dsatz["b_id"].'"></div>';
                }
            }
        ?>
    </div>
    <?php include("content/nav_boxes/home.php"); ?>
    <?php include("content/nav_boxes/account.php"); ?>
</main>

<?php require("content/bottom.php"); ?>