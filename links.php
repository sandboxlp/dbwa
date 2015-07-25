<?php require("content/top.php"); ?>

<?php require("content/top2.php"); ?>

<main>
    <h1 class="superheadline">Links</h1>
    <?php
        $links = $item->links_by_lid();

        foreach($links as $dsatz) {
            if(strpos($dsatz["url"], "http://") == 1)
                $link = htmlspecialchars($dsatz["url"]);
            else $link = htmlspecialchars("http://".$dsatz["url"]);
            ?>
            <p class="center"><a class="black" href="<?php echo $link; ?>"><?php echo htmlspecialchars($dsatz["bez"]); ?></a></p>
            <?php
        }
    ?>

    <?php include("content/nav_boxes/home.php"); ?>
</main>

<?php require("content/bottom.php"); ?>