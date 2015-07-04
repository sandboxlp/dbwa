<?php require("content/top.php"); ?>

<?php require("content/top2.php"); ?>

    <main>
        <!-- <a href="<?php //echo htmlspecialchars($dsatz["url"]) ?>" class="invisible">
                <div class="square-box">
                    <div class="square-content">
                        <div>
                            <span>
                                <?php //echo "\n"; //echo $dsatz["bez"]."\n"; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a> -->

        <?php
        require("content/db.php");
        header('Content-Type: text/html; charset=utf-8');
        $i = 0;
        //print_r($item->categories_by_pos());
        foreach ($item->categories_by_pos_where('parent', 'NULL') as $dsatz) {
            if(!empty($dsatz["bez"])) { ?>
                <a href="<?php echo $dsatz["url"]; ?>" class="invisible">
                    <div class="square-box">
                        <div class="square-content">
                            <div>
                                <span>
                                    <?php echo $dsatz["bez"]."\n"; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a> <?php
                ?>

                <?php
            } else { ?>
                <div class="square-box transparent"></div>
            <?php
            }
        } ?>
    </main>


<?php require("content/bottom.php");
//Tobi was here
//Sandy was here too - 30.6
?>