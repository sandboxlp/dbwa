<?php require("content/top.php"); ?>

<?php require("content/top2.php"); ?>

    <main>
        <?php
        require("content/db.php");
        $i = 0;
        ?>
            <?php
        foreach ($item->categories_by_pos_where('parent', 'NULL') as $dsatz) {?>


                <div class="col-xs-3 col-xs-offset-1 panel panel-default">
                    <?php if(!empty($dsatz["bez"])) { ?>
                    <a href="<?php echo $dsatz["url"]; ?>" class="">
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
                        <div class="square-box-medium"></div>
                    <?php
                    } ?>
                </div>



            <?php
            $i = $i++;
        } ?>

<?php require("content/bottom.php"); ?>