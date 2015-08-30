<?php require("content/top.php"); ?>

<style>
    main * {
        text-align: center;
    }
</style>

<?php require("content/top2.php"); ?>

<main>
    <h1 class="superduperheadline">NEWS</h1>
<?php
    foreach($item->news_by_nid() as $dsatz)
    {
        echo '<p>'.$dsatz["title"].'</p>';
    } ?>
<br/><br/>
<?php include("content/nav_boxes/home.php"); ?>

</main>

<?php require("content/bottom.php"); ?>