

<section class="container">


	<input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">

	<table class="order-table table">
		<thead>
			<tr>
				<th>Question</th>
				<th>Point Value</th>
				<th>Category</th>
				<th>Difficulty</th>
			</tr>
		</thead>
		<tbody>
		<tr>
		
		<?php 
          $url = 'https://web.njit.edu/~ac482/CS490/questionretrieve.php';
          //open connection
          $ch = curl_init();
          //set the url, number of POST vars, POST data
          curl_setopt($ch,CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
          
          //curl_setopt($ch,CURLOPT_POST, count($fields));
          //curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
          //execute post
          $exquest = curl_exec($ch); 
          curl_close($ch);
          $exquest = json_decode($exquest, true); 
          
          $numOfQuests = $exquest["questcount"]; 
               
          echo "<input type='text' name='examID' id='examID' class='form-control' placeholder='Enter an exam ID' autofocus=''>" . "<br />";
		  
			

          for ($i=0; $i<$numOfQuests; $i++) 
          {
               

               echo "<tr><td>" . "<input type='checkbox' name='q[$i]' id='q[$i]' value='" . "<td>" .  json_encode($exquest["$i"]) . "</td>" . "'> " . "<td>" . json_encode($exquest["$i"][0]) . "</td>" . "</td></tr>";
			 		
          		
          }   
          
          
     
				
				

		
?>	
		
		</tr>
		</tbody>
	</table>

</section>

<script>

(function(document) {
	'use strict';

	var LightTableFilter = (function(Arr) {

		var _input;

		function _onInputEvent(e) {
			_input = e.target;
			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
			Arr.forEach.call(tables, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, _filter);
				});
			});
		}

		function _filter(row) {
			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('light-table-filter');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = _onInputEvent;
				});
			}
		};
	})(Array.prototype);

	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
			LightTableFilter.init();
		}
	});

})(document);

</script>