
<?php
    
    
  include 'Connect.php';
  
	  
	  
	  
	  $getGrade = "SELECT * FROM GradedExams";
   
	  $result = mysqli_query($connection, $getGrade);
  
      $numrows = mysqli_num_rows($result);

  

		$feedback = [];
		$i = 0;
		
          	while($row = mysqli_fetch_assoc($result)){

            array_push($feedback, [
			array(unserialize($row['question'])),
			array(unserialize($row['value'])),
			array(unserialize($row['questionscore'])),
			array(unserialize($row['compilestatus'])),
			array(unserialize($row['compilegrade'])),
			array(unserialize($row['casestatus'])),
			array(unserialize($row['casegrade'])),
			array(unserialize($row['parenbracketstatus'])),
			array(unserialize($row['parenbracketgrade'])),
			array($row['grade'])
    
			]);
          }
        //echo json_encode($feedback);
		
		print_r($feedback);
		
		  
		 
		  


              mysqli_close($connection);
?>  
