
<?php
    
    
  include 'Connect.php';
  
	  
	  
	  
	  $getupdatedGrade = "SELECT * FROM UpdatedGradedExams";
   
	  $result = mysqli_query($connection, $getupdatedGrade);
  
      $numrows = mysqli_num_rows($result);

  

		$updatedfeedback = [];
		$i = 0;
		
          	while($row = mysqli_fetch_assoc($result)){

            array_push($updatedfeedback, [
			unserialize($row['question']),
			unserialize($row['answer']),
			unserialize($row['questionScore']),
			unserialize($row['compileStatus']),
			unserialize($row['compileGrade']),
			unserialize($row['caseStatus']),
			unserialize($row['caseGrade']),
			unserialize($row['parenBracket']),
			unserialize($row['bracketGrade']),
			$row['grade'],
			$row['feedback']
    
			]);
          }
        echo json_encode($updatedfeedback);
		
		//print_r($updatedfeedback);
		
		  
		 
		  


              mysqli_close($connection);
?>  
