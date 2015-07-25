<?php require("content/top.php"); ?>

<?php require("content/top2.php"); ?>

    <main>
        <?php
        require("content/db.php");
        $i = 0;
        ?>
        <div class="row">
            <div class="col-xs-3 col-xs-offset-1"><?php
        foreach ($item->categories_by_pos_where('parent', 'NULL') as $dsatz) {
            $i++;
            if(!empty($dsatz["bez"])) { ?>

                <div class="panel panel-default">Test</div>

                <?php if (FALSE) { ?>
                    </div><div class="row"> <?php
                } ?>

            <?php
            }
            else { ?>
                <!--<div class="square-box-medium"></div> --->
            <?php
            }
        } ?> </div>
    </main>

<?php require("content/bottom.php"); ?>