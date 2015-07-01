<?php require("content/top.php"); ?>

<?php require("content/top2.php"); ?>

    <main>

        <?php
        require("content/db.php");
        header('Content-Type: text/html; charset=utf-8');
        $i = 0;
        //print_r($item->categories_by_pos());
        foreach ($item->categories_by_pos() as $dsatz) {
            if(!empty($dsatz["bez"])) { ?>

                <!-- <a href="<?php //echo htmlspecialchars($dsatz["url"]) ?>" class="invisible">
                    <div class="square-box">
                        <div class="square-content">
                            <div>
                                <span>
                                    <?php //echo $dsatz["bez"] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a> -->
                <?php
                    if ($i % 3) { ?>
                        </div>
                        <div class="row">

                    <?php
                    } elseif ($i == 0) { ?>
                            <div class="row">
                    <?php

                    }
                    echo "content";
                ?>

                <?php
            } else { ?>
                <!--<div class="square-box transparent"></div> -->
            <?php
            }
        } ?>
    </main>


<?php require("content/bottom.php");
//Tobi was here
//Sandy was here too - 30.6
?>