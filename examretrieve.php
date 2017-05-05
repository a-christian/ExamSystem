

<?php
    
  include 'Connect.php';
  

$getExam = "SELECT examid, examquestion FROM Exam";



$result = mysqli_query($connection, $getExam);
  

  
       
      $ques = array();
      


          while($row = mysqli_fetch_assoc($result)){

          $ques = explode("\n", $row['examquestion']);
             
    

          }
		
		
		  
			$count = count($ques);
			$testcase = [];
		 
			for($i = 0; $i < $count; $i++){
			
			$cases = "SELECT * FROM QuestionBank WHERE question = '$ques[$i]' ";
			
						$result2 = mysqli_query($connection, $cases);
			
			while($row2 = mysqli_fetch_assoc($result2)){

            array_push($testcase, [
			array($row2['question']),
			array($row2['methodName']),
			array($row2['pointValue']),
			array($row2['case1']),
			array($row2['case2']),
			array($row2['case3']),
			array($row2['case4']),
			array($row2['answer1']),
			array($row2['answer2']),
			array($row2['answer3']),
			array($row2['answer4'])
    
			]);
          }
			}
					


	echo json_encode($testcase);
	

		
              mysqli_close($connection);

?>
