<?php
require("../content/db.php");
require("../content/order.class.php");
require("../content/webwirth.class.php");
$order = new order($db);
$webwirth = new webwirth($db);

if(($bill = $order->getOldBill($_POST["bid"])) != false) { ?>
<div style="width: 100%; float:left;">
    <div style="width: 50%; float:left;">
        <p>HAFENBAR<br/>
            Granitgasse 15<br/>
            3632 Bad Traunstein</p>
    </div>
    <div style="width: 50%; float:right;">
        <p><?php echo $webwirth->timestampFormat($bill["paid"]) ?><br/>
            UID AT??????????<br/>
            Rechnung#<?php echo $bill["b_id"]; ?></p>
    </div>
    <br/><br/>
    <table>
        <tr><th>Artikelbezeichnung</th><th>Anzahl</th><th></th><th>Preis</th></tr>
        <?php
        $total = 0.00;
        $tax10 = 0.00;
        $tax20 = 0.00;
        if(($products = $order->getOldBillProducts($bill["b_id"])) != false) {
            while ($product = mysqli_fetch_assoc($products)) {
                //echo "<br/><br/>".print_r($product)."<br/><br/>";
                echo '<tr><td width="100%;">' . $order->getProductName($product["p_id"]) . '</td><td class="center">' . $product["count"] . '</td><td class="center">' . $order->getProductTax($product["p_id"]) . '%</td><td class="center" style="width:149px;">&euro; ' . ($webwirth->priceFormat($product["count"] * $order->getProductPrice($product["p_id"]))) . '</td></tr>';
                $total += $product["count"] * $order->getProductPrice($product["p_id"]);
                if($order->getProductTax($product["p_id"]) == 10) {
                    $tax10 += round($product["count"] * $order->getProductPrice($product["p_id"]) / 11, 2);
                }
                elseif($order->getProductTax($product["p_id"] == 20)) {
                    $tax10 += round($product["count"] * $order->getProductPrice($product["p_id"]) / 6, 2);
                }
            }
        }
        ?>
        <!--<tr><td width="100%;">XXXXX</td><td class="center">X</td><td class="center">XX%</td><td class="center" style="width:149px;">&euro; XX.XX</td></tr>-->
    </table>
    <br/>
    <div style="float:right; width:149px;" class="center">
        <p>&euro; <?php echo $webwirth->priceFormat($total); ?><br/>
            &euro; <?php echo $webwirth->priceFormat($tax10); ?><br/>
            &euro; <?php echo $webwirth->priceFormat($tax20); ?></p>
    </div>
    <div style="float:right; margin-right: 1.5em; text-align:right;">
        <p>TOTAL<br/>
            davon 10% Mwst<br/>
            davon 20% Mwst</p>
    </div>
</div>
<?php }
else
    echo "false";

?>