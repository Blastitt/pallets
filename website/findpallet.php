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
		margin-top:20px;
	}
	#results{
		display:none;
		margin-top:20px;
	}
	</style>
	
	<script>
	
	function validatePallet(){
		return true;
	}
	
	function findPallet(){
		$.support.cors = true;
		if(!validatePallet()) return;
		
	    $.ajax({
	               url: GLOBAL_API_ENDPOINT + "/find.cgi?",
	               type: "get",
	               crossDomain: true,
	               data: $.param({ pal_name: $("#pallet_name").val(), pal_id: $("#pallet_id").val()}),
			dataType:"json",
	               success: function (response) {
	                   // var resp = JSON.parse(response)
// 	                   alert(resp.status);
					   //alert( "Data Posted: " + response );
					   $('#no-results').hide();
					   $('#results').show();
					   
					   $("#result-table").find("tr:gt(0)").remove();
					   
					   var keys = Object.keys(response);
					   for(var i = 0; i < keys.length; i++){
						   var pallet = response[keys[i]];
						   var itemName = pallet.pallet_name;
						   var itemID = pallet.pallet_id;
						   var desc = pallet.pallet_desc;
						   addResult(itemName, itemID, desc);
					   }
					   
	               },
	               error: function (xhr, status) {
					   $('#no-results').show();
					   $('#results').hide();
					   
	                   //alert("error");
	               }
	           });
		
		// $.get( GLOBAL_API_ENDPOINT + "/find.cgi?", {
// 			pal_name: $("pal_name").val(),
// 			pal_id: $("pal_id").val()},
// 			function( data ) {
// 	 			alert( "Data Posted: " + data );
// 		});
	}
	
	function addResult(itemName, itemID, itemDesc){
		$("#results").show();
		$("#results").find('tbody')
    		.append($('<tr>')
        		.append($('<td>').html("<a href='/editpallet.php?id="+itemID+"'>" + itemName + "</a>")
					
            		/*.append($('<img>')
                		.attr('src', 'img.png')
                		.text('Image cell')
            	)*/
				
        	).append($('<td>').text(itemID))
			.append($('<td>').text(itemDesc))
    	);
	}
	</script>
</head>
<body>
	
	<div id="wrapper">
		<h1><a href="/"><img src="images/pallet_100.png" id="pallet_logo"/></a>Pallet Finder</h1>
		<p>find pallets by name &amp; id</p>
		<table class="blue">
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
		
		<button onclick="findPallet()">find</button>
		
		<div class="bad-red" id="no-results">No Results</div>
		
		<div id="results">
			<!-- RESULTS GO HERE -->
			<table class="alternating" id="result-table">
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