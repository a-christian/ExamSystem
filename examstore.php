
<?php
    
    include 'Connect.php';

           $examID = $_POST['examID'];
           $q = $_POST['newValue'];
          // $encodeEx = json_encode($q);
         
           
                      
            $e_query = mysqli_query($connection, "SELECT examid FROM Exam WHERE examid = '$examID' "); 
            $returnCount = mysqli_num_rows($e_query);
            
               if($returnCount > 0) {
               
                   $update_exam = "UPDATE Exam SET examquestion = '$q' WHERE examid = '$examID' ";
                   
               }
               else {
            
           
                       $add_exam = "INSERT INTO `ac482`.`Exam` (`examquestion`, `examid`) VALUES ('$q', '$examID')";

          
               
               }
              
                    if (mysqli_query($connection, $add_exam)) {
                    
                          $success = "exam submitted successfully.";
                           json_encode($success);
                                 
                    } 
                    elseif(mysqli_query($connection, $update_exam)){
                        $successful = "exam updated successfully";
                        json_ecode($successful);
                    }
                    else {
                    
                          echo "Error: " . $add_exam . "<br>" . mysqli_error($connection);
                          
                    }
                    
                    
                   
                   
                         mysqli_close($connection);
?>
