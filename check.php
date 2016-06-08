<?php
include_once("LIB/connection.php");
include_once("LIB/fnc.php");
setlocale(LC_ALL, 'rus');

if (isset($_COOKIE['hash']))
{
    $query = mysql_query("SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysql_fetch_assoc($query);

    if(($userdata['hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $_COOKIE['id']))
    {
		echo $userdata['user_hash'];
		echo $_COOKIE['hash'];
		echo $userdata[user_id];
    }
    else
    {
        header("Location: med_cert_list.php");
    }
}
else
{
    print "Включите куки";
}
?>