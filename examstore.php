
<?php
    
    include 'Connect.php';

        $examID = $_POST['examID'];
		$ques = $_POST['ques']; 
		
		
           
                      
            $e_query = mysqli_query($connection, "SELECT examquestion FROM Exam"); 
            $returnCount = mysqli_num_rows($e_query);
            
               if($returnCount > 0) {
               
                  $update_exam = "UPDATE Exam SET examquestion = '$ques'";
                   
               }
               else {
            
					
						
                       $add_exam = "INSERT INTO `ac482`.`Exam` (`examid`, `examquestion`) VALUES ('$examID', '$ques')";
          
               
               }
					if(mysqli_query($connection, $add_exam)){
                        $success = "exam submitted successfully";
                        echo json_encode($success); 
				
						
                    }
					if(mysqli_query($connection, $update_exam)){
                        $successful = "exam updated successfully";
                        echo json_encode($successful); 
				
						
                    }
                 
                    else {
                    
                          echo "Error: " . $add_exam . "<br>" . mysqli_error($connection);
						  
					
                          
                    }
                    
                    
                   
                   
                         mysqli_close($connection);
?>
