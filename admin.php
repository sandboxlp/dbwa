<?php require("content/top.php"); ?>
<style>
    #col1 {
        width:50%;
        float:left;
    }
    #col2 {
        width: 50%;
        float:right;
    }
    #row {
        text-align: center;
    }
    .products {
        text-align: right;
        display: inline-block;
        width: 48%;
        padding-right: 2%;
    }
    .button {
        text-align: left;
        display: inline-block;
        width: 48%;
        padding-left: 2%;
    }
</style>
<?php require("content/top3.php"); ?>

<main>
    <div id="col1">
        <h2 class="center">Bestellungen</h2>
        <br/><h4 class="center">Max Mustermann | 14:39:54</h4>
            <div id="row"><span class="products">1x HAFENBAR Burger</span><span class="button"><input type="button" value="Serviert" /></span></div>
            <div id="row"><span class="products">1x Pizza mit Salami, Salami, Salami, Salami</span><span class="button"><input type="button" value="Serviert" /></span></div>
    </div>
    <div id="col2">
        <h2 class="center">Rechnungen</h2><br/>
        <div id="row"><span class="products">Max Mustermann | 18:42:19</span><span class="button"><input type="button" value="Bezahlt" /></span></div>
        <div id="row"><span class="products">Sarah Bauer | 19:24:11</span><span class="button"><input type="button" value="Bezahlt" /></span></div>
    </div>
</main>

<?php require("content/bottom.php"); ?>

