<?php
session_start();
session_regenerate_id(true);
include('inc/user.class.php');
include('content/db.php');

$user = new user($db);

if( isset($_POST['username']) AND isset($_POST['password']) ){
    if( $user->checkLogin($_POST['username'], $_POST['password']) ){

        $db_array = $user->getSessionArray($_POST['username']);

        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $db_array['mail'];
        $_SESSION['id'] = $db_array['id'];
        $_SESSION['rights'] = $db_array['rights'];
        $_SESSION['name'] = $db_array['name'];

        header("Location: index.php");
    }else{
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

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php if( isset($error) ){ ?>
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
                                <input class="form-control" placeholder="Benutzername" name="username" type="text" autofocus />
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Passwort" name="password" type="password" value="" />
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>