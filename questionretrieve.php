
<?php
    
    
  include 'Connect.php';
  
 

  $getQuestions = "SELECT * FROM QuestionBank";
  

  
  
  $result = mysqli_query($connection, $getQuestions);
  
  $numrows = mysqli_num_rows($result);

  
		$i = 0;
	   
     $exquest = [];
      $exquest["questcount"] = $numrows;


          while($row = mysqli_fetch_assoc($result)){
			array_push($exquest, [
			
      array($row['question']),
			array($row['pointValue']),
			array($row['category']),
			array($row['difficulty']),
			array($row['case1']),
			array($row['case2']),
			array($row['case3']),
			array($row['case4']),
			array($row['answer1']),
			array($row['answer2']),
			array($row['answer3']),
			array($row['answer4'])
			
            ]);
			     

          }     
  
			echo json_encode($exquest);
 
		  


              mysqli_close($connection);
?>  
