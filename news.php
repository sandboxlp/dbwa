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
    require("content/db.php");
    $res = $db->query("select * from news order by n_id desc");
    $tmp = $res->fetchAll(PDO::FETCH_ASSOC);
    foreach($tmp as $dsatz)
    { ?>
    <p><?php echo $dsatz["title"]; ?></p>
    <?php } ?>

<?php require("content/navbar.php"); ?>

</main>

<?php require("content/bottom.php"); ?>