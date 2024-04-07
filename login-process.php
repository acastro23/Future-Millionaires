<?php

/*
 This File checks if user credentials are stored in the userInfo text file. If they are then they should be directed to the play page, and we'll set a cookie
 If credentials are not in the text file then they will be presented an error with the option to try again or a link that will direct them to the register page.
 */

$File = 'userInfo.txt';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$loginStatus = false;

if (file_exists($File)) {
    $lines = file($File, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($savedUsername, $savedFname, $savedLname, $savedPassword) = explode(', ', $line);
        
        $savedUsername = str_replace('Username: ', '', $savedUsername);
        $savedFname = str_replace('FirstName: ', '', $savedFname);
        $savedLname = str_replace('LastName: ', '', $savedLname);
        $savedPassword = str_replace('Password: ', '', $savedPassword);
        
        if ($username === $savedUsername && $password === $savedPassword) {
            $loginStatus = true;
            break;
        }
    }
    
    if ($loginStatus) {
        setcookie('username', $username, time() + 86400, '/'); // Login successful, set a cookie -- Time set 1 day
        header('Location: lobby.html');
        exit;
    } else {
        echo 'Login failed. <a href="login.html">Try again</a> or <a href="register.html">Register</a>.';
    }
} else {
    die("The file containing user information does not exist.");
}

?>
