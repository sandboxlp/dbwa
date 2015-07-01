<?php require("content/top.php"); ?>

<style>
    main * {
        text-align: center;
    }
</style>

<?php require("content/top2.php"); ?>

<main>
    <h1 class="superheadline">NEWS</h1>
<?php
    foreach($item->news_by_nid() as $dsatz)
    {
        echo '<p>'.$dsatz["title"].'</p>';
    } ?>

<?php require("content/navbar.php"); ?>

</main>

<?php require("content/bottom.php"); ?>