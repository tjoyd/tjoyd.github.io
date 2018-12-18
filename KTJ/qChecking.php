<?php

require 'core.inc.php';
if (!loggedin()) {
	//header('Location: register.php');
	include 'landing.php';
	die();
}
require 'connect.inc.php';
require 'question.inc.php';

$question_ans = $_SESSION['question_ans'];
$question_ans = strtolower($question_ans);

if (isset($_POST['answer'])) {
  //echo "ok";
  $user_ans = strtolower($_POST['answer']);

  if (!empty($user_ans)) {
    if ($user_ans == $question_ans) {
      //echo "Wow right answer";
      if ($_SESSION['question_no'] < $_SESSION['maxQuestion_no']) {
        $no = $_SESSION['question_no'] + 1;
        $query = "UPDATE queries SET Current = ? WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $current = $_SESSION['question_no'];
        $userid = $_SESSION['user_id'];
        $stmt->bindParam(':Current',$current);
        $stmt->bindParam(':id',$userid);

        if (($stmt->execute())) {
          //echo " Queries added.<br>";
          $_SESSION['question_no'] = $no;
        } else {
          //echo "Error at Queries.";
          $done = false;
        }
      } else {
        echo "You Won";
      }
      include 'question.inc.php';
    } else {
      echo "Opps!!! Wrong Answer";
      //echo $question_ans;
      //echo $_SESSION['question_ans'];
      //echo " | ";
      //echo $user_ans;
    }
  } else {
	  echo "Enter data";
  }
}


?>
