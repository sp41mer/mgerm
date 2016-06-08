<?php
error_reporting(0);
//������ ������� � med_cert_form 
//������� ��������� �� ������� �������� � ����
function prnt_fld($i,$tpe,$lng,$txt,$style,$form_list_values,$val){
	
	echo "<td>";
	echo $i;
	echo "</td>";
	$fld="<td ";
		if ($tpe==0){//text-align:center;
			echo $fld."colspan='2' style='".$style."'>".$txt."</td>";
		}
		else{//padding-left: 70px;
			echo $fld." style='".$style."'>".$txt."</td>";
		}
		
	if ($tpe==1){
		echo "<td>";
		echo "<select width='50' name='q".$i."' >";
			foreach ($form_list_values as $v) {
				if ($v['list_id']==$i){
                                    $w="";
                                    if($v['order']==$val) $w="selected";
                                    echo "<option ".$w." value='".$v['order']."' >".$v['value']."</option>";
			
                                }
                        }
		echo "</select>";
		echo "</td>";
	}
	elseif ($tpe==2){
		echo "<td>";
		echo "<input class='dtselect' title='' type='text' name='q".$i."' value='".$val."' maxlength='".$lng."'  size='50'>";
		echo "</td>";
	}
	elseif ($tpe==3){
		echo "<td>";
		echo "<input title='' type='text' name='q".$i."' value='".$val."' maxlength='".$lng."'  size='50'>";
		echo "</td>";
	}
	elseif ($tpe==4){
		echo "<td>";
		echo "<input title='' type='text' name='q".$i."' value='".$val."' maxlength='".$lng."'  size='50'>";
		echo "</td>";
	}
	return '';
}
 
//������ ��������� � ����������� med_cert_list
function prnt_head($sort,$way){ 
			echo "<td width='5%'></td>";
                        echo "<td width='45%'><a href='med_cert_list.php?sort=1&way=";
				if ($sort==1){echo -$way;}
				else echo $way;
			echo "'>ФИО</a></td>";
			
                        
			echo "<td width='15%'><a href='med_cert_list.php?sort=2&way=";
				if ($sort==2){echo -$way;}
				else echo $way;
			echo "'>Дата</a></td>";
			
			echo "<td width='15%'><a href='med_cert_list.php?sort=3&way=";
				if ($sort==3){echo -$way;}
				else echo $way;
			echo "'>№ листка нетрудопособности</a></td>";
                        
			echo "<td width='10%'></td>";
}
// ������ ���� ������� med_cert_list
function prnt_list($i,$list){
	echo "<td>".$i."</td>";
	echo "<td><a href='med_cert_form.php?machen=2&id=".$list['id']."'>".$list['q7']." ".$list['q8']." ".$list['q9']."</a></td>";
	echo "<td>".$list['crtdt']."</td>";
	echo "<td>".$list['q0']."</td>";
	$id=$list['id'];
	$w='window.location.replace("med_cert_form.php?machen=2&id='.$id.'")';
        $w2='dlt('.$id.');';
        $w1='window.location.replace("med_cert_list.php?delete=1&id='.$id.'")';
	echo "<td><button class= 'but_image'  title='�������������' onclick='".$w."'><img src='css/edit_mini.png'></button>";
        echo "<button class= 'but_image'  title='�������' onclick='".$w1."'><img src='css/delete_mini.png'></button></td>";
}

