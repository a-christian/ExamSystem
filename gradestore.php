
<?php
    
    include 'Connect.php';
    
    

           $grade = $_POST['grade'];
           $explain = $_POST['feedback'];
           
         
           
                      
            $g_query = mysqli_query($connection, "SELECT explanation FROM StudentGrades WHERE explanation = '$explain'"); 
            $returnCount = mysqli_num_rows($g_query);
            
            
            if(returnCount > 0 )
            {
            
                  echo "Exam already graded";            
            }
            
            
           else {
           
           $add_grade = "INSERT INTO `ac482`.`StudentGrades` (`examgrade`, `explanation`) VALUES ('$grade', '$explain')";

           }
              
                    if (mysqli_query($connection, $add_grade)) {
                    
                          $success = "Grade submitted successfully.";
                          echo json_encode($success);
                          
                          echo $grade;
                          echo $explain;
                    
                                 
                    }
                    
                    else {
                    
                          echo "Error: " . $add_grade . "<br>" . mysqli_error($connection);
                          
                    }
                    
                    
                   
                   
                         mysqli_close($connection);
?>
