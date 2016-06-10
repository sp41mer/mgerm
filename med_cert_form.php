<?php 
include_once("LIB/connection.php");
include_once("LIB/fnc.php");
if (!isset($_COOKIE['hash']))
{
header("Location: index.php?c=2");
}
if(isset($_POST['savesubmit']))
{
save_data();
}

IF(intval($_GET['machen'])){
	$machen=intval($_GET['machen']);
}
else{
	echo "����� ��Ȩ�!";
	die();
}

IF(intval($_GET['id'])){
	$lnid=intval($_GET['id']);
}
else{
	$lnid=new_sert();
}


IF($machen == 5){
//�������� ����
$query = get_form_list_settings();//mysql_query("SELECT * FROM med_cert.form_list_settings");
$i=0;
$form_list=array();
 while ($row = mysql_fetch_assoc($query)) { 
        $form_list[$i]["np"]= $row["uid"]; 
        $form_list[$i]["txt"]=$row["shift_x"]; 
		$form_list[$i]["tpe"]= $row["shift_y"];
        $form_list[$i]["lnght"]= $row["u_o_id"];
		$form_list[$i]["style"]= $row["style"];
		$i++;
    } 
$form_list_lng=$i;


}

else{
//�������� ����
$query = get_form_list();//mysql_query("SELECT * FROM med_cert.form_list");
$i=0;
$form_list=array();
 while ($row = mysql_fetch_assoc($query)) { 
        $form_list[$i]["np"]= $row["np"]; 
        $form_list[$i]["txt"]=$row["txt"]; 
		$form_list[$i]["tpe"]= $row["tpe"];
        $form_list[$i]["lnght"]= $row["lngth"];
		$form_list[$i]["style"]= $row["style"];
		$i++;
    } 
$form_list_lng=$i;


// �������� �������� ���������� �������
$query = get_form_list_values(); //mysql_query("SELECT * FROM med_cert.form_list_values");
$form_list_values=array();
 while ($row = mysql_fetch_assoc($query)) { 
		$form_list_values[$row["id"]]["list_id"]= $row["list_id"]; 
                $form_list_values[$row["id"]]["order"]= $row["order"]; 
		$form_list_values[$row["id"]]["value"]= $row["value"]; 
    } 
$form=get_form_data($lnid);	
//echo $form;
}


?>




<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Молине</title>
<LINK rel='stylesheet' href='css/med_cert.css' type='text/css'>
<link href="css/overcast/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
        <script src="js/med_cert.js"></script>
		<script> $(function(){
				$(window).scroll(function() {
					var top = $(document).scrollTop();
						if (top < 100) $(".tbody").css({top: '0', position: 'relative'});
						else $(".tbody").css({top: '10px', position: 'fixed'});
					});
				}); </script>
<style>

</style>

</head>
<body>
<div class="cont_form">
<div class ="r_col">
<div id='rightcol'>
        <table style="width: 100%">
          
			<tr>
				<td>
					<button type="submit" form="form_main" id="save" class= 'button_top'  title='������' >Печать/Сохранить</button>

				</td>
			</tr> 
	<tr>
		<td>
			<button class="button_top" onclick='window.location.replace("med_cert_list.php")'>К списку листов нетрудоспособности</button>
		</td>
        </tr>
        <tr>
		<td>
			<button class="button_top" onclick='window.location.replace("index.php")'>Выход</button>
		</td>
        </tr>
        </table>
    
    </div></div>
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
                       Новый листок нетрудоспособности:
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <form action="med_cert.php?lnid=<?echo $lnid;?>&lng=<?echo $form_list_lng?>" method="post" id="form_main">
        <div class="list">
                <table>
                        <tr>
                                <td width="5%"></td>
                            <td width="50%" >Имя поля</td>
                            <td width="45%">Значение поля</td>
                   </tr>
                <?
                        for ($i=0;$i<$form_list_lng;$i++){
                                $t="q".$i;
                                echo "<tr>";
                                        prnt_fld($i,$form_list[$i]['tpe'],$form_list[$i]['lnght'],$form_list[$i]['txt'],$form_list[$i]['style'],$form_list_values,$form[$i]);
                                echo "</tr>";
                        }	
                ?>


                </table>
        </div>
            <br>
            <table style="width: 100%">
                <tr>
        <!--		<td style="width: 50%; text-align: right" >

                        </td>-->
                        <td style="width: 100%; text-align: center;">

                        </td>
                </tr>
        </table>
        <!--<button type=submit id="submit" class= 'but_image'  title='������' ><img src='CSS/print.png'></button>-->
        <?//<input type=submit id="submit" value=������ name=������ class='sbmt' />?>

        </form>
    </div>
</div>
<script type="text/javascript">
function getTopOffset(e) { 
	var y = 0;
	do { y += e.offsetTop; } while (e = e.offsetParent);
	return y;
}
var block = document.getElementById('rightcol'); /* rightcol - �������� �������� id ����� */
if ( null != block ) {
	var topPos = getTopOffset( block );
	window.onscroll = function() {
		var newcss = (topPos < window.pageYOffset) ? 
			'padding-left: 750px; width: 250px; ; position: fixed;' : 'position:static;'; /*��������� ������ :( */
		block.setAttribute( 'style', newcss );
	}
}
</script>
</body>

</html>
