<?php
// Start the session
session_start();
?>

<?php
 
    include 'Connect.php';
     
     

            $username = $_POST["username"];
            $password = $_POST["password"];
            
   
            $sql_queryStudent = mysqli_query($connection, "SELECT username, password FROM Students WHERE username = '$username' AND password = '$password' "); 
            $returnCount = mysqli_num_rows($sql_queryStudent);
            
                 
            $sql_queryProf = mysqli_query($connection, "SELECT username, password FROM Instructor WHERE username = '$username' AND password = '$password' ");
            $returnCount2 = mysqli_num_rows($sql_queryProf);
            
                if($returnCount > 0 ) {

                 $userType = "Student";
                 
                 
                }                           
                
                elseif($returnCount2 > 0 ) {
 
                     $userType = "Professor"; 
                       
                }
                
                else {      
                    
                    echo "<br/>\n", 'Invalid Login';
                    
                    
                 }
                 
                if($returnCount > 0 || $returnCount2 > 0) {
                  
                    $_SESSION['user'] = $username;
                
                }
           
                 
        
                        mysqli_close($connection);
?>
