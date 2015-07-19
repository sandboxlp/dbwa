<?php
$albums = $item->albums_by_date();
$loadmore = true;
$maxval = $_GET["start"] + 6;
$minval = $_GET["start"];

if(array_count_values($albums) <= $maxval) {
    $maxval = array_count_values($albums);
    $loadmore = false;
}

for($x = $minval; $x < $maxval; $x++) { ?>
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
}

if($loadmore) { ?>
    <input type="button" id="loadmore" value="Weitere Laden" />
<?php } ?>