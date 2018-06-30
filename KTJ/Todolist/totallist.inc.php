<?php

$query = "SELECT * FROM title where id = ".$_SESSION['user_id'];
$stmt = $dbh->prepare($query);
if ($stmt->execute()) {
	//echo 'Enter<br>';
	$total_list = 0;
	$row = $stmt->fetch();
	$i = 0;
	while ($i <=5) {
		//echo $row[$i];
		if ($row[$i] != '') {
			$total_list++;
		}
		$i++;
	}
	//echo '<br>'.$total_list.'<br>';
	if ($row[1] == NULL) {
		//echo 'All Empty<br>';
	} else if ($row[2] == NULL) {
		//echo 'ONE list';
		$total_list = 1;
		$a = 'todo_2';
		$b = 'todo_1';
	} else if ($row[3] == NULL) {
		//echo 'Two list';
		$total_list = 2;
		$a = 'todo_3';
		$b = 'todo_2';
	} else if ($row[4] == NULL) {
		//echo 'Three list';
		$total_list = 3;
		$a = 'todo_4';
		$b = 'todo_3';
	} else if ($row[5] == NULL) {
		//echo 'Four list';
		$total_list = 4;
		$a = 'todo_5';
		$b = 'todo_4';
	} else {
		//echo 'Five list';
		$total_list = 5;
		$a = 'todo_5';
		$b = 'todo_5';
	}
	
} else {
	//echo 'bechara <br>';
}

$_SESSION['total_list'] = $total_list;



?>