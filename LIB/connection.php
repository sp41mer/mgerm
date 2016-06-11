<?PHP
mysql_connect("0.0.0.0:5000", "user", "password")
or
die("Could not connect: MySQL error(86).");
mysql_select_db("med_cert");
mysql_query("SET NAMES utf8");

//try {
//    $dbh = new PDO('mysql:host=127.0.0.1:3307;dbname=med_cert', 'root', 'root');
//} catch (PDOException $e) {
//    print "Error!: " . $e->getMessage() . "<br/>";
//    die();
//}
/*
$query = mysql_query("
SELECT * FROM med_cert.form_list
");


 while ($row = mysql_fetch_assoc($query)) { 
        echo $row["id"]; 
        echo $row["txt"]; 
        echo $row["lngth"]; 
    } 
*/

?>