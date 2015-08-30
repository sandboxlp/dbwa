<?php require("content/top.php"); ?>
<style>
    img {
        width: 90%;
        margin: 5%;
    }
</style>
<?php require("content/top2.php"); ?>

<?php
    $album = $item->album_by_aid($_GET["a_id"]);
?>

<main>
    <h1 class="superduperheadline">FOTOS - <?php echo strtoupper($album["title"]); ?></h1>
    <?php
    $not_files = array(".","..");

    if((opendir("imgs/albums/".$webwirth->int3($album["a_id"])))) {
        $handle = opendir("imgs/albums/".$webwirth->int3($album["a_id"]));
        $dir = "imgs/albums/".$webwirth->int3($album["a_id"])."/";
    }
    else {
        echo "<h1>Ordner ise nikte da...</h1>";
    }

    for($x = 1; false != ($file = readdir($handle)); $x++) {                                                            /** LADEN AUF AJAX AUSLAGERN */
        if(!in_array($file,$not_files)) {
            /*if ($x % 2 == 0 && $x != 0)
                echo '</div><div id="row">';
            elseif ($x == 0)
                echo '<div id="row">';*/

            echo '<img src="'.$dir.$file.'" />';
        }
        $x--;
    }
    ?>

    <?php include("content/nav_boxes/home.php"); ?>
    <a href="photos.php" class="invisible">
        <div class="square-box-small">
            <div class="square-content">
                <div>
                <span>
                    Übersicht
                </span>
                </div>
            </div>
        </div>
    </a>

</main>

<?php require("content/bottom.php"); ?>