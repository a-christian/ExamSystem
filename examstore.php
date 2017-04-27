
<?php
    
    include 'Connect.php';

        $examID = $_POST['examID'];
		$ques = $_POST['ques']; 
		
		
           
                      
            $e_query = mysqli_query($connection, "SELECT examid, examquestion FROM Exam WHERE examid = '$examID' AND examquestion = '$ques'"); 
            $returnCount = mysqli_num_rows($e_query);
            
               if($returnCount > 0) {
               
                  echo "Question already part of exam id . $examID ";
                   
               }
               else {
            
					
						
                       $add_exam = "INSERT INTO `ac482`.`Exam` (`examid`, `examquestion`) VALUES ('$examID', '$ques')";
          
               
               }
					if(mysqli_query($connection, $add_exam)){
                        $success = "exam submitted successfully";
                        echo json_encode($success); 
				
						
                    }
                 
                    else {
                    
                          echo "Error: " . $add_exam . "<br>" . mysqli_error($connection);
						  
					
                          
                    }
                    
                    
                   
                   
                         mysqli_close($connection);
?>
