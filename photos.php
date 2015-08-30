<?php require("content/top.php"); ?>
<style>
    span p {
        font-size: 1em;
    }
    span img {
        width: 95%;
    }
</style>
<?php require("content/top2.php"); ?>

<main>
    <h1 class="superduperheadline">FOTOS</h1>
    <?php
    foreach($item->albums_by_date() as $dsatz) {                                                                        /** LADEN AUF AJAX AUSLAGERN */ ?>
        <a href="<?php echo 'album.php?a_id=' . $dsatz["a_id"]; ?>" class="invisible">
            <div class="square-box-big">
                <div class="square-content">
                    <div>
                        <span>
                            <p><?php echo $dsatz["title"]; ?></p>
                            <img src="<?php echo 'imgs/albums/' . $dsatz["thumbnail"]; ?>">
                        </span>
                    </div>
                </div>
            </div>
        </a>
    <?php
    }?>
    <div style="float:right; width:100%;"></div>
    <?php include("content/nav_boxes/home.php"); ?>

</main>

<?php require("content/bottom.php"); ?>