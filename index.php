<?php require("content/top.php"); ?>
<script>
                                                                                <?php                                   /** ADD AJAX FOR BILLS (id: payplease) */ ?>
</script>
<?php require("content/top2.php"); ?>

    <main>
        <div id="categories">
        <?php
        require("content/db.php");
        foreach ($item->categories_by_pos_where('parent', 'NULL') as $dsatz) {
            if(!empty($dsatz["bez"])) { ?>
                <a href="<?php echo $dsatz["url"]; ?>" class="">
                    <div class="square-box-medium button">
                        <div class="square-content">
                            <div>
                                <span>
                                    <?php echo $dsatz["bez"]."\n"; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php
            }
            else { ?>
                <div class="square-box-medium button transparent"></div>
            <?php
            }
        } ?>
        </div>
        <div style="float:left; width: 100%;"></div>

        <?php include("content/nav_boxes/bill.php"); ?>
    </main>

<?php require("content/bottom.php"); ?>