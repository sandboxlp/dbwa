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
            <p>Spitzname<br/>
                <input type="text" id="nickn" placeholder="Spitzname" /></p></p>
            <p>Wohnort*<br/>
                <input type="text" id="loc" placeholder="Wohnort" required/></p></p>
            <p>Postleitzahl*<br/>
                <input type="text" id="pcode" placeholder="Postleitzahl" required/></p></p>
            <p>Stra&szlig;e*<br/>
                <input type="text" id="street" placeholder="Stra&szlig;e" required/></p></p>
            <p>Hausnummer*<br/>
                <input type="number" id="house" placeholder="Hausnummer" required/></p></p>
            <p>Land*<br/>
                <select name="c_id">
                    <?php
                    foreach ($user->getLands() as $key => $value) {
                        foreach ($value as $key2 => $value2) {
                            echo "<option value=" . $key . ">" . $value2 . "</option>";
                            echo $key2;
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