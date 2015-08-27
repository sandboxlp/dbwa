<?php require("content/top.php"); ?>
<?php
    if(isset($_SESSION["uid"]) && isset($_SESSION["token"]))
        if($user->checkToken($_SESSION["uid"], $_SESSION["token"])) {
            header("Location: account.php");
            die();
        }
?>
<style>
    #fields {
        margin: auto;
        text-align: center;
    }
</style>
<script>

    function select_log() {
        $("#password").prop("disabled", false);
        $("#submit").prop("value", "Einloggen");
    }

    function select_reg() {
        $("#password").prop("disabled", true);
        $("#submit").prop("value", "Weiter");
    }

    $(document).ready(function(){
        $("#submit").click(function(){
            if ($(this).val() == "Einloggen") {
                /** AJAX LOGIN */
                //alert("username=" + $("#username").val() + "&password=" + $("#password").val());
                $.ajax({
                    url: "apis/login.api.php",
                    type: "POST",
                    data: "username=" + $("#username").val() + "&password=" + $("#password").val() + "&cookies=" + $("cookies").val(),
                    success: function (data) {
                        //alert(data);
                        if (data == "true") {
                            alert("Sie wurden erfolgreich angemeldet.");
                            <?php
                                if(!empty($_GET["url"]))
                                    echo "window.location.href = \"".$_GET["url"]."\";";
                                else
                                    echo "window.location.href = \"index.php\";";
                            ?>
                        }
                        else {
                            alert("Benutzername und Passwort stimmen nicht überein!");
                        }
                    },
                    error: function () {
                        alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.");
                    }
                });
            }
            else {
                /** REDIRECT REG */
                window.location.href = "reg.php?username=" + $("#username").val()<?php if(!empty($_GET["url"])) echo " + \"&url=".$_GET["url"]."\""; ?>;
            }
        });
    });
</script>
<?php require("content/top2.php"); ?>

    <main>
        <h1 class="superduperheadline">Login</h1>
        <div id="fields"><form>
            <p>Benutzername<br/>
            <input type="text" name="username" id="username" placeholder="Benutzername" /></p><br/>
            <p>Passwort<br/>
            <input type="password" name="password" id="password" placeholder="Passwort" /></p><br/>
            <p><input type="radio" class="tologin" name="logreg" value="log" id="log" checked="true" onclick="select_log()" /><label for="log">Ich besitze bereits einen Account.</label></p>
            <p><input type="radio" class="tologin" name="logreg" value="reg" id="reg" onclick="select_reg()" /><label for="reg">Ich besitze noch keinen Account.</label></p>
            <p><input type="checkbox" id="cookies"/><label for="cookie" id="cookie-label">Eingeloggt bleiben? (Cookies erlauben?)</label></p>
            <p><input type="button" id="submit" value="Einloggen" class="btn btn-danger"/></p>
        </form></div>
    </main>

<?php require("content/bottom.php"); ?>