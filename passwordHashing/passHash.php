<?php

$password = "password";

//I don't validate the input just for the sake of understanding the concept.

//You first hash the password by doing this:

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//Then see the output:

var_dump($hashed_password);

if(password_verify ($password, $hashed_password)){
    echo "TRUE";
} else {
    echo "FALSE";
}

if(!password_verify ($password, $hashed_password)){
    echo "TRUE";
} else {
    echo "FALSE";
}

?>