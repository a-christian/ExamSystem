<?php
include 'Connect.php';
$result = json_decode(file_get_contents("php://input"), true);

	$question = serialize($result["question"]);
	$answer = serialize($result["answer"]);
	$questionScore = serialize($result["questionScore"]);
	$compileStatus  = serialize($result["compileStatus"]);
	$compileGrade = serialize($result["compileGrade"]);
	$caseStatus = serialize($result["caseStatus"]);
	$caseGrade = serialize($result["caseGrade"]);
	$parenBracket = serialize($result["parenBracket"]);
	$bracketGrade = serialize($result["bracketGrade"]);
	$grade = $result["grade"];
	$feedback = $result["feedback"];
	
	$u_query = "INSERT INTO `ac482`.`UpdatedGradedExams` (`question`, `answer`, `questionScore`, `compileStatus`, `compileGrade`, `caseStatus`, `caseGrade`, `parenBracket`, `bracketGrade`, `grade`, `feedback`) 
				  VALUES ('$question', '$answer', '$questionScore', '$compileStatus', '$compileGrade', '$caseStatus', '$caseGrade', '$parenBracket', '$bracketGrade', '$grade', '$feedback')";
	
	if(mysqli_query($connection, $u_query)){
		echo "Graded exam updated successfully";
	}



?>