<?php require("content/top.php"); ?>
<script>
    $(document).ready(function(){
        $("#payplease").click(function(){
            $.ajax({
                url:"apis/payplease.api.php",
                success: function(data) {
                    if(data == "1") {
                        alert("Ein Kellner wird in kürze zahlen kommen.");
                        $("#payplease").hide();
                    }
                    else
                        alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut. | " + data);
                },
                error: function() {
                    alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.");
                }
            });
        });
    });
</script>
<?php require("content/top2.php"); ?>

    <main>
        <div id="categories">
        <?php
        require("content/db.php");
        foreach ($item->categories_by_pos_where('parent', 'NULL') as $dsatz) {
            if(!empty($dsatz["bez"])) { ?>
                <a href="<?php echo $dsatz["url"]; ?>" class="">
                    <div class="square-box-medium button">
                        <div class="square-content">
                            <div>
                                <span>
                                    <?php
                                    //session_start();
                                    if($dsatz["bez"] == "999901") {
                                        if(!empty($_SESSION["uid"]) && !empty($_SESSION["token"])) {

                                            if ($user->checkToken($_SESSION["uid"], $_SESSION["token"]) == "1")
                                                echo "Konto: " . $user->getUsername($_SESSION["uid"]);
                                            else
                                                echo "Einloggen/ Registrieren";
                                        }
                                        else
                                            echo "Einloggen/ Registrieren";
                                    }
                                    else
                                        echo $dsatz["bez"]."\n";
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php
            }
            else { ?>
                <div class="square-box-medium button transparent"></div>
            <?php
            }
        } ?>
        </div>
        <div style="float:left; width: 100%;"></div>

        <?php
        if(!empty($_SESSION["uid"]) && !empty($_SESSION["token"]))
            if($user->checkToken($_SESSION["uid"], $_SESSION["token"]) && $user->showPayPlease($_SESSION["uid"]) != 0)
                include("content/nav_boxes/bill_please.php");
        ?>
    </main>

<?php require("content/bottom.php"); ?>