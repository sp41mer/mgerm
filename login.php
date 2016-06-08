<?php
include_once("LIB/connection.php");
include_once("LIB/fnc.php");
setlocale(LC_ALL, 'rus');


function generateRandomCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

if(isset($_POST['submit']))
{
$query = mysql_query("SELECT id, psw, utype FROM users WHERE login='".mysql_real_escape_string($_POST['log'])."'");
$data = mysql_fetch_assoc($query);
if($data['psw'] === $_POST['psw']&& $data['utype']!=2)
{ 
$hash = md5(generateRandomCode(10));
$query = 'UPDATE `users` SET `hash`="'.$hash.'" WHERE `id`='.$data['id'];
mysql_query($query);
setcookie("id", $data['id'], time()+60*60*24*30);
setcookie("hash", $hash, time()+60*60*24*30);

header("Location: check.php"); 
exit();
}
 else
    {
       header("Location: index.php?q=1"); 
	   exit();
    }
}

if(isset($_POST['create_new_user']))
{
header("Location: create.php");
}


?>