function prnt_all($usr,$lng){
        $query=  mysql_query("SELECT t1.fnum,t1.order,t1.cy,t1.cx,t2.tpe,t2.lngth
                        FROM med_cert.cords as t1
                        LEFT JOIN med_cert.form_list  as t2 on t1.fnum=t2.np
                         where t1.user=$usr");
        while ($r = mysql_fetch_assoc($query)) { 
                    //1-����� �� ������,2-����,3-�����,4-�����
                    $t="q".$r['fnum'];
                    
                    if(($r['tpe']==2)){
                        print_date_coord($r['cy'], $r['cx'], $_POST[$t]);
                    }
                    elseif(($r['tpe']==3)){
                        print_on_coord($r['cy'], $r['cx'], $_POST[$t]);
                    }
                    elseif(($r['tpe']==4)){
                        print_on_coord($r['cy'], $r['cx'], $_POST[$t]);
                    }
                    elseif($r['tpe']==1){
                        if($r['order']==$_POST[$t]){
                            print_check_coord($r['cy'], $r['cx']);
                        }
                    }
		}
}
//��������� ������ ����� ��� ������� med_cert_form
function get_form_list(){
	return $query = mysql_query("SELECT * FROM med_cert.form_list");
}
//������ �� �������� ���������� ������� med_cert_form
function get_form_list_values(){
	return $query = mysql_query("SELECT * FROM med_cert.form_list_values");
}
//������ ������ �� ������ med_cert_list
function get_list($sort,$way){
	if ($sort==1){
		$w="q7";
	}
	elseif ($sort==2){
		$w="crtdt";
	}
	elseif ($sort==3){
		$w="q0";
	}
	if ($way==1){
		$w=$w." ASC";
	}
	elseif ($way==-1){
		$w=$w." DESC";
	}
	
	return $query = mysql_query("SELECT t2.id,
                                        MAX(IF(t1.num=7,t1.value,null)) as q7,
                                        MAX(IF(t1.num=8,t1.value,null)) as q8,
                                        MAX(IF(t1.num=9,t1.value,null)) as q9,
                                        MAX(IF(t1.num=0,t1.value,null)) as q0,
                                        t2.crtdt
                                        FROM med_cert.sertificates as t1
                                        LEFT JOIN med_cert.serts as t2 on t1.sert_id=t2.id
                                        where t2.deleted=0 and t1.deleted=0
                                        GROUP BY t1.sert_id
                                    ORDER BY $w");
}
//�������� ����������� ���� ��� ����� med_cert_form
function get_form_data($lnid){
        $a=array();
	$txt="SELECT num,value FROM med_cert.sertificates where sert_id =$lnid and deleted=0";
	$query = mysql_query($txt);
	while ($row = mysql_fetch_assoc($query)) { 
			$a[$row['num']]=$row['value'];
		}
	return $a;
}
//��������� ����� ����� �� ������ ����� �������� med_cert_list
function delete_row_list($id){
    return $query = mysql_query("UPDATE med_cert.serts SET deleted=1 where id=$id");
}
//�������� ������ � certs. ���������� �������� � sertificates �� organisations med_cert_list
function new_sert(){ // �������� ����� ������
		//�������� ������ �� 0 ������ ��� ��������� ������ � ��������
		//� ������� ����� ������ � �������������� ������� � ��������
    $user='1';
		$query = mysql_query("INSERT INTO med_cert.serts SET owner=$user
								");
		$last_insert=mysql_insert_id();
                get_defaults($last_insert,$user);
		return $last_insert;
}
//��������� ������ �� organisations med_cert_list
function get_defaults($last_insert,$user){
        $query = mysql_query("SELECT num,value FROM med_cert.organisations where user=$user");
            while ($row = mysql_fetch_assoc($query)) { 
                $num=$row['num'];
                $value=$row['value'];
                if($row['value']=="date_format(curdate(), '%d-%m-%Y')")
                    $value=$row['value'];
                else $value="'".$row['value']."'";
                $txt="INSERT INTO med_cert.sertificates SET sert_id=$last_insert , num=$num , value=$value";	
                $q = mysql_query($txt);
                }
}
// ���������� ������ ����� ���������� med_cert
function save_data($lnid,$lng){
    for ($i=0;$i<=$lng;$i++){
		$t="q".$i;
		if ($_POST[$t])
		{
                        $query= mysql_query("UPDATE med_cert.sertificates "
                                . "SET deleted=1 where sert_id=$lnid and num=$i");
			$txt="insert into med_cert.sertificates SET sert_id=".$lnid.
                                " , num=".$i." , value='".$_POST[$t]."'"; 
			$query = mysql_query($txt);
		}
	}
    
}
//������� ��� ������
//
//
//
//
//�� �������� ������������ ����������� ����� ������ �4 � ������. ������� ��������� � ��������� �������� ����������� �� ����.
// ������� ������ �������� ������ �� ����������(� �����������) 
	function print_on_coord($top,$left,$s) {
		//�������� ������� ��������(��������� ��� �������� HP Officejet 6000.) 
		$top=$top+1;
		$left=$left+1.7;
		//������ ����� ������ <div>. �� �������� ���������� �������� ������ ���� ����.(� ���� ����� �������)
		echo '<div class="writing" style="top: '.$top.'mm; position: absolute; left: '.$left.'mm; font-family: Times New Roman; font-size: 13px; margin: 1;">
		<table border="0" cellpadding="0" cellspacing="0" height="5mm" style="border-collapse: collapse;">
		<tbody>
		<tr>';
		$s=mb_strtoupper($s,"utf-8");
		$len=mb_strlen($s,"utf-8");
		//����� ����� ������ ����� �������� ������ ����� � ���������� �������� ������� ������� 4 �� � ������ 
		for($i=0;$i<$len;$i++) {
		//������ ������ 4��
		echo '<td style="width: 13px;padding-left:2px;">';//border: 1px solid black; 
		$ech=strtoupper(mb_substr($s,0,1,"utf-8"));
		$s=mb_substr($s,1,500,"utf-8");
		echo $ech;
		echo '</td>';}	
		echo '</tr>
		</tbody>
		</table>
		</div>';
	}
	//������ �������. ���� � �������� ��� � �����.
	function print_check_coord($top,$left) {
		$top=$top-0.5;
		$left=$left+1;
		echo '<div class="writing" style="top: '.$top.'mm; position: absolute; left: '.$left.'mm; font-family: Times New Roman; font-size: 10px; margin: 1;">
		<table border="0" cellpadding="0" cellspacing="0" height="3mm" style="border-collapse: collapse;">
		<tbody>
		<tr>';
		echo '<td style="width: 3mm; padding-left:2px;">';
		echo "v";
		echo '</td>';	
		echo '</tr>
		</tbody>
		</table>
		</div>';
	}
	//������ ����. ��� ���� ����� ���������� ������ � ������ ����� ����������. ���������� ������ ���������� � ������� ������� ������ ������ � ����������.
	function print_date_coord ($top,$left,$s) {
		if($s!=""){
			$t1=mb_strpos($s,"-",0,"utf-8");
			$day=mb_substr($s,0,$t1,"utf-8");
			$s=mb_substr($s,$t1+1,10,"utf-8");
			$t2=mb_strpos($s,"-",0,"utf-8");
			$mon=mb_substr($s,0,$t2,"utf-8");
			$year=mb_substr($s,$t1+1,10,"utf-8");
			print_on_coord($top,$left,$day);
			print_on_coord($top,$left+9.6,$mon);
			print_on_coord($top,$left+19.6,$year);
		}
	}
	//������ ���� (c ��������� - �������� ��� �������� ����). ��� ���� ����� ���������� ������ � ������ ����� ����������. ���������� ������ ���������� � ������� ������� ������ ������ � ����������.
	function print_date_coord_with_check($top,$left,$s) {
		/*if (date('d-m-Y',strtotime($s))!='01-01-1970') {
			$t1=mb_strpos($s,"-",0,"utf-8");
			$day=mb_substr($s,0,$t1,"utf-8");
			$s=mb_substr($s,$t1+1,10,"utf-8");
			$t2=mb_strpos($s,"-",0,"utf-8");
			$mon=mb_substr($s,0,$t2,"utf-8");
			$year=mb_substr($s,$t1+1,10,"utf-8");
			print_on_coord($top,$left,$day);
			print_on_coord($top,$left+9.5,$mon);
			print_on_coord($top,$left+19.5,$year);
		} else {*/
			print_on_coord($top,$left,'--');
			print_on_coord($top,$left+9.5,'--');
			print_on_coord($top,$left+19.5,'----');
			
	}
	// ������� ������ ������ � ��� ������. ����� ��������� �������� ������ ���� �������� ����� ������ �� ���� ����� ����������� �������� � ������
	function print_colon_coord($top,$left,$dl,$s) {
		$s1=mb_substr($s,0,$dl,"utf-8");
		$s2=mb_substr($s,$dl,$dl,"utf-8");
		print_on_coord($top,$left,$s1);
		print_on_coord($top+4,$left,$s2);
	}






?>