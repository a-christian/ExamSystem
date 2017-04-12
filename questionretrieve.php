
<?php
    
    
  include 'Connect.php';
  
 
       
  

  $getQuestions = "SELECT * FROM QuestionBank";
  

  
  
  $result = mysqli_query($connection, $getQuestions);
  
  $numrows = mysqli_num_rows($result);

  
		$i = 0;
	   
      //$exquest = array();
      $exquest["questcount"] = $numrows;


          while($row = mysqli_fetch_assoc($result)){

  
            $exquest["question $i"] = $row['question'];
			$exquest["points $i"] = $row['pointValue'];
			$exquest["difficulty $i"] = $row['difficulty'];
			$exquest["case1 $i"] = $row['case1'];
			$exquest["case2 $i"] = $row['case2'];
			$exquest["case3 $i"] = $row['case3'];
			$exquest["case4 $i"] = $row['case4'];
			$exquest["answer1 $i"] = $row['answer1'];
			$exquest["answer2 $i"] = $row['answer2'];
			$exquest["answer3 $i"] = $row['answer3'];
			$exquest["answer4 $i"] = $row['answer4'];			
            $i++;
			      

          }    
  
          echo json_encode($exquest);
		  
		 
		  


              mysqli_close($connection);
?>  
