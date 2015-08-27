<?php require("content/top.php"); ?>
    <style>
        #fields {
            margin: auto;
            text-align: center;
        }

        select {
            border-width: 2px;
        }

        input, select {
            width:60%;
        }
    </style>
    <script>
        $(document).ready(function(){
            $("#submit").click(function(){
                var username = $("#username").val();
                if(username == "") {
                    alert("\"Benutzername\" darf nicht leer sein!");
                    return;
                }

                var firstn = $("#firstn").val();
                if(firstn == "") {
                    alert("\"Vorname\" darf nicht leer sein!");
                    return;
                }

                var lastn = $("#lastn").val();
                if(lastn == "") {
                    alert("\"Nachname\" darf nicht leer sein!");
                    return;
                }

                var nickn = $("#nichn").val();
                if(nickn == "") {
                    alert("\nNickname\" darf nicht leer sein!");
                    return;
                }

                var loc = $("#loc").val();
                if(loc == "") {
                    alert("\"Wohnort\" darf nicht leer sein!")
                    return;
                }

                var pcode = $("#pcode").val();
                if(pcode == "") {
                    alert("\"Postleitzahl\" darf nicht leer sein!");
                    return;
                }

                var street = $("#street").val();
                if(street == "") {
                    alert("\"Straße\" darf nicht leer sein!");
                    return;
                }

                var house = $("#house").val();
                if(house == "") {
                    alert("\"Hausnummer\" darf nicht leer sein!");
                    return;
                }

                var country = $("#country").val();

                var birth = $("#birth").val();
                if(birth == "") {
                    alert("\"Geburtsdatum\" darf nicht leer sein!");
                    return;
                }

                var email = $("#email").val();
                if(email == "") {
                    alert("\"E-Mail\" darf nicht leer sein!");
                    return;
                }

                var passwd1 = $("#password").val();
                if(passwd1 == "") {
                    alert("\"Passwort\" darf nicht leer sein!");
                    return;
                }

                var passwd2 = $("#password2").val();
                if(passwd2 == "") {
                    alert("\"Passwort wiederholen\" darf nicht leer sein!");
                    return;
                }

                if(passwd1 != passwd2) {
                    alert("Die Passwörter stimmen nicht überein!");
                    $("#password").val("");
                    $("#password2").val("");
                    return;
                }

                $.ajax({
                    url:"./apis/reg.api.php",
                    type:"POST",
                    data:"username="+username+"&firstn="+firstn+"&lastn="+lastn+"&nickn="+nickn+"&loc="+loc+"&pcode="+pcode+"&street="+street+"&house="+house+"&country="+country+"&birth="+birth+"&email="+email+"&password="+passwd1,
                    success:function(data) {
                        //alert(data);
                        if(data == "1") {
                            alert("Sie haben sich erfolgreich registriert!");
                            <?php
                                if(!empty($_GET["url"]))
                                    echo "window.location.href = \"".$_GET["url"]."\";";
                                else
                                    echo "window.location.href = \"index.php\";";
                            ?>
                        }
                        else
                            alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.");
                    },
                    error:function() {
                        alert("Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.");
                    }
                });
            });
        });
    </script>
<?php require("content/top2.php"); ?>

    <main>
        <h1 class="superduperheadline">Registrieren</h1>
        <div id="fields"><form>
            <p>Benutzername*<br/>
                <input type="text" id="username" placeholder="Benutzername" required/></p>
            <p>Vorname*<br/>
                <input type="text" id="firstn" placeholder="Vorname" required/></p>
            <p>Nachname*<br/>
                <input type="text" id="lastn" placeholder="Nachname" required/></p></p>
            <p>Spitzname*<br/>
                <input type="text" id="nickn" placeholder="Spitzname" /></p></p>
            <p>Wohnort*<br/>
                <input type="text" id="loc" placeholder="Wohnort" required/></p></p>
            <p>Postleitzahl*<br/>
                <input type="text" id="pcode" placeholder="Postleitzahl" required/></p></p>
            <p>Stra&szlig;e*<br/>
                <input type="text" id="street" placeholder="Stra&szlig;e" required/></p></p>
            <p>Hausnummer*<br/>
                <input type="text" id="house" placeholder="Hausnummer" required/></p></p>
            <p>Land*<br/>
                <select name="c_id" id="country">
                    <?php
                    foreach ($user->getLands() as $key => $value) {
                        foreach ($value as $key2 => $value2) {
                            if($key2 == "c_id")
                                echo "<option value=" . $value2 . ">";
                            elseif($key2 == "name_de")
                                echo $value2 . "</option>";
                        }
                    }
                    ?>
                </select></p>
            <p>Geburtsdatum*<br/>
                <input type="date" id="birth" required/></p></p>
            <p>E-Mail*<br/>
                <input type="text" id="email" placeholder="E-Mail" required/></p></p>
            <p>Passwort*<br/>
                <input type="password" id="password" placeholder="Passwort" required/></p></p>
            <p>Passwort wiederholen*<br/>
                <input type="password" id="password2" placeholder="Passwort wiederholen" required/></p><br/><br/>
            <p><input type="button" id="submit" value="Registrieren" class="btn btn-danger"/></p>

        </form></div>
    </main>

<?php require("content/bottom.php"); ?>