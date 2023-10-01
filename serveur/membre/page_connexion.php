<!DOCTYPE html>
<html lang="en">

<head>
    <title>Elite Automobile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="../../client/utilitaires/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="../../client/css/login.css">
    <link rel="stylesheet" type="text/css" href="../../client/css/style.css">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('../../client/images/back-ground-login.avif');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Account Login
                </span>
                <form class="login100-form validate-form p-b-33 p-t-5" action="connexion.php" method="POST">

                    <div class="wrap-input100 validate-input" data-validate="Enter courriel">
                        <input class="input100" type="text" name="courriel" placeholder="Courriel">
                        <span class="focus-input100"><img class="logo" src="../../client/images/username.png"></img></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter mdp">
                        <input class="input100" type="password" name="mdp" placeholder="Mot de passe">
                        <span class="focus-input100" ><img class="logo" src="../../client/images/password.png"></img></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn">
                            Se connecter
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>