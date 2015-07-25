<?php require("content/top.php"); ?>

<?php require("content/top2.php"); ?>

<?php
if(isset($_GET["id"])) {
    $category = $item->menu_categories_where_mid($_GET["id"]);
    $beneath = $item->menu_categories_where_upper($_GET["id"]);
    if(empty($beneath[0]["m_id"]))
        header("Location: index.php");
?>

<main>
    <h1 class="superduperheadline"><?php echo $category["title"]; ?></h1>
<?php
foreach($beneath as $dsatz) {
    $beneather = $item->menu_categories_where_upper($dsatz["m_id"]);
    if(empty($beneather[0]["m_id"]))
        $url = "products.php?id=".$dsatz["m_id"];
    else
        $url = "categories.php?id=".$dsatz["m_id"];

    ?>
    <a href="<?php echo $url; ?>" class="">
        <div class="square-box-medium button">
            <div class="square-content">
                <div>
                    <span>
                        <?php echo $dsatz["title"]."\n"; ?>
                    </span>
                </div>
            </div>
        </div>
    </a>
<?php } ?>
</main>

<?php
}
else
    header("Location: index.php");
?>

<?php require("content/bottom.php"); ?>