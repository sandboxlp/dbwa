<?php require("content/top.php"); ?>

<?php require("content/top2.php"); ?>

    <main>
        <?php
        require("content/db.php");
        foreach ($item->categories_by_pos_where('parent', 'NULL') as $dsatz) {
            if(!empty($dsatz["bez"])) { ?>
                <a href="<?php echo $dsatz["url"]; ?>" class="invisible">
                    <div class="square-box-medium">
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
                <div class="square-box-medium transparent"></div>
            <?php
            }
        } ?>
    </main>

<?php require("content/bottom.php"); ?>