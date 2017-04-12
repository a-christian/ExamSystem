
<?php
    
    
  include 'Connect.php';
  
	   
		$getGrade = "SELECT * FROM StudentGrades";
   

  
  
  $result = mysqli_query($connection, $getGrade);
  
  $numrows = mysqli_num_rows($result);

  
		$i = 0;
	   
      $grades = array();



          while($row = mysqli_fetch_assoc($result)){

  
            $grades["$i"] = $row['examgrade'];
            
			      $grades["$i"] = $row['explanation'];
            
            $i++;
			      

          }    
  
          echo json_encode($grades);
		  
		 
		  


              mysqli_close($connection);
?>  
