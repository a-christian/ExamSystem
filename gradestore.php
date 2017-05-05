
<?php
    
    include 'Connect.php';
	
	
	$getfeedback = json_decode(file_get_contents("php://input"), true);
	$question = $getfeedback["question"];
	$value = $getfeedback["value"];
	$questionpoints = $getfeedback["questionpoints"];
	$compilefeedback = $getfeedback["compilefeedback"];
	$compilepoints = $getfeedback["compilepoints"];
	$casefeedback = $getfeedback["casefeedback"];
	$casepoints = $getfeedback["casepoints"];
	$parenbracketfeedback = $getfeedback["parenbracketfeedback"];
	$parenbracketpoints = $getfeedback["parenbracketpoints"];
	$grade = $getfeedback["grade"];
	
	
	$g_query = "INSERT INTO `ac482`.`GradedExams` (`question`, `value`, `questionscore`, `compilestatus`, `compilegrade`, `casestatus`, `casegrade`, `parenbracketstatus`, `parenbracketgrade`, `grade`) 
				  VALUES ('$question', '$value', '$questionpoints', '$compilefeedback', '$compilepoints', '$casefeedback', '$casepoints', '$parenbracketfeedback', '$parenbracketpoints', '$grade')";
	
	if(mysqli_query($connection, $g_query)){
		echo "Graded exam stored successfully";
	}
	
	
                   
                         mysqli_close($connection);
?>
