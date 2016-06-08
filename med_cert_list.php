<?php 
include_once("LIB/connection.php");
include_once("LIB/fnc.php");
setlocale(LC_ALL, 'rus');

if (!isset($_COOKIE['hash']))
{
header("Location: index.php?c=2");
}


IF(intval($_GET['sort'])){
	$sort=intval($_GET['sort']);
}
else{
	$sort=1;
}
IF(intval($_GET['way'])){
	$way=intval($_GET['way']);
}
else{
	$way=1;
}

IF(intval($_GET['delete'])==1){
	delete_row_list(intval($_GET['id']));
}
echo mysql_error();

$query = get_list($sort,$way);//mysql_query("SELECT * FROM med_cert.form_list");

$i=0;
$list=array();
 while ($row = mysql_fetch_assoc($query)) { 
        $list[$i]["id"]= $row["id"]; 
        $list[$i]["crtdt"]=$row["crtdt"]; 
		$list[$i]["q0"]= $row["q0"];
        $list[$i]["q7"]= $row["q7"];
	$list[$i]["q8"]= $row["q8"];
	$list[$i]["q9"]= $row["q9"];
	$i++;
    } 
$list_lng=$i;

$query2 = mysql_query("SELECT * FROM users WHERE id =  '".intval($_COOKIE['id'])."' LIMIT 1");
$data2 = mysql_fetch_assoc($query2);
$q = $data2['utype'];
//echo $q;
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
			<button class="button_top" onclick='window.location.replace("med_cert_form.php?machen=1")'>Новый лист нетрудоспособности</button>

		</td>
	</tr>
	<tr>
		<td>
			<button class="button_top" onclick='window.location.replace("med_cert_list.php")'>К списку листов нетрудоспособности</button>
		</td>
        </tr>
		<tr>
		<td>
			<button class="button_top" onclick='window.location.replace("home.php")'>Настройки</button>

		</td>
	</tr>
	<tr>
		<td>
			<button class="button_top" onclick='window.location.replace("admin.php")'id ='admin-button' >Администратор</button>

		</td>
	</tr>
        <tr>
		<td>
			<button class="button_top" onclick='window.location.replace("index.php?c=1")'>Выход</button>
		</td>
        </tr>
		
        </table>
    
    </div>
    <div id='leftcol'>
    <div class='list'>
         <div style="text-align:center;">
            <img src='css/logo_med.png' style="padding:5px;">
            </div>
    </div>
        <br>
    <div class='list'>
        
        <table>
            <tr>
                <td>
                   Модуль печати листов нетрудоспособности
                   <br>"Молине 3.1i"
                </td><td>
                    <b>Сегодня:<br>
                       <? echo (date("d-m-Y "));?></b>
                </td>
            </tr>
            <tr>
                <td >
                   Список листов нетрудоспособности:
                </td>
            
            </tr>
        </table>
    </div>
        <br>
    <div class="list">

            <table>
                    <tr>
                            <?prnt_head($sort,$way);?>

               </tr>
            <?
                    $i=1;
                    foreach ($list as $v) {
                            echo "<tr>";
                                    prnt_list($i,$v);
                            echo "</tr>";
                            $i++;
                            }

            ?>	
            </table>
            </div>
    </div>
</div>
<script type="text/javascript"> 
$("#admin-button").hide();
$(document).ready(function(){ 
var $admin = <?php Print($q); ?>;
if($admin == 1) {
	$("#admin-button").show();
}
});

</script>	
</body>

</html>
