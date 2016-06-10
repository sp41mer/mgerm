<?php
include_once("LIB/connection.php");
include_once("LIB/fnc.php");
setlocale(LC_ALL, 'rus');
if (!isset($_COOKIE['hash']))
{
header("Location: index.php?c=2");
}
  session_start();
  $_SESSION['url'] = substr($_SERVER[SCRIPT_NAME],1);
function prnt_fld3()
{
	$query = mysql_query("SELECT id FROM users");
	while ($data = mysql_fetch_assoc($query)) {
		$existing_users[] = $data['id']; 
	}
	$v_users = count($existing_users);
	for ($i=0;$i<$v_users;$i++)
		{
			$cur_user = $existing_users[$i];
			echo "<table class = \"user-info\">";
			echo "<tr class = \"main-tr\">";
			echo "<td colspan=\"2\">";
			$query = mysql_query("SELECT * FROM users WHERE id =  '".intval($cur_user)."' LIMIT 1");
			$data3 = mysql_fetch_assoc($query);
			$appr = $data3['utype'];
			echo 'Name = '.$data3['name']." OX = ".$data3['ox']." OY = ".$data3['oy'];
			echo "</td>";
			echo "</tr>";
			
			for ($j=1;$j<8;$j++)
				{
					$query = mysql_query("SELECT * FROM users_settings WHERE num = '".intval($j)."' LIMIT 1");
					$data = mysql_fetch_assoc($query);
					$pole = $data['field'];
					$imya = $data['name'];
					$query = mysql_query("SELECT * FROM users WHERE id =  '".intval($cur_user)."' LIMIT 1");
					$data2 = mysql_fetch_assoc($query);
					$znachenie = $data2["$pole"];
					echo "<tr class = \"js-tr-to-show\">";
					echo "<td>";
					echo $imya;
					echo "</td><td><input type=\"text\" disabled name = \"$pole\" size = \'25\' value =\"";
					echo $znachenie;
					echo "\"></td>";
					echo "</tr>";
				}
			echo "<tr class = \"js-tr-to-show\">";
			echo "<td colspan=\"2\" align = \"center\">";
			echo "<form type=\"submit\" method = \"POST\" action = \"home.php\">";
			echo "<button type = \"submit\" name = \"edit\" value = $znachenie> Редактировать данные</button>"; //значение последнего выведенного поля(id в данном случае)
			echo "</form>";
			
				if ($appr ==2) 
				{
					echo "<form type=\"submit\" method = \"POST\" action = \"admin.php\">";
					echo "<button type = \"submit\" name = \"approve\" value = $znachenie> Подтвердить регистрацию </button>";
					echo "</form>";
					echo "</td>";
				}	
			echo "</tr>";		
			echo "</table>";			
		}
}

if(isset($_POST['approve']))
			{
			mysql_query('UPDATE `users` SET `utype`="0"  WHERE `id`='.intval($_POST['approve']));
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
	.maintr td {
		font-size:20px;
		font-family:Arial;
		font-weight:bold;
	}
	
	.user-info .js-tr-to-show {
		margin: auto;
		}
</style>
</head>
<body>
<div class="cont_list">
<div id='rightcol'>
        <table style="width: 100%">
        <tr>
		<td>
			
		</td>
	</tr>
     <tr>
		<td>
			<button class="button_top" onclick = 'window.location.replace("med_cert_list.php")' >Назад</button>
		</td>
        </tr>
		<tr>
				<td>
				<button class="button_top" onclick = 'window.location.replace("create.php")'>Создать пользователя</button>
				</td>
			</tr>
		
        </table>
    
    </div>
<!--<form type="submit1" method = "post" action = "admin.php"> ХЗ ЗАЧЕМ ОНА ТУТ БЫЛА -->

    
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
                    Модель печати больничных листов
                   <br>"Молине 3.1i"
                </td><td>
                   <b>Сегодня:<br>
                       <? echo (date("d-m-Y "));?></b>
                </td>
            </tr>
		</table>
		<div class = "list">
		<?
		prnt_fld3();	
		?>		
		</div>		
		

</div>
</div>
<!--</form>-->
</body>
<script type="text/javascript">
$(document).ready(function() {
$(".js-tr-to-show").hide();
});
$(document).ready(function() {
$(".user-info .main-tr").click(function() {
$(this).parent().find(".js-tr-to-show").toggle();
})
});	
</script>
</html>