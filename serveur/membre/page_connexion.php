<?php
if(isset($_COOKIE["PHPSESSID"])){
unset($_COOKIE["PHPSESSID"]);
}
session_start();
$msg="";
if(isset($_GET['msg'])){
$msg = $_GET['msg'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../client/css/login.css">
    <link rel="stylesheet" type="text/css" href="../../client/css/style.css">

    <title>EliteAutomobile</title>
    <script src="client/utilitaires/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="/client/js/global.js"></script>

</head>

<body onLoad='montrerToast("<?php echo $msg; ?>");'>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('../../client/images/back-ground-login.avif');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Account Login
                </span>

                <form class="login100-form validate-form p-b-33 p-t-5" action="connexion.php" method="POST">

                    <div class="wrap-input100 validate-input" data-validate="Enter courriel">
                        <input class="input100" type="text" name="courriel" placeholder="Courriel">
                        <span class="focus-input100"><img class="logo"
                                src="../../client/images/username.png"></img></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter mdp">
                        <input class="input100" type="password" name="mdp" placeholder="Mot de passe">
                        <span class="focus-input100"><img class="logo"
                                src="../../client/images/password.png"></img></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn">
                            Se connecter
                        </button>
                    </div>

                </form>
                <div class="toast posToast" role="status" aria-live="polite" aria-atomic="true" data-delay="5000">
                    <div class="toast-header">
                        <div id="textToast" class="toast-body" style="color:red;"></div>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>