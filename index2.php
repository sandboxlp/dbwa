<?php require("content/top.php"); ?>

<?php require("content/top2.php"); ?>

    <main>
        <?php
        foreach ($item->categories_by_pos() as $dsatz) {
        echo "test";
            if(!empty($dsatz["bez"])) { ?>
                <a href="<?php echo $dsatz["url"]; ?>" >
                    <div class="square-box">
                        <div class="square-content">
                            <div>
                                <span>
                                    <?php echo $dsatz["bez"]."\n"; ?>
                                            Hallo das ist ein Test!
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