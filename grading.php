<?php

//grabbing the exam answers and other info needed to grade
$result = json_decode(file_get_contents("php://input"), true);
$question = $result["quest"];
$value = $result["nvalue"];
$methodname = $result["method"];
$points = $result["points"];
$cases = $result["caseOne"];
$answers = $result["answerOne"];
$testtotal = 0;  				 //how much they scored total for the current test
$maxpoints = array_sum($points); //max amount of points possible
$questionpoints = array();		//array to store how much they scored for each question
$compilepoints = array();
$casepoints = array();
$parenbracketpoints = array();
$compilefeedback = array();
$casefeedback = array();
$parenbracketfeedback = array();


//function to look character by character and check for a closing parenthesis/bracket
function hasParenBrack($string) {
    $counter = 0;   
	
    $length = strlen($string);
		for($i = 0; $i < $length; $i++) {
			
			$char = $string[$i];
			if($char == '(' || $char == '{') {
				$counter ++;
			} 
			elseif($char == ')' || $char == '}') {
				$counter --;
			}
			if($counter < 0 ) {
				return false;
			}
		}
    return $counter == 0;
}


//grading starts here
	$i=0;
	$k = 1;
	
		while($i<=sizeof($value)- 1) {
	
			$file[$i] = 'answer' . $i . '.java'; 
			$compiled = 'answer' . $i; 
			file_put_contents($file[$i], "class " . 'answer' . $i . " { ", FILE_APPEND);
			file_put_contents($file[$i], "public static void main(String[] args) { ", FILE_APPEND);
			file_put_contents($file[$i], "System.out.println(" . $cases[$i] . ");", FILE_APPEND);
			file_put_contents($file[$i], "}", FILE_APPEND);
			file_put_contents($file[$i], $value[$i], FILE_APPEND); 
			file_put_contents($file[$i], "}", FILE_APPEND);
			exec("javac $file[$i]", $output, $return_var);
		    $result[$i] = shell_exec("java $compiled");
			
			if($return_var == 0) {
				$compilestatus = "Answer " . $k . " compiled successfully.";
				//echo  "<br>" . $compilestatus;
				$compilefeedback[$i] = $compilestatus;
		
				$compilegrade = 0;
				
				$compileinfo = " You lost " . $compilegrade . " point(s) for compiling.";
				
				$compilepoints[$i] = $compileinfo;
				
			}
			else {
				$compilestatus = "Answer " . $k . " did not compile.";
				$compilefeedback[$i] = $compilestatus;
				
	
				 $compilegrade = $points[$i] * 0.5;
				 $compileinfo = " You lost " . $compilegrade . " point(s) for compiling.";
				 $compilepoints[$i] = $compileinfo;
			}
			
			if(intval($result[$i]) != intval($answers[$i]) || $return_var != 0){
				$casestatus = "Test case " . $cases[$i] . " failed. Your result: " . $result[$i] . " Our result: " . $answers[$i];
				$casefeedback[$i] = $casestatus;
		
				$testcasegrade = $points[$i] * 0.3;
				$caseinfo = " You lost " . $testcasegrade . " point(s) for testcases.";
				$casepoints[$i] = $caseinfo;
			}
			
			elseif(intval($result[$i]) == intval($answers[$i])) {
				$casestatus = "Test case " . $cases[$i] . " successful. Your result: " . $result[$i] . " Our result: " . $answers[$i];
				$casefeedback[$i] = $casestatus;
				
				
				$testcasegrade = 0;
				$caseinfo = " You lost " . $testcasegrade . " point(s) for testcases.";
				$casepoints[$i] = $caseinfo;
			}


			$passed = hasParenBrack($value[$i]);
			if($passed == false) {
							
				$parenbracketstatus = "Your answer did not pass the check for matching parenthesis/brackets.";
				$parenbracketfeedback[$i] = $parenbracketstatus;
				
				

				$parenbracketgrade = $points[$i] * 0.1;
				$parenbracketinfo = " You lost " . $parenbracketgrade . " point(s) for parenthesis/brackets.";
				$parenbracketpoints[$i] = $parenbracketinfo;
							
			}
			else {
				
				$parenbracketstatus = "Awesome, no signs of missing parenthesis/brackets.";
				$parenbracketfeedback[$i] = $parenbracketstatus;
					
				$parenbracketgrade = 0;
				$parenbracketinfo = " You lost " . $parenbracketgrade . " point(s) for parenthesis/brackets.";
				$parenbracketpoints[$i] = $parenbracketinfo;
			}
			
			//calculates the amount of points lost from the 3 variables
			 $pointslost = $compilegrade + $testcasegrade + $parenbracketgrade;
			 
			//subtracts the points lost from the amount the question is worth
			 $questpoints = $points[$i] - $pointslost;
			
			//storing the amount of points scored for each question
		     $questionpoints[$i] = $questpoints;
			 
			//appending the amount of points for each question to the total amount scored for the exam
			 $testtotal += $questpoints;
			 
			//used to write over whatever was appended to each file so the next exam graded doesn't get appended to it	
			file_put_contents($file[$i], "");
			$i++;
			$k++;
			
		}		
		//finally calculate the total grade after the looping is done
				
		$grade = ($testtotal/$maxpoints) * 100;
		//echo "Your grade is: " . $grade."%";
		
		//2D array to store the exam questions, student ans, feedback and grade
			$examfeedback = array
		(
			"question" => serialize($question),
			"value" => serialize($value),
			"questionpoints" => serialize($questionpoints),
			"compilefeedback" => serialize($compilefeedback),
			"compilepoints" => serialize($compilepoints),
			"casefeedback" => serialize($casefeedback),
			"casepoints" => serialize($casepoints),
			"parenbracketfeedback" => serialize($parenbracketfeedback),
			"parenbracketpoints" => serialize($parenbracketpoints),
			"grade" => $grade
		);
		//print_r($examfeedback);
		
		
		//---------------------------------------------------------------------------------------------------------------------------------//
		//Sending all this feedback to the backend
		
	$examfeedback = json_encode($examfeedback);
$url = "https://web.njit.edu/~ac482/CS490/gradestore.php";


//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POSTFIELDS, $examfeedback);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type: application/json'));



//execute post
$result = curl_exec($ch);
//close connection
curl_close($ch);
		
		
		


?>

