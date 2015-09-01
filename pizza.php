<?php require("content/top.php"); ?>
<style>
    #wrapper2 {
        padding: 0 2em;
    }

    .no-dec {
        font-weight: normal;
    }

    .bold, .smaller {
        font-size: 60px;
    }

    .smaller {
        font-size: 50px;
    }

    th {
        font-size:60px;
    }

    th span {
        font-size: 40px;
    }

    .ingredients td {
        width: 50%;
    }

    .ingredients {
        width: 100%;
    }

    #add {
        font-size: 3em;
    }
</style>
<script>
    $(document).ready(function(){
        $("#add").ready(function(){
            
        });
    });
</script>
<?php require("content/top2.php"); ?>

<main>
    <h1 class="superduperheadline">PIZZA, wie ich sie mag!</h1>
    <div id="wrapper2">
        <span class="bold" style="clear:both; width:100%; display:inline-block;">Grundteig</span><br/>
        <span class="smaller" style="clear:both; width:100%; display:inline-block;">hausgemachter Hefeteig, Tomatensauce, K&auml;se, Oregano</span><br/>
        <div style="width: 100%; clear: both;">
            <table style="float:left; margin-right: 6em;" class="noTable">
                <tr><td><input type="radio" id="big" name="size" value="big" checked="checked" /><label for="big">Standardpizza (&euro;4,90)</label></td></tr>
                <tr><td><input type="radio" id="small" name="size" value="small" /><label for="big">kleine Pizza (&euro;3,90)</label></td></tr>
            </table>
            <table style="float:left;" class="noTable">
                <tr><td><input type="checkbox" id="takeaway" /><label for="takeaway">zum Mitnehmen</label></td></tr>
                <tr><td><input type="checkbox" id="cut" checked="checked" /><label for="cut">geschnitten</label></td></tr>
            </table>
        </div>
        <div style="height:3em; clear:both;";> </div>
        <table class="ingredients" style="clear:left;">
            <tr><th colspan="2" class="red">W&auml;hle deine Zutaten! <span>je &euro; 0,40</span></th></tr>
            <?php
                if(($res = $item->pizzaingredients()) != false) {
                    $x = 0;
                    while($dsatz = mysqli_fetch_assoc($res)) {
                        if($x % 2 == 0) {
                            echo "<tr>";
                        }
                        echo '<td><input type="checkbox" id="pI'.$dsatz["i_id"].'" data-id="'.$dsatz["i_id"].'" /><label for="pI'.$dsatz["i_id"].'">'.$dsatz["title"].'</label></td>';
                        if($x % 2 == 1) {
                            echo "</tr>";
                        }

                        $x++;
                    }
                }
                else {
                    header("Location: index.php");
                    die();
                }
            ?>
        </table>
        <div style="height:3em; clear:both;";> </div>
        <button id="add" class="btn btn-danger">Auf die Bestellliste</button>
    </div>
</main>

<?php require("content/bottom.php"); ?>