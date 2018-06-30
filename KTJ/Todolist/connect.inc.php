<?PHP 
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'database_a';
//echo md5('admin123');
//$string = 'mysql:host='.$db_host'dbname='.$db_name;
try {
	$dbh = new PDO('mysql:host=localhost;dbname=database_a', $db_user , $db_pass);


	//echo 'Successfully connected.<br>';
} catch (PDOException $e) {
	print "Error".$e->getMessage()>"<br>";
}



?>