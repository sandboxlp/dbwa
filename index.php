<?php
class index {
    public function echo_box($bez, $url) { ?>
        <a href="<?php echo $url; ?>" class="invisible">
            <div class="square-box">
                <div class="square-content">
                    <div>
                        <span>
                            <?php echo $bez."\n"; ?>
                        </span>
                    </div>
                </div>
            </div>
        </a>
    <?php }
}
?>

<?php require("content/top.php"); ?>

<?php require("content/top2.php"); ?>

<?php
    $index = new index();
?>
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
                                <?php echo "\n"; //echo $dsatz["bez"]."\n"; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </a> -->
                <?php
                    if ($i == 0) { ?>
                        <div class="row">

                    <?php
                    }
                    elseif ($i % 3 == 0) { ?>
                        </div>
                        <div class="row">
                    <?php }

                    //echo "content"; ?>
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
                    $i++;
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