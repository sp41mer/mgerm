<?php
include_once("LIB/connection.php");
include_once("LIB/fnc.php");

if (!isset($_COOKIE['hash']))
{
header("Location: index.php?c=2");
}

if (isset($_COOKIE['hash']))
	{
		$query = mysql_query("SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
		$data = mysql_fetch_assoc($query);
	}
?>

<!DOCTYPE html>
<html><head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" /><title>������ ������������������</title>
<LINK rel='stylesheet' href='css/med_cert_print.css' type='text/css'>
</head>
<body>
<div  class = 'prnt'>
    <table style="width: 100%">
	<tr>
		<td style="width: 50%; text-align: left;" >
<!--                       <button class="button_top" onclick='window.location.replace("med_cert_list.php")'>
                            � ������ ������� ������������������</button>-->
                </td>
		<td style="width: 50%; text-align: right;">
                       <button class= 'button_top'  title='������' onclick='window.print()'>
                            ������</button>
                      <button class="button_top" onclick='window.location.replace("med_cert_list.php")'>
                            � ������ ������� ������������������</button>
                    <button class="button_top" onclick='window.location.replace("index.php")'>�����</button>
		</td>

			

	</tr>
    </table>
   
</div>
<div style="top:<?php Print($data['oy']); ?>mm; position:absolute; left:<?php Print($data['ox']); ?>mm; width:210mm; margin: 0;">
<?php

include_once("LIB/connection.php");
include_once("LIB/fnc.php");
$lnid=intval($_GET['lnid']);
$lng=intval($_GET['lng']);



if (intval($_GET['usr'])<>0){
    $usr=intval($_GET['usr']);
}
else{
    $usr=1;
	}
save_data($lnid, $lng);
prnt_all($usr,$lng);
//������ � ������� ������������� ������� ������ ������ � ������ ������. ������ ���������� �� ����� ����� ������� �������� ������. ��������� �� ������� $_POST.
// �������� ������ - �������� name � ����� � ������� input
//if ($_POST['first']==1)  print_check_coord(11,66);
//if ($_POST['first']==2) print_check_coord(16,66);
//print_on_coord(12,101,$_POST['predlist']);
//print_on_coord(19.5,53,$_POST['nazvorg']);
//print_on_coord(26.5,53,$_POST['adrorg']);
//print_date_coord(33,69,$_POST['vidach']);
//print_on_coord(33,109,$_POST['ogrn']);
//print_on_coord(41,53,$_POST['fam']);
//print_on_coord(47,53,$_POST['im']);
//print_on_coord(53,53,$_POST['otch']);
//print_date_coord(61,9.5,$_POST['dr']);
//if ($_POST['sex']==1)  print_check_coord(62.5,58);
//if ($_POST['sex']==2) print_check_coord(62.5,66);
//print_on_coord(61,129,$_POST['cod']);
//print_on_coord(61,141,$_POST['dopcod']);
//print_on_coord(61,157,$_POST['codizm']);
//print_on_coord(68,9.5,$_POST['mestrab']);
//if ($_POST['osnov']==1)  print_check_coord(76.5,22);
//if ($_POST['osnov']==2)  print_check_coord(76.5,54);
//if ($_POST['osnov']==3)  print_check_coord(76.5,154);
//print_on_coord(77,75,$_POST['nomer']);
//print_date_coord(83,13,$_POST['data1']);
//print_date_coord(83,57,$_POST['data2']);
//print_on_coord(83,101,$_POST['nomput']);
//print_on_coord(83,144.5,$_POST['ogrnsan']);
//print_on_coord(89,49,$_POST['fiouhod']);
//if ($_POST['berem']==1)  print_check_coord(104,93);
//if ($_POST['berem']==2) print_check_coord(104,109);
//print_on_coord(108,49,$_POST['rezhim']);
//print_date_coord(108,69,$_POST['rezhdata']);
//print_date_coord(113.5,49,$_POST['stacs']);
//print_date_coord(113.5,97,$_POST['stacpo']);
//print_date_coord(120,49,$_POST['naprdata']);
//print_date_coord(126,49,$_POST['regdata']);
//print_date_coord(132,49,$_POST['osvdata']);
//
//
//
//print_date_coord(144,7.5,$_POST['datas1']);
//print_date_coord(144,43.5,$_POST['datapo1']);
//print_colon_coord(144,79,9,$_POST['dolzhn1']);
//print_colon_coord(149,79,9,$_POST['dolzhn11']);
//print_colon_coord(144,115,14,str_replace(".","",$_POST['fiovr1']));
//print_colon_coord(149,115,14,str_replace(".","",$_POST['fiovr11']));
//
//if(intval($_POST['hystorynumber']/100)<10000){
//print_date_coord_with_check(154,7.5,$_POST['datas2']);
//print_date_coord_with_check(154,43.5,$_POST['datapo2']);}
//else{
//print_date_coord(154,7.5,$_POST['datas2']);
//print_date_coord(154,43.5,$_POST['datapo2']);}
//
//print_colon_coord(154,79,9,$_POST['dolzhn2']);
//print_colon_coord(159,79,9,$_POST['dolzhn22']);
//print_colon_coord(154,115,14,str_replace(".","",$_POST['fiovr2']));
//print_colon_coord(159,115,14,str_replace(".","",$_POST['fiovr22']));
//
//if(intval($_POST['hystorynumber']/100)<10000){
//print_date_coord_with_check(164,7.5,$_POST['datas3']);
//print_date_coord_with_check(164,43.5,$_POST['datapo3']);}
//else{
//print_date_coord(164,7.5,$_POST['datas3']);
//print_date_coord(164,43.5,$_POST['datapo3']);}
//
//print_colon_coord(164,79,9,$_POST['dolzhn3']);
//print_colon_coord(169,79,9,$_POST['dolzhn33']);
//print_colon_coord(164,115,14,str_replace(".","",$_POST['fiovr3']));
//print_colon_coord(169,115,14,str_replace(".","",$_POST['fiovr33']));
//
//print_date_coord(175,49,$_POST['krabs']);
//print_on_coord(175,107,$_POST['inoe1']);
//print_date_coord(175,119,$_POST['inoe2']);
////print_on_coord(182,49,$_POST['predlist']);
//
//
//
//if ($_POST['first']==1)  print_check_coord(255,66);
//if ($_POST['first']==2)  print_check_coord(260,66);
//print_on_coord(257.3,101,$_POST['predlist']);
//print_on_coord(263.3,13,$_POST['fam']);
//print_on_coord(269.3,13,$_POST['im']);
//print_on_coord(269.5,140.5,str_replace(".","",$_POST['fiovr1']));
//print_on_coord(275.3,13,$_POST['otch']);
//print_on_coord(276.8,165,$_POST['hystorynumber']);
//print_on_coord(282.3,13,$_POST['mestrab']);
//print_date_coord(282.3,165,$_POST['vidach']);
//if ($_POST['osnov']==1)  print_check_coord(291,22);
//if ($_POST['osnov']==2)print_check_coord(291,54);

?>
</div></body></html>
