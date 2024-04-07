<?php

/*
The purpose of this page is to store user information, and since the use of databases are not allowed. All of the users information will be stored inside a text file.
After the user has registered, they should be prompted with a link to go to the login page.
*/

$File = 'userInfo.txt';

// This portion of php with how we collect the information from the register.html page
$username = trim($_POST['username']);
$fname = trim($_POST['firstname']);
$lname = trim($_POST['lastname']);
$password = trim($_POST['password']);
$password_confirm = trim($_POST['password_confirm']);

// I'll ask users to confirm passwords just like in many register pages, and the passwords will be checked using an if statement
if($password !== $password_confirm) {
    die('Passwords do not match. Please Try again!');
}

$Text_Entry = "Username: $username, FirstName: $fname, LastName: $lname, Password: $password\n";


if(file_put_contents($File, $Text_Entry, FILE_APPEND | LOCK_EX) == false) {
    die("An error has occurred with saving your information");
}

echo'You have been Registered. <a href="login.html">Login In Here</a>';
?>
