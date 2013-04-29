<?php
//This is your SQL database name. Must be manually set.
$als_database = "";

//The SQL account. Must be manually set.
$als_SQLusername = "";
$als_SQLpassword = "";

//Other configuration settings
$als_noSpecialCharacters = true; //default true, strips non-alphanumeric characters from username registration
$als_returnToPrevious = true; //default true, automatically returns users after a form is submitted
$als_returnToPreviousFix = false; //default false, set to true if redirection is broken (can happen with subdomains)
$als_logoutRedirectURL = "http://google.com"; //default Google, the URL users are redirected to after accessing als_logout.php.

//This is your SQL table name. Only change this if you used a table name other than the default.
$als_table = "als_users";


//---------------------------------------------
//Additional Required Functions - Do Not Modify
//---------------------------------------------
$con = mysqli_connect("localhost", "$als_SQLusername", "$als_SQLpassword");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

function db_result($result, $row, $field)
{
    if ($result->num_rows == 0)
        return 'unknown';
    $result->data_seek($row);
    $ceva = $result->fetch_assoc();
    $rasp = $ceva[$field];
    return $rasp;
}

$one  = 1;
$zero = 0;
$true = true;

if (!mysqli_select_db($con, $als_database)) {
    echo "Database " . $als_database . " not found.";
}

// http://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
// Originally posted on Stack Overflow by user Scott (Dec. 5, 2012), edited by user Andrew (Dec. 6, 2012)

function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
}

function getToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    for($i=0;$i<$length;$i++){
        $token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
    }
    return $token;
}

// PHPass 0.3
require "PasswordHash.php";
$PHPass = new PasswordHash(8, FALSE);

?>