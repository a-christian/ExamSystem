
<?php
    
    include 'Connect.php';

            $methodName = $_POST['methodName'];
            $pointValue = $_POST['pointValue'];
            $category = $_POST['category'];
            $difficulty = $_POST['difficulty'];
            $question = $_POST['question'];
            $parameter1 = $_POST['parameter1'];
            $parameter2 = $_POST['parameter2'];
            $parameter3 = $_POST['parameter3'];
			$parameter4 = $_POST['parameter4'];
            $case1 = $_POST['case1'];
			$case2 = $_POST['case2'];
			$case3 = $_POST['case3'];
			$case4 = $_POST['case4'];
			$answer1 = $_POST['answer1'];
            $answer2 = $_POST['answer2'];
			$answer3 = $_POST['answer3'];
			$answer4 = $_POST['answer4'];
			
			
            $q_query = mysqli_query($connection, "SELECT methodName, category FROM QuestionBank WHERE question = '$methodName' AND category = '$category' "); 
            $returnCount = mysqli_num_rows($q_query);
            
               if($returnCount > 0){
                   echo "Question already exists in the database.";
               }
               else{
                  $add_question = "INSERT INTO `ac482`.`QuestionBank` (`methodName`, `pointValue`, `category`, `difficulty`, `question`, `parameter1`, `parameter2`, `parameter3`, `parameter4`, `case1`, `case2`, `case3`, `case4`, `answer1`, `answer2`, `answer3`, `answer4`) 
				  VALUES ('$methodName', '$pointValue', '$category', '$difficulty', '$question', '$parameter1', '$parameter2', '$parameter3', '$parameter4', '$case1', '$case2', '$case3', '$case4', '$answer1', '$answer2', '$answer3', '$answer4')";
                  
                  
                                
               }
              
              
              
                    if (mysqli_query($connection, $add_question)) {
                          $success = "New question added to the bank!";
                          json_encode($success);
                          
                    } 
                    else {
                          echo "Error: " . $add_question . "<br>" . mysqli_error($connection);
                    }
                    
                    
                   
                   
                         mysqli_close($connection);
?>
