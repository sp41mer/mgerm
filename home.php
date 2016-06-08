<?php
error_reporting(0);
include_once("LIB/connection.php");
include_once("LIB/fnc.php");
setlocale(LC_ALL, 'rus');
function prnt_fld1($i)
	{
	$query = mysql_query("SELECT * FROM users_settings WHERE num = '".intval($i)."' LIMIT 1");
	$data = mysql_fetch_assoc($query);
	$pole = $data['field'];
	$imya = $data['name'];
	IF(isset($_POST['edit'])) {$id = $_POST['edit'];}
	elseif (isset($_POST['submit'])) {$id = $_POST['id'];}
	else  $id = $_COOKIE['id'];
	$query = mysql_query("SELECT * FROM users WHERE id =  '".intval($id)."' LIMIT 1");
    $data2 = mysql_fetch_assoc($query);
	$znachenie = $data2["$pole"];
	echo "<td>";
	echo $imya;
	echo "</td><td><input type=\"text\" name = \"$pole\" size = \'25\' value =\"";
	echo $znachenie;
	echo "\"></td>";
	}

if (!isset($_COOKIE['hash']))
	{
		header("Location: index.php?c=2");
	}

if (isset($_COOKIE['hash']))
	{
		if (isset($_POST['go_back']))
			{
				header ("Location: med_cert_list.php");
			}

		//������ ����� ������
		if(isset($_POST['submit']))
			{
				$name = $_POST['name'];
				$psw = $_POST['psw'];
				$ox = $_POST['ox'];
				$oy = $_POST ['oy'];
				$id = $_POST ['id'];
				mysql_query('UPDATE `users` SET `name`="'.$name.'", `psw`="'.$psw.'",`ox`="'.$ox.'",`oy`="'.$oy.'"  WHERE `id`='.$id);
				header ("Location: home.php?q=1");
			}

		//��������� ����� ������	(����� ��� ��� ??? ��� �������, �� ��� ���� �� ��������)

		$query = mysql_query("SELECT * FROM users WHERE id = '".intval($id)."' LIMIT 1");
		$data1 = mysql_fetch_assoc($query);
	}
IF(isset($_POST['edit']))
{
	$id = $_POST['edit'];
	$admp = 1;
}

IF(@intval($_GET['q'])){
	$q=intval($_GET['q']);
	}
else{
	$q=0;
	}

?>

<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Молине</title>
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
<form type="submit" method = "post" action = "home.php">
<div class="cont_list">
    <div id='rightcol'>
        <table style="width: 100%">
        <tr>
		<td>
			
		</td>
	</tr>
        <tr>
		<td>
			<button type = "submit" id='gotovo' name = "submit" class = "button_top" value = "���������"> Применить </button>

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
                   Модуль печати листов нетрудоспособности
                   <br>"МОЛИНЕ 3.1i"
                </td><td>
                   <b>Сегодня:<br>
                       <? echo (date("d-m-Y "));?></b>
                </td>
            </tr>
			
            <?
						for ($i=1;$i<8;$i++){
							echo "<tr>";
							prnt_fld1($i);	
							echo "</tr>";
						}	
			?>
			
		</table>	
			<div id='changes'>
				��������� �������
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
$('#changes').hide();  
$(document).ready(function(){ 
var $change = <?php Print($q); ?>;
if($change == 1) {
	$("#changes").show('slow');
}
});
</script>
</body>


