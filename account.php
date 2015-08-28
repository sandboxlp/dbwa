<?php require("content/top.php"); ?>
<?php
$loggedin = false;
if(!empty($_SESSION["uid"]) && !empty($_SESSION["token"]))
    if($user->checkToken($_SESSION["uid"], $_SESSION["token"]))
        $loggedin = true;
if(!$loggedin) {
    header("Location: index.php");
    die();
}
?>
<style>
    .var {
        //display: inline;
        width: 350px;
        font-weight: bold;
    }

    #content {
        padding: 0px 1em;
    }

    tr {
        height: 66px;
    }

    input, select {
        width:80%;
    }
</style>
<script>
    $(document).ready(function(){
        $("#sendConfirm").click(function(){
            $.ajax({
                url:"apis/sendConfirm.api.php",
                success:function(data){
                    if(data == "1") {
                        $("#sendConfirm").text("E-Mail wurde gesendet!");
                        $("#sendConfirm").animate({backgroundColor: "#00A300", borderColor: "#00A300"}, 500);
                        $("#sendConfirm").animate({backgroundColor: "#DDD", borderColor: "#DDD"}, 500);
                    }
                    else {
                        $("#sendConfirm").animate({backgroundColor: "#E41F0F", borderColor: "#00A300"}, 500);
                        $("#sendConfirm").animate({backgroundColor: "#DDD", borderColor: "#DDD"}, 500);
                        $("#sendConfirm").text("E-Mail konnte nicht gesendet werden.");
                    }
                },
                error:function(){
                    alert("");
                }
            });
        });

        $("#changeData").click(function(){
            //$("#country").html('<input type="text" value="' + $("#country").text() + '"/>');
            $.ajax({
                url: "apis/countrys_dropdown.api.php",
                success:function(data){
                    if(data != "") {
                        var myCountry = $("#country").text();
                        $("#country").html(data);
                        $('#country option:contains("' + myCountry + '")').attr('selected', 'selected');
                    }
                }
            });

            //$("#birth").html('<input type="date" value="' + $("#birth").text() + '"/>');
            var date = $("#birth").text();
            var dates = date.split(".");
            $("#birth").html('<input type="date" id="birthIN" value="' + dates[2].trim() + "-" + dates[1].trim() + "-" + dates[0].trim() + '"/>');


            $("#username").html('<input type="text" id="usernameIN" value="' + $("#username").text() + '"/>');
            $("#firstn").html('<input type="text" id="firstnIN" value="' + $("#firstn").text() + '"/>');
            $("#lastn").html('<input type="text" id="lastnIN" value="' + $("#lastn").text() + '"/>');
            $("#nickn").html('<input type="text" id="nicknIN" value="' + $("#nickn").text() + '"/>');
            $("#loc").html('<input type="text" id="locIN" value="' + $("#loc").text() + '"/>');
            $("#pcode").html('<input type="number" id="pcodeIN" value="' + $("#pcode").text() + '"/>');
            $("#street").html('<input type="text" id="streetIN" value="' + $("#street").text() + '"/>');
            $("#house").html('<input type="text" id="houseIN" value="' + $("#house").text() + '"/>');
            $("#email").html('<input type="text" id="emailIN" value="' + $("#email").text() + '"/>');
            $(this).hide();
            $("#saveData").show();
        });

        $("#saveData").click(function(){
            var username = $("#usernameIN").val();
            var firstn = $("#firstnIN").val();
            var lastn = $("#lastnIN").val();
            var nickn = $("#nicknIN").val();
            var loc = $("#locIN").val();
            var pcode = $("#pcodeIN").val();
            var street = $("#streetIN").val();
            var house = $("#houseIN").val();
            var email = $("#emailIN").val();
            var birth = $("#birthIN").val();
            var country = $("#countryIN").val();
            //alert("username="+username+"&firstn="+firstn+"&lastn="+lastn+"&nickn="+nickn+"&loc="+loc+"&pcode="+pcode+"&street="+street+"&house="+house+"&country="+country+"&birth="+birth+"&email="+email+"&token=<?php echo $_SESSION["token"]; ?>");
            $.ajax({
                url:"apis/changeUserData.api.php",
                type:"POST",
                data:"username="+username+"&firstn="+firstn+"&lastn="+lastn+"&nickn="+nickn+"&loc="+loc+"&pcode="+pcode+"&street="+street+"&house="+house+"&country="+country+"&birth="+birth+"&email="+email+"&token=<?php echo $_SESSION["token"]; ?>",
                success:function(data) {
                    //alert(data);
                    if(data == "true") {
                        location.reload();
                    }
                    else {
                        alert("Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut!");
                    }
                },
                error:function(){
                    alert("Ein unbekannter Fehler ist aufgetreten. Bitte laden Sie die Seite neu und versuchen Sie es erneut!");
                }
            });
        });
    });
</script>
<?php require("content/top2.php"); ?>

<main>
    <h1 class="superduperheadline">ACCOUNT</h1>
    <div id="content">
    <table>
    <?php if(isset($_GET["showID"])) { ?>
    <tr><td class="var">ID</td><td class="value"><?php echo $_SESSION["uid"]; ?></td></tr>
    <?php } ?>
        <tr><td class="var">Benutzername</td><td class="value" id="username"><?php echo $user->getUsername($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">Vorname</td><td class="value" id="firstn"><?php echo $user->getFirstn($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">Nachname</td><td class="value" id="lastn"><?php echo $user->getLastn($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">Spitzname</td><td class="value" id="nickn"><?php echo $user->getNickn($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">Wohnort</td><td class="value" id="loc"><?php echo $user->getLoc($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">Postleitzahl</td><td class="value" id="pcode"><?php echo $user->getPcode($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">Stra&szlig;e</td><td class="value" id="street"><?php echo $user->getStreet($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">Hausnummer</td><td class="value" id="house"><?php echo $user->getHouse($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">Land</td><td class="value" id="country"><?php echo $user->getCountry($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">E-Mail</td><td class="value" id="email"><?php echo $user->getEmail($_SESSION["uid"]); ?></td></tr>
        <tr><td class="var">Geburtsdatum</td><td class="value" id="birth"><?php echo $user->getBirth($_SESSION["uid"], "d. m. Y"); ?></td></tr>
    </table><br/>
    <?php
        $status = $user->getStatus($_SESSION["uid"]);
        if($status == 0) { ?>
            <p>Ihr Account wurde noch nicht aktiviert! <button class="btn" id="sendConfirm">E-Mail erneut anfordern</button></p>
        <?php }
        elseif($status == 2) { ?>
            <p><i><b>BETA</b></i> Sie k&ouml;nnen Pizzas &uuml;ber das Internet bestellen!<br/>(Abholung in der Hafenbar)</p>
        <?php } ?>
        <p><a class="invisible"><button class="btn" id="changeData">Daten &auml;ndern</button></a></p>
        <p><a class="invisible"><button class="btn" id="saveData" style="display: none;">Speichern</button></a></p>
    </div>
</main>

<?php require("content/bottom.php"); ?>