
<?php
    
  include 'Connect.php';
  

$getExam = "SELECT examquestion,examid FROM Exam";

$result = mysqli_query($connection, $getExam);
  

  
       
      $ques = array();
      


          while($row = mysqli_fetch_assoc($result)){

          $ques = explode("\n", $row['examquestion']);
             
    

          }
             
  
          echo json_encode($ques);
         
          


              mysqli_close($connection);

?>
