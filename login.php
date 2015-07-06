<?php
session_start();
session_regenerate_id(true);
include('content/user.class.php');
include('content/db.php');

$user = new user($db);

if (isset($_POST['username']) AND isset($_POST['password'])) {
    if ($user->checkLogin($_POST['username'], $_POST['password'])) {

        $db_array = $user->getSessionArray($_POST['username']);

        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $db_array['mail'];
        $_SESSION['id'] = $db_array['id'];
        $_SESSION['rights'] = $db_array['rights'];
        $_SESSION['name'] = $db_array['name'];

        header("Location: index.php");
    } else {
        $error = "LOGIN FALSCH";
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
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Passwort" name="password" type="password"
                                       value=""/>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Login"/>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>