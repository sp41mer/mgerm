<?php
include_once("LIB/connection.php");
include_once("LIB/fnc.php");
setlocale(LC_ALL, 'rus');
session_start();
function prnt_fld2($i)
	{
	$query = mysql_query("SELECT * FROM users_settings WHERE num = '".intval($i)."' LIMIT 1");
	$data = mysql_fetch_assoc($query);
	$pole = $data['field'];
	$imya = $data['name'];
	echo "<td>";
	echo $imya;
	echo "</td><td><input type=\"text\" name = \"$pole\" size = \'25\' value =\"";
	echo "\"></td>";
	}
	
IF(@intval($_GET['q'])){
	$q=intval($_GET['q']);
	}
else{
	$q=0;
	}	

if (isset($_POST['go_back']))
	{ 
		header ("Location: admin.php");
	}
		
	//������ ����� ������

if(isset($_POST['submit']))
{	

	$login = $_POST['login'];
	$query = mysql_query("SELECT * FROM `users` WHERE `login`='".$login."'");
	$exists = mysql_num_rows($query);
	if ($exists == 1) { header ("Location: create.php?q=1");}
	else {
	$name = $_POST['name'];
	$psw = $_POST['psw'];
	$ox = $_POST['ox'];
	$oy = $_POST ['oy'];
	$utype = 2;
	$zapros="INSERT INTO med_cert.users(login,name,psw,ox,oy,utype) VALUES ('".$login."', '".$name."', '".$psw."', '".$ox."','".$oy."','".$utype."')";
	mysql_query($zapros);
	header ("Location: admin.php");
	}
}

?>

<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Молине. Создание пользователя</title>
<LINK rel='stylesheet' href='css/med_cert.css' type='text/css'>
<link href="css/overcast/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
        <script src="js/med_cert.js"></script>
<style>
.main {
    margin: auto;
    width:800px;
    }
</style>
</head>
<body>

<form type="submit" method = "post" action = "create.php">
<div class="cont_list">
    <div id='rightcol'>
        <table style="width: 100%">
        <tr>
		<td>
			
		</td>
	</tr>
        <tr>
		<td>
			<button type = "submit" name = "submit" class = "button_top" value = "���������"> Создать </button>

		</td>
	</tr>
	<tr>
		<td>
			<button type = "submit" name = "go_back" class = "button_top" >Назад</button>
		</td>
        </tr>
		
		
        </table>
    
    </div>
<div id='leftcol'>
<div class='list'>
         <div style="text-align:center;">
            <img src='css/logo_med2.png' style="padding:5px;">
            </div>
    </div>
        <br>
    <div class='list'>
	    
		
        <table>
            <tr>
                <td>
                    Модуль печати листка нетрудоспособности
                   <br>"Молине 3.1i"
                </td><td>
                   <b>Сегодня:<br>
                       <? echo (date("d-m-Y "));?></b>
                </td>
            </tr>
			
            <?
						for ($i=1;$i<6;$i++){
							echo "<tr>";
							prnt_fld2($i);	
							echo "</tr>";
						}	
			?>
			
		</table>
		<div id="error1">
		<p> Возникла ошибка
		</div>
		</div>
	
</div>
</div>
</form>

<script type="text/javascript">
Password.onmouseover = function()
{document.getElementById('Password').type = "text";}
Password.onmouseout = function()
{document.getElementById('Password').type = "password";}
</script>
<script type="text/javascript">
$("#error1").hide();
$(document).ready(function(){ 
var $admin = <?php Print($q); ?>;
if($admin == 1) {
	$("#error1").show();
}
});

</script>
</body>

