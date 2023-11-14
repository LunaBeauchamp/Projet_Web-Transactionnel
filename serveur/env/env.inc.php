<?php
    define('SERVEUR','127.0.0.1');
    define('USAGER','root');
    define('MDP','');
    define('BD','bdboutique');
    define('PORT',3306);

    // Database Configuration 
    define('DB_HOST', 'localhost'); 
    define('DB_NAME', 'Your Database Name'); 
    define('DB_USERNAME', 'Your Database Username'); 
    define('DB_PASSWORD', 'Your Database Password'); 

    // PayPal Configuration
    define('PAYPAL_EMAIL', 'luna.beauchamp19@hotmail.com'); 
    define('RETURN_URL', 'http://localhost/Projet_Web-Transactionnel/serveur/Paypal/return.php'); 
    define('CANCEL_URL', 'http://localhost/Projet_Web-Transactionnel/serveur/Paypal/cancel.php'); 
    define('NOTIFY_URL', 'http://localhost/Projet_Web-Transactionnel/serveur/Paypal/notify.php'); 
    define('CURRENCY', 'USD'); 
    define('SANDBOX', TRUE); // TRUE or FALSE 
    define('LOCAL_CERTIFICATE', FALSE); // TRUE or FALSE

    if (SANDBOX === TRUE){
        $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    }
    // PayPal IPN Data Validate URL
    define('PAYPAL_URL', $paypal_url);
?>