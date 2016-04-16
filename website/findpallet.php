<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
	
	<script src="https://code.jquery.com/jquery-2.2.3.min.js"
	integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="
	crossorigin="anonymous"></script>
	<script src="js/global.js"></script>
	
	
	<style>
	#no-results{
		display:none;
	}
	#results{
		display:none;
	}
	</style>
	
	<script>
	
	function validatePallet(){
		return true;
	}
	
	function find(){
		if(!validatePallet()) return;
		function api_findPallet(name, id){
			$.get( GLOBAL_API_ENDPOINT + "/find.php", { 
				pal_name: $("pal_name").val(), 
				pal_id: $("pal_id").val()}, 
				function( data ) {
		 			alert( "Data Posted: " + data );
			});
		}
	}
	
	function addResult(itemName, itemID, itemDesc){
		$("#results").show();
		$("#results").find('tbody')
    		.append($('<tr>')
        		.append($('<td>')
					
            		/*.append($('<img>')
                		.attr('src', 'img.png')
                		.text('Image cell')*/
            	)
        	)
    	);
	}
	</script>
</head>
<body>
	
	<div id="wrapper">
		<h1><a href="/"><img src="images/pallet_100.png" id="pallet_logo"/></a>Pallet Finder</h1>
		<p>find pallets by name &amp; id</p>
		<table>
			<tr>
				<td>
					Pallet Name:
				</td>
				<td>
					<input type="text" name="pallet_name" id="pallet_name">
				</td>
			</tr>
			<tr>
				<td>
					Pallet ID:
				</td>
				<td>
					<input type="text" name="pallet_id" id="pallet_id">
				</td>
			</tr>
		</table>
		
		<input type="submit" value="Submit" onclick="findPallet()">
		
		<div class="bad-red" id="no-results">No Results</div>
		
		<div id="results">
			<!-- RESULTS GO HERE -->
			<table>
				<tr>
					<th>
						Pallet Name
					</th>
					<th>
						Pallet ID
					</th>
					<th>
						Pallet Desc
					</th>
				</tr>
			</table>
		</div>
		
	</div>
	
	<div id="footer">iNNovate Hackathon 2016</div>
	
	
	
</body>
</html>