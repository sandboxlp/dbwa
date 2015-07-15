<?php
session_start();
session_regenerate_id(true);
include('content/user.class.php');
include('content/db.php');

$user = new user($db);

if (isset($_POST['username']) AND isset($_POST['password'])) {
    if ($user->userExists($user->getUserId($_POST['username']))) {
        if ($user->checkLogin($user->getUserId($_POST['username']), $_POST['password'])) {
            $error = "Login erfolgreich. Wenn Sandy hier war, solltte hier eine Weiterleitung sein.";
        } else {
            $error = "MÖP MÖP MÖP... EY DA ISCH WASCH FALSCH!";
        }
    } elseif (isset($_POST['firstn']) AND isset($_POST['lastn']) AND isset($_POST['loc']) AND isset($_POST['pcode']) AND isset($_POST['street']) AND isset($_POST['house']) AND isset($_POST['c_id']) AND isset($_POST['email']) AND isset($_POST['birth']) AND isset($_POST['pw1']) AND isset($_POST['pw2'])) {
        if ($_POST['pw1'] == $_POST['pw2']) {
            $user->newUser($_POST['firstn'], $_POST['lastn'], $_POST['username'], $_POST['loc'], $_POST['pcode'], $_POST['street'], $_POST['house'], $_POST['c_id'], $_POST['email'], $_POST['birth'], 0, $_POST['pw1']);
        } else {
            $error = "Ey du, gugst du! Die Passwörter sind nischt gleich, alter!";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $_SERVER['SERVER_NAME']; ?> - Login</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger">
                    <strong>Fehler:</strong> <?php echo $error; ?>
                </div>
            <?php } ?>
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Bitte melden Sie sich an.</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Benutzername" name="username" type="text"
                                       autofocus/>

                                <p class="help-block">Benutzername</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Passwort" name="password" type="password"
                                       value=""/>

                                <p class="help-block">Passwort</p>
                            </div>
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Login"/>
                        </fieldset>
                        <br>
                        <label>Noch nicht registriert? Hier Anmelden:</label>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Vorname" name="firstn" type="text">

                                <p class="help-block">Vorname</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Nachname" name="lastn" type="text">

                                <p class="help-block">Nachname</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Benutzername" name="username" type="text">

                                <p class="help-block">Benutzername</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Ort" name="loc" type="text">

                                <p class="help-block">Ort</p>
                                <div class="form-group">
                                <input class="form-control" placeholder="Postleitzahl" name="pcode" type="text">

                                <p class="help-block">Postleitzahl</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Straße" name="street" type="text">

                                <p class="help-block">Straße</p>
                                <input class="form-control" placeholder="Hausnummer" name="house" type="text">

                                <p class="help-block">Hausnummer</p>
                            </div>
                            <div class="form-group">
                                <select name="c_id">
                                    <?php
                                    foreach ($user->getLands() as $key => $value) {
                                        foreach ($value as $key2 => $value2) {
                                            echo "<option value=" . $key . ">" . $value2 . "</option>";
                                            echo $key2;
                                        }
                                    }
                                    ?>
                                </select>

                                <p class="help-block">TODO DROPDOWN HERE</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="email" type="email">

                                <p class="help-block">Email</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Geburtsdatum" name="birth" type="text">

                                <p class="help-block">Geburtsdatum</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Status" name="state" type="text">

                                <p class="help-block">STATE</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Passwort" name="pw1" type="password">

                                <p class="help-block">Passwort</p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Nachname" name="pw2" type="password">

                                <p class="help-block">Passwort best&auml;tigen</p>
                            </div>
                            <input type="submit" class="btn btn-lg btn-danger btn-block" value="Registrieren"/>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>