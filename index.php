<?php
include_once("LIB/connection.php");
include_once("LIB/fnc.php");
setlocale(LC_ALL, 'rus');

////$date = getdate(); //check date
////$day = $date[mday];
////$comentariy = mysql_query("SELECT comment FROM users WHERE login =  'auth' LIMIT 1");
////$comment = mysql_fetch_assoc($comentariy);
////if ($comment[comment] != $day) //check date at db and real
////{
////$info = shell_exec('systeminfo');
////preg_match("/[[:alnum:]]{5}-[[:alnum:]]{3}-[[:alnum:]]{7}-[[:alnum:]]{5}/", $info, $serial);
////echo '�������� �����: '.$serial[0];
////echo '<br>';
////$verif = $serial[0];
////$query8 = mysql_query("SELECT psw FROM users WHERE login =  'auth' LIMIT 1");
////$data2 = mysql_fetch_assoc($query8);
////if ($verif == $data2['psw'])
//// {
////   echo '��� �������';
////   mysql_query('UPDATE `users` SET `comment`="'.$day.'" WHERE `id`=15');
//// }
////else echo '!';
////}


IF(@intval($_GET['c'])){
	$c=intval($_GET['c']);
}
else {$c=0;}
IF ($c==1)
{
	setcookie("id", "", time() - 3600*24*30*12, "/");
	setcookie("hash", "", time() - 3600*24*30*12, "/");
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
	<title>МОЛИНЕ</title>
	<LINK rel='stylesheet' href='css/med_cert.css' type='text/css'>
	<link href="css/overcast/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
	<script src="js/med_cert.js"></script>
	<style>
		.error2 {
			font: bold 110% serif;
			width: 80%;
			max-width: 550px;
			margin: 10px auto;
			padding: 1em;
			box-shadow:
			0 1px 4px rgba(0, 0, 0, .3),
			-23px 0 20px -23px rgba(0, 0, 0, .8),
			23px 0 20px -23px rgba(0, 0, 0, .8),
			0 0 40px rgba(0, 0, 0, .1) inset;
		}

		.ajax_list
		{
			text-align: left;
			border: 1px solid #d1d6e7;
			font: normal 90% serif;
			display: none;
		}
	</style>

</head>
<body>
<div class="login_form">
	<div class='list'>
		<div style="text-align:center; background-color:#006fb9;">
			<img overflow = "hidden" width = "98%" src='css/logo_med.png' style="padding:2px;">
		</div>
	</div>
	<br>
	<div class='list'>

		<form action="login.php" id="aform" method="POST">

			<table>
				<tr>
					<td>
						Модуль печати больничных листов
						<br>"МОЛИНЕ 3.1i"
					</td><td>
						<b>Сегодня:<br>
							<? echo (date("d-m-Y "));?></b>
					</td>
				</tr>

				<tr>
					<td>Имя пользователя:</td>
					<td><input type="text" name="log" size='25' autofocus>
						<div class = "ajax_list" id = "ajax_list">
							<input type="text" name="query" id="search_box" value="" autocomplete="off">
						</div>
					</td>
				</tr>
				<tr>
					<td>Пароль:</td>
					<td><input type="password" name="psw" size='25'></td>
				</tr>

				<tr>
					<td colspan="2"></td>
				</tr>

			</table>
			<tr>
				<td><input name="submit" type="submit" value="Войти"></td>
			</tr>
			<p>


		</form>

		<form id="error1" method = "POST">
			<p> Неправильный логин/пароль
		</form>
	</div>
	<br>

	<div class = "error2" id = "error2">

		<p> Вы не авторизованы

	</div>
	<br>

</div>
<br>


</form>
</div>
<script type="text/javascript">
	var WrongPass = <?php Print($q); ?>;
	if (WrongPass != 1) error1.style.display = 'none';
	WrongPass = 0;
	var SpyAttack = 0;
	var SpyAttack = <?php Print($c); ?>;
	if (SpyAttack != 2)
	{ error2.style.display = 'none';

	}
	else
	{
		error2.style.backgroundColor = "#F5B8B0";
		function startAnim(element, time) {
			element.animTimer = setInterval(function () {
				if (element.style.display == "none")
					element.style.display = "";
				else
					element.style.display = "none";
			}, time);
		}
		function stopAnim(element) {
			clearInterval(element.animTimer);
		}
		startAnim(document.getElementById("error2"), 500);
		document.getElementById("error2").onmouseover = function () {
			stopAnim(this);
		};
		document.getElementById("error2").onmouseout = function () {
			startAnim(this, 500);};
	}

</script>






</body>